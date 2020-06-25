<?php

/*
* To change this license header, choose License Headers in Project Properties.
* To change this template file, choose Tools | Templates
* and open the template in the editor.
*/

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Model\Booking;
use App\Model\ListingRule;
use App\Model\PhoneNumber;
use App\Model\TransactionModel;
use App\Model\UserPayment;
use App\Model\UserPayout;
use App\User;
use App\UserPaymentInfo;
use Auth;

//use GuzzleHttp\Psr7\Request;
//use Illuminate\Support\Facades\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Braintree_Transaction;
use Braintree_Customer;
use Braintree_ClientToken;
use Braintree_PaymentMethodNonce;
use Braintree_WebhookNotification;
use Braintree_Subscription;
use Braintree_CreditCard;
use App\Model\Listing;
use Illuminate\Support\Facades\Log;
use Validator;
use Illuminate\Support\Facades\Session;
use App\transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\SparkController;

class PaymentController extends Controller
{

    Protected $SparkController;

    public function __construct()
    {
        $this->SparkController = new SparkController();
    }

    /*
     * Show the first page from room to payment
     * Getting Card Detail form show
     * */
    public function index(Request $request)
    {
        $request->session()->put('bookingInfo', $request->all());
        $listing = Listing::with('user')->findOrFail($request->listingid);
        //dd($request->all());
        /**/
        $user_id = auth()->user()->id;
        $userPaymentInfo = UserPayment::where('user_id', $user_id)->get();
        foreach ($userPaymentInfo as $i => $v) {
            $v->maskedCardNumber = $this->ccMasking($v->card_number, '*');
        }

        /**/
        $allRules = ListingRule::whereNull('listing_id')->orwhere('listing_id', $request->listingid)->get();
        $listingRules = [];
        foreach ($listing->rules as $rule) {
            $listingRules[] = $rule->id;
        }

        $start_date = Carbon::parse($request->date_from);
        $end_date = Carbon::parse($request->date_to);
        $final = $end_date->diffInDays($start_date);
        if ($final == 0) {
            $final = 1;
        }
        $request->request->add(['totaldays' => $final]);

        try {
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            $customer = \Stripe\Customer::retrieve(\Auth::user()->stripe_cust_id);
            $stripeCustCards = $customer->sources->data;
//            dd($customer->sources->data);
        } catch (\Exception $er) {
            $stripeCustCards = collect([]);
        }

        return view('pages.checkout')->with('userPaymentInfo', $userPaymentInfo)->with('listing', $listing)->with('allRules', $allRules)->with('listingRules', $listingRules)->with('requestObj', $request)->with('stripeCustCards', $stripeCustCards);

    }

    /*
     * Show Final Recipt page after getting info from Card
     * */
    public function addOrder(Request $request)
    {
        $guestUserObj = User::find(auth()->user()->id);
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));


        if ($request['useOldCard'] == null) {

            try {

                $customer = \Stripe\Customer::create(array(
                    "email" => $guestUserObj->email,
                    "source" => $request->stripeToken,
                ));

                if (isset($customer->id)) {
                    $guestUserObj->stripe_cust_id = $customer->id;
                    $guestUserObj->save();

                } else {
                    return redirect('/rooms/' . $request['listingid'])->with('error', '' . "Something Went Wrong");
                }

            } catch (\Stripe\Error\Card $e) {
                // Since it's a decline, \Stripe\Error\Card will be caught
                $body = $e->getJsonBody();
                $err = $body['error'];
                return redirect('/rooms/' . $request['listingid'])->with('error', '' . $err['message']);

            } catch (\Stripe\Error\RateLimit $e) {
                // Too many requests made to the API too quickly
                $body = $e->getJsonBody();
                $err = $body['error'];
                return redirect('/rooms/' . $request['listingid'])->with('error', '' . $err['message']);
            } catch (\Stripe\Error\InvalidRequest $e) {
                // Invalid parameters were supplied to Stripe's API
                $body = $e->getJsonBody();
                $err = $body['error'];
                return redirect('/rooms/' . $request['listingid'])->with('error', '' . $err['message']);
            } catch (\Stripe\Error\Authentication $e) {
                // Authentication with Stripe's API failed
                // (maybe you changed API keys recently)
                $body = $e->getJsonBody();
                $err = $body['error'];
                return redirect('/rooms/' . $request['listingid'])->with('error', '' . $err['message']);
            } catch (\Stripe\Error\ApiConnection $e) {
                // Network communication with Stripe failed
                $body = $e->getJsonBody();
                $err = $body['error'];
                return redirect('/rooms/' . $request['listingid'])->with('error', '' . $err['message']);
            } catch (\Stripe\Error\Base $e) {
                // Display a very generic error to the user, and maybe send
                // yourself an email
                $body = $e->getJsonBody();
                $err = $body['error'];
                return redirect('/rooms/' . $request['listingid'])->with('error', '' . $err['message']);
            } catch (\Exception $e) {
                // Something else happened, completely unrelated to Stripe
                $body = $e->getJsonBody();
                $err = $body['error'];
                return redirect('/rooms/' . $request['listingid'])->with('error', '' . $err['message']);
            }

            //}
        }
        if (!isset($guestUserObj->stripe_cust_id) || $guestUserObj->stripe_cust_id == null || $guestUserObj->stripe_cust_id == '') {
            return redirect()->back()->with('error', 'Something went wrong... Please try again!');
        }


        $value = \Session::all()['bookingInfo'];
        $listingid = $request['listingid'];
        $listing = Listing::with('user')->findOrFail($listingid);
        $bookingObj = new Booking();

//		Check if

        $bookingObj->guest_id = auth()->user()->id;
        $bookingObj->listing_id = $listingid;
        $bookingObj->host_id = $listing->user_id;
        $bookingObj->number_of_guest = $request->guest;
        $bookingObj->date_from = date('Y-m-d', strtotime($value['date_from']));
        $bookingObj->date_to = date('Y-m-d', strtotime($value['date_to']));
        $bookingObj->status = 0;
        $bookingObj->amount = $request->amount;
        $bookingObj->service_charges = $request->serviceCharges;
        $bookingObj->comment = $request->commit;
        $charity = 0;
        if ($request->charity) {
            $newNumber = ceil($request->amount);
            $charity = $newNumber - $request->amount;
        }
        if ($request->manully) {
            $charity = $request->charitymanual;
        }
        $bookingObj->charity = number_format($charity, 2);

        $amount = round(($bookingObj->amount + $bookingObj->charity + $bookingObj->service_charges), 2) * 100;
        try {

            $charge = \Stripe\Charge::create([
                'amount' => $amount,
                'currency' => 'usd',
                'description' => '' . $request->commit,
                'customer' => $guestUserObj->stripe_cust_id,
                'capture' => false,
            ]);

        } catch (\Stripe\Error\Card $e) {
            // Since it's a decline, \Stripe\Error\Card will be caught
            $body = $e->getJsonBody();
            $err = $body['error'];
            return redirect('/rooms/' . $request['listingid'])->with('error', '' . $err['message']);

        } catch (\Stripe\Error\RateLimit $e) {
            // Too many requests made to the API too quickly
            $body = $e->getJsonBody();
            $err = $body['error'];
            return redirect('/rooms/' . $request['listingid'])->with('error', '' . $err['message']);
        } catch (\Stripe\Error\InvalidRequest $e) {
            // Invalid parameters were supplied to Stripe's API
            $body = $e->getJsonBody();
            $err = $body['error'];
            return redirect('/rooms/' . $request['listingid'])->with('error', '' . $err['message']);
        } catch (\Stripe\Error\Authentication $e) {
            // Authentication with Stripe's API failed
            // (maybe you changed API keys recently)
            $body = $e->getJsonBody();
            $err = $body['error'];
            return redirect('/rooms/' . $request['listingid'])->with('error', '' . $err['message']);
        } catch (\Stripe\Error\ApiConnection $e) {
            // Network communication with Stripe failed
            $body = $e->getJsonBody();
            $err = $body['error'];
            return redirect('/rooms/' . $request['listingid'])->with('error', '' . $err['message']);
        } catch (\Stripe\Error\Base $e) {
            // Display a very generic error to the user, and maybe send
            // yourself an email
            $body = $e->getJsonBody();
            $err = $body['error'];
            return redirect('/rooms/' . $request['listingid'])->with('error', '' . $err['message']);
        } catch (\Exception $e) {
            // Something else happened, completely unrelated to Stripe
            $body = $e->getJsonBody();
            $err = $body['error'];
            return redirect('/rooms/' . $request['listingid'])->with('error', '' . $err['message']);
        }

        $bookingObj->card_id = isset($charge) ? $charge->id : null;

        $bookingObj->save();


        try {
            /*Email Sent to Client or Room Seller*/
            $RoomeSellerEmail = $this->SparkController->getSparkTemplateId('RoomBookingClientEmail', Auth::user()->email, auth()->user()->first_name, '', '', '');
            /*Email Sent to Client or Room Seller*/
            $templates = $this->SparkController->getSparkTemplateId('RoomBookingHosttEmail', $listing->user->email, $listing->user->first_name, '', '', '');
        } catch (\Exception $ex) {

            // return redirect('/dashboard/trips')->with('error', ''.$ex->getMessage());

        }


        return redirect('/rooms/' . $request['listingid'])->with('success', 'your request has been sent to Host.');
    }

    /*.
     * Check out and proceed to payment Method
     * Escrow use holding payment
     * Deduction amount 15% from full payment
     * */
    public function checkout(Request $request)
    {
        //dd(\Session::all());

        $request = $request->all();
//        dd($result);
        //var_dump($result);
        //echo '>>>>>>>>>>';
        //\Log::info('>>>>>>>');
        //dd($request);
        $result = \Braintree_Transaction::releaseFromEscrow('fg65wtgy');
        //dd($request);

        $encryptlistid = decrypt($request['encryptlistid']);

        $cardExpiry = $request['cardExpiry'];
        $cardCVC = $request['cardCVC'];
        $cardNumber = $request['cardNumber'];

        $totalPayment = decrypt($request['encryptprice']);
        $totalPayment = number_format((7 / 1000) * $totalPayment, 2) + $totalPayment;
        $deductAmmount = number_format((15 / 100) * $totalPayment, 2);

        $firstname = 'Amir';
        $lastname = 'Shahzad';
        $email = 'amir.vbase@gmail.com';
        $phone = '03007272332';

        $plan_id = '4t8m';
        $subscribed = true;
        $masterMerchantAccountId = "rqp2ythbf7dydypn";

        $response = $this->createSubMerchantID();
        //dd($response);


//        $merchantAccountParams = [
//            'individual' => [
//                'firstName' => 'Jane',
//                'lastName' => 'Doe',
//                'email' => 'jane@14ladders.com',
//                'phone' => '5553334444',
//                'dateOfBirth' => '1981-11-19',
//                'ssn' => '456-45-4567',
//                'address' => [
//                    'streetAddress' => '111 Main St',
//                    'locality' => 'Chicago',
//                    'region' => 'IL',
//                    'postalCode' => '60622'
//                ]
//            ],
//            'business' => [
//                'legalName' => 'Janes Ladders',
//                'dbaName' => 'Janes Ladders',
//                'taxId' => '98-7654321',
//                'address' => [
//                    'streetAddress' => '111 Main St',
//                    'locality' => 'Chicago',
//                    'region' => 'IL',
//                    'postalCode' => '60622'
//                ]
//            ],
//            'funding' => [
//                'descriptor' => 'Blue Ladders',
//                'destination' => \Braintree_MerchantAccount::FUNDING_DESTINATION_BANK,
//                'email' => 'funding@blueladders.com',
//                'mobilePhone' => '5555555555',
//                'accountNumber' => '1123581321',
//                'routingNumber' => '071101307'
//            ],
//            'tosAccepted' => true,
//            'masterMerchantAccountId' => "vbase"
//        ];
//        $result = \Braintree_MerchantAccount::create($merchantAccountParams);


//        $result = \Braintree_Transaction::sale(
//            array(
//                'amount' => "100.00",
//                'merchantAccountId' => 'janesladders_instant_6ryz53m7',
//                'creditCard' => array(
//                    'number' => "4111111111111111",
//                    'expirationDate' => "12/2014",
//                ),
//                'options' => array(
//                    'holdInEscrow' => true,
//                ),
//                'serviceFeeAmount' => "40.00"
//            )
//        );

        $result = Braintree_Transaction::sale(
            array(
                'amount' => $totalPayment,
                'merchantAccountId' => 'janesladders_instant_6ryz53m7',
                'creditCard' => array(
                    'number' => "4111111111111111",
                    'expirationDate' => "12/2014",
                ),
                'options' => array(
                    'holdInEscrow' => true,
                ),
                'serviceFeeAmount' => $deductAmmount

            )
        );
        //echo "<pre>";
        //print_r("\n  message: " . $result->message);

        //$submerchantAccountArr = \Braintree_MerchantAccount::create($validParams);

        //dd($result->transaction->id);

        //$submerchandID =  $submerchantAccountArr->merchantAccount->id;
        //$submerchandID = 'robotcity_instant_r29dktnf';


        //$customer_id = $this->registerUserOnBrainTree($firstname ,$lastname , $email , $phone);

        //$card_token = $this->getCardToken($customer_id,$cardNumber,$cardExpiry,$cardCVC);

        //$transction_id = $this->createTransaction($card_token,$customer_id,$plan_id,$subscribed , $submerchandID , $totalPayment,$deductAmmount );


        //$result = \Braintree_Transaction::holdInEscrow($transction_id);
        //$result = \Braintree_Transaction::releaseFromEscrow($transction_id);


//		if ($transction_id != '') {
//			# Transaction successfully voided
//
//			$transaction = new transaction();
//
//			$transaction->card_token = $card_token;
//			$transaction->customer_id = $customer_id;
//			$transaction->amount = $totalPayment;
//			$transaction->transction_id = $transction_id;
//			$transaction->transction_time = date("Y-m-d H:i:s");
//			$transaction->status = 'Hold Pending';
//			$transaction->save();
//
//			Session::flash('Success', 'Your Transaction Has been Successfuly Transfer...');
//			$listing = Listing::with('user')->findOrFail($encryptlistid);
//			return view('listing.success' , compact('listing'));
//
//		} else {
//			Session::flash('Error', 'Sorry your Payment can not Transfer Please fill Correct Info');
//			return view('listing.success');
//		}


        //amir      robotcity_instant_r29dktnf
        // nabeel   robotcity_instant_8nxg5xbz


//		$result = \Braintree_Transaction::sale(
//			[
//				'amount' => '660.00',
//				'merchantAccountId' => 'robotcity_instant_r29dktnf',
//				'paymentMethodNonce' => 'fake-valid-nonce',
//				'options' => [
//					'submitForSettlement' => true,
//					'holdInEscrow' => true,
//				],
//				'serviceFeeAmount' => "40.00"
//			]
//		);
//
//		echo $result->transaction->escrowStatus;


//		$result = Braintree_Transaction::sale([
//			'merchantAccountId' => 'robotcity_instant_8nxg5xbz',
//			'amount' => '10.00',
//			'paymentMethodNonce' => 'fake-valid-nonce',
//			'options' => [
//					'submitForSettlement' => true,
//					'holdInEscrow' => true,
//				],
//			'serviceFeeAmount' => "1.00"
//		]);


        //$result = Braintree_Transaction::releaseFromEscrow('72558gtb');

//		$result = Braintree_Transaction::holdInEscrow('h1zfc9ag');
//		$result = \Braintree_Transaction::releaseFromEscrow('9feqgqcy');
        //dd($result);
        //exit;


//		$result = \Braintree_Transaction::sale(
//			[
//				'amount' => '220.00',
//				'merchantAccountId' => 'nabeelqadri',
//				'paymentMethodNonce' => 'fake-valid-nonce',
//				'options' => [
//					'submitForSettlement' => true,
//					'holdInEscrow' => true,
//				],
//				'serviceFeeAmount' => "40.00"
//			]
//		);

        //echo $result->transaction->escrowStatus;
        //dd($result);
        //exit;


        //This Plan Id Created fro BrainTree Account


    }

    /*
     * Release Escrow payment
     * get data fro trabsaction table
     *
     * */
    public function releaseescrow()
    {
        $date = date("Y-m-d H:m:s", strtotime('-24 hours', time()));
        $Trasaction = new transaction();
        $transaction = $Trasaction->whereDate('transction_time', '<', $date)->get();
        //dd($transaction);
        if (!empty($transaction) && count($transaction) > 0) {
            foreach ($transaction as $release):
                //echo $release->transction_id;
                $result = Braintree_Transaction::releaseFromEscrow($release->transction_id);
                if ($result->success == 'true') {
                    $transaction->where('transction_id', $release->transction_id)
                        ->update(['status' => 'Released']);
                    $hostObj = User::find($release->user_id);

                    try {
                        /*Email Sent to Client or Room Seller when Accept */
                        $templates = $this->SparkController->getSparkTemplateId('paymentStatusReleaseEscrowEmail', $hostObj->email, $hostObj->first_name, '', '', '');
                    } catch (\Exception $ex) {
                    }


                } else {
                    echo 'Sorry..! There is Not Pending Transaction';
                }
            endforeach;
            echo 'Congratulation..! Pending Transaction Released Successfully';
        } else {
            echo 'Sorry..! There is Not Pending Transaction';
        }
        //dd($result);

    }

    public function registerUserOnBrainTree($firstname, $lastname, $email, $phone)
    {
        $result = Braintree_Customer::create(array(
            'firstName' => $firstname,
            'lastName' => $lastname,
            'email' => $email,
            'phone' => $phone
        ));
        if ($result->success) {
            return $result->customer->id;
        } else {
            $errorFound = '';
            foreach ($result->errors->deepAll() as $error) {
                $errorFound .= $error->message . "<br />";
            }
            echo $errorFound;
        }
    }

    public function getCardToken($customer_id, $cardNumber, $cardExpiry, $cardCVC)
    {
        $card_result = \Braintree_CreditCard::create(array(
//'cardholderName' => mysql_real_escape_string($_POST['full_name']),
            'number' => $cardNumber,
            'expirationDate' => trim($cardExpiry),
            'customerId' => $customer_id,
            'cvv' => $cardCVC
        ));

        //dd($card_result);
        if ($card_result->success) {

            return $card_result->creditCard->token;
        } else {
            return false;
        }
    }

    public function createTransaction($creditCardToken, $customerId, $planId, $subscribed, $submerchandID, $totalPayment, $deductAmmount)
    {
        if ($subscribed) {
            $subscriptionData = array(
                'paymentMethodToken' => $creditCardToken,
                'planId' => $planId
            );
            $this->cancelSubscription();
            $subscription_result = Braintree_Subscription::create($subscriptionData);
            //dd($subscription_result);
            echo 'Subscription id' . $subscription_result->subscription->id;
            echo '<br>';
        } else {
            $this->cancelSubscription();
        }
        $result = \Braintree_Transaction::sale(
            [
                'customerId' => $customerId,
                'amount' => $totalPayment,
                'merchantAccountId' => $submerchandID,
                'paymentMethodNonce' => 'fake-valid-nonce',
                'options' => [
                    'submitForSettlement' => true,
                    'holdInEscrow' => true,
                ],
                'serviceFeeAmount' => $deductAmmount
            ]
        );

        //$result = \Braintree_Transaction::holdInEscrow('m4s5vf2d');
        //dd($result);
        if ($result->success) {
            return $result->transaction->id;
        } else {
            $errorFound = '';
            foreach ($result->errors->deepAll() as $error1) {
                $errorFound .= $error1->message . "<br />";
            }
        }
    }

    public function cancelSubscription()
    {
        $gateway_subscription_id = '';
        if ($gateway_subscription_id != '') {
            Braintree_Subscription::cancel($gateway_subscription_id);
        }
    }

//// for subscription Braintree_WebhookNotification
    public function subscription()
    {
        try {
            if (isset($_POST["bt_signature"]) && isset($_POST["bt_payload"])) {
                $webhookNotification = Braintree_WebhookNotification::parse(
                    $_POST["bt_signature"], $_POST["bt_payload"]
                );// $message =
// "[Webhook Received " . $webhookNotification->timestamp->format('Y-m-d H:i:s') . "] "
// . "Kind: " . $webhookNotification->kind . " | "
// . "Subscription: " . $webhookNotification->subscription->id . "\n";Log::info("msg " . Log::info("subscription " . json_encode($webhookNotification->subscription));
                Log::info("transactions " . json_encode($webhookNotification->subscription->transactions));
                Log::info("transactions_id " . json_encode($webhookNotification->subscription->transactions[0]->id));
                Log::info("customer_id " . json_encode($webhookNotification->subscription->transactions[0]->customerDetails->id));
                Log::info("amount " . json_encode($webhookNotification->subscription->transactions[0]->amount));
            }
        } catch (\Exception $ex) {
            Log::error("PaymentController::subscription() " . $ex->getMessage());
        }
    }

    public function createSubMerchantID()
    {
        $contactInfo = UserPayout::where('user_id', auth()->user()->id)->first();
        $merchantAccountParams = [
            'individual' => [
                'firstName' => auth()->user()->first_name,
                'lastName' => auth()->user()->last_name,
                'email' => auth()->user()->email,
                'phone' => $contactInfo->mobile_phone,
                'dateOfBirth' => auth()->user()->date_of_birth,
                'address' => [
                    'streetAddress' => $contactInfo->street_address,
                    'locality' => $contactInfo->locality,
                    'region' => $contactInfo->region,
                    'postalCode' => $contactInfo->postal_code
                ]
            ],
            'funding' => [
                'descriptor' => $contactInfo->descriptor,
                'destination' => \Braintree_MerchantAccount::FUNDING_DESTINATION_BANK,
                'email' => $contactInfo->email,
                'mobilePhone' => $contactInfo->mobile_phone,
                'accountNumber' => $contactInfo->account_number,
                'routingNumber' => $contactInfo->rounting_number
            ],
            'tosAccepted' => true,
            'masterMerchantAccountId' => "vbase"
        ];
        $result = \Braintree_MerchantAccount::create($merchantAccountParams);
        if ($result->success) {
            $userObj = User::find(auth()->user()->id);
            $userObj->sub_merchant_id = $result->merchantAccount->id;
            $userObj->save();
            return 1;
        } else {
            return $result->message;
        }

    }

    public function paymentMethodView()
    {
        $user_id = auth()->user()->id;
        $userPayoutInfo = UserPayout::where('user_id', $user_id)->first();
        return view('listing.method')->with('userPayoutInfo', $userPayoutInfo);
    }

    public function savePayOutMethod(Request $request)
    {
        $rules = [
            'street_address' => 'required',
            'locality' => 'required',
            'region' => 'required',
            'postal_code' => 'required',
            'descriptor' => 'required',
            'email' => 'required',
            'mobile_phone' => 'required',
            'account_number' => 'required',
            'rounting_number' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('/dashboard/method')->withErrors($validator)->withInput();
        }

        $user_id = auth()->user()->id;
        $Info = UserPayout::where('user_id', $user_id)->first();
        if ($Info) {
            $Info->user_id = $user_id;
            $Info->street_address = $request->street_address;
            $Info->locality = $request->locality;
            $Info->region = $request->region;
            $Info->postal_code = $request->postal_code;
            $Info->descriptor = $request->descriptor;
            $Info->email = $request->email;
            $Info->mobile_phone = $request->mobile_phone;
            $Info->account_number = $request->account_number;
            $Info->rounting_number = $request->rounting_number;
            $Info->update();

        } else {

            $payoutObj = new UserPayout();
            $payoutObj->user_id = $user_id;
            $payoutObj->street_address = $request->street_address;
            $payoutObj->locality = $request->locality;
            $payoutObj->region = $request->region;
            $payoutObj->postal_code = $request->postal_code;
            $payoutObj->descriptor = $request->descriptor;
            $payoutObj->email = $request->email;
            $payoutObj->mobile_phone = $request->mobile_phone;
            $payoutObj->account_number = $request->account_number;
            $payoutObj->rounting_number = $request->rounting_number;
            $payoutObj->save();
        }
        $response = 1;
        $userInfo = User::find($user_id);
        if (!$userInfo->sub_merchant_id) {
            $response = $this->createSubMerchantID();
        }

        if ($response == 1) {
            return back()->with('message', 'Record Created Successfully!');

        } else {
            return back()->with('error', $response);
        }
    }

    public function paymentInMethodView()
    {
        $user_id = auth()->user()->id;
        $userPaymentInfo = UserPayment::where('user_id', $user_id)->first();

        return view('pages.checkout');
    }

    public function savePaymentMethod(Request $request)
    {
        $rules = [
            'card_number' => 'required',
            'month' => 'required',
            'year' => 'required',
            'fname' => 'required',
            'lname' => 'required',
            'pcode' => 'required',
            'cardcountry' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('/dashboard/payment')->withErrors($validator)->withInput();
        }

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        if (isset(\Auth::user()->stripe_cust_id) && \Auth::user()->stripe_cust_id != '') {
            $cu = \Stripe\Customer::retrieve(\Auth::user()->stripe_cust_id);
            $cu->description = "Stripe Customer for ID: " . \Auth::user()->id . " | Email: " . \Auth::user()->email;
            $cu->source = $request->stripeToken; // obtained with Stripe.js
            $cu->save();
        } else {
            $customer = \Stripe\Customer::create(array(
                "description" => "Stripe Customer for ID: " . \Auth::user()->id . " | Email: " . \Auth::user()->email,
                "source" => $request->stripeToken // obtained with Stripe.js
            ));
            $user = User::find(auth()->user()->id);
            $user->stripe_cust_id = $customer->id;
            $user->save();
        }
        return back()->with('successNotice', 'Record Created Successfully!');
    }

    public function changeStatus($id, $cardId = null)
    {
        /*     BOOKING STATUSES
        * ************************
        *  0 = Pending
        *  1 = Accepted
        *  2 = Released
        *  3 = Cancelled
        *  4 = Refunded
        * *************************/

        try {
            $bookingObj = Booking::find($id);
            $clientObj = User::find($bookingObj->guest_id);
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            if (isset($clientObj->stripe_cust_id) && $clientObj->stripe_cust_id != null) {

                // Set your secret key: remember to change this to your live secret key in production
                // See your keys here: https://dashboard.stripe.com/account/apikeys

                if (isset($bookingObj->card_id)) {
                    $charge = \Stripe\Charge::retrieve($bookingObj->card_id);
                    $charge->capture();
                } else {
                    return redirect()->back()->with('error', 'We updated the security of our website, please tell your guest to resubmit new booking request, Sorry for inconvenience');

                }

                if ($charge->id) {
                    $tran = new TransactionModel();
                    $tran->user_id = auth()->user()->id;    // ==> HOST ID
                    $tran->list_id = $bookingObj->listing_id;
                    $tran->amount = ($bookingObj->amount + $bookingObj->charity + $bookingObj->service_charges);
                    $tran->transction_id = $charge->id;
                    $tran->status = $charge->status;
                    $tran->transction_time = Carbon::now();
                    $tran->save();
                    $bookingObj->status = 2;    // ==> Amount Paid For Booking
                    $bookingObj->transaction_id = $tran->id;
                    $bookingObj->save();
                } else {
                    return redirect()->back()->with('error', $charge->message);
                }
            } else {
                return redirect()->back()->with('error', 'Guest have not added any payment info!');
            }
            try {
                /*Email Sent to Client or Room Seller when Accept */
                $templates = $this->SparkController->getSparkTemplateId('RoomBookingAcceptRejectEmilclient', $clientObj->email, $clientObj->first_name, '', '', '');
                /*Email Sent to Client or Room Seller when Accept*/
                $RoomeSellerEmail = $this->SparkController->getSparkTemplateId('RoomBookingAcceptRejectEmilhost', Auth::user()->email, auth()->user()->first_name, '', '', '');
            } catch (\Exception $ex) {
//                dd($ex);
//return redirect()->back()->with('error','Guest : ' . $ex->getMessage(). '  LINE: '.$ex->getLine()  );

            }
            return redirect('/dashboard/reservations')->with('success', 'Request Status has been changed.');
        } catch (\Exception $e) {
            \Log::info('>>>>>>>>>>>>>> ERROR in PaymentController->changeStatus function   >>>>>>>>>>>>>>>>>');
            \Log::info('Line # ' . $e->getLine());
            \Log::info('Message : ' . $e->getMessage());
            \Log::info('>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>');
            return redirect()->back()->with('error', 'Guest : ' . $e->getMessage() . '  LINE: ' . $e->getLine());


        }
    }


    public function cardConfirmation($id, Request $request)
    {
        $infoArray = explode('-', $id);
        $id = $infoArray[0];
        $request->session()->put('booking_id', $infoArray[1]);
        $listing = Listing::with('user')->findOrFail($id);
        $user_id = auth()->user()->id;
        $userPaymentInfo = UserPayment::where('user_id', $user_id)->first();
        return view('listing.paying', compact('listing', 'userPaymentInfo'));

    }

    public function showCheckout(Request $request)
    {
        $cardExpiryMonth = $request->cardExpiryMonth;
        $cardExpiryYear = $request->cardExpiryYear;
        $cardExpiry = $cardExpiryMonth . '/' . $cardExpiryYear;
        $cardCVC = $request->cardCVC;
        $cardNumber = $request->cardNumber;

        $validator = Validator::make($request->all(), [
            'cardNumber' => 'required',
            'cardExpiryMonth' => 'required',
            'cardExpiryYear' => 'required',
            'cardCVC' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $listingid = $request['listingid'];
        $encryptlistid = encrypt($listingid);
        $listing = Listing::with('user')->findOrFail($listingid);
        $encryptprice = encrypt($listing->price);
        return view('listing.checkout', compact('listing', 'encryptlistid', 'encryptprice', 'cardExpiry', 'cardCVC', 'cardNumber'));

    }


    public function sale($booking_id, $cardId)
    {
        try {
            //$booking_id = $request->booking_id;
            $bookingInfo = Booking::find($booking_id);
            if (isset($cardId) && $cardId != null) {
                $guestPaymentInfo = UserPayment::where('user_id', $bookingInfo->guest_id)->where('id', $cardId)->first();
            } else {
                $guestPaymentInfo = UserPayment::where('user_id', $bookingInfo->guest_id)->orderBy('id', 'desc')->first();
            }
            $hostSubMerchant = User::find($bookingInfo->host_id)['sub_merchant_id'];
//            dump('*********************');
//            dump($guestPaymentInfo);
//            dump('*********************');
//            dump($hostSubMerchant);
//            dd('*********************');

            if (!isset($guestPaymentInfo) || count($guestPaymentInfo) < 0 || !isset($hostSubMerchant) || $hostSubMerchant == '') {
                return collect([
                    'status' => 'error',
                    'msg' => 'No Payout Method Added Yet! ' . "<a href=" . \URL::to('dashboard/method') . ">" . \URL::to('dashboard/method') . "</a>"
                ]);
            }

            $listingInfo = Listing::where('id', $bookingInfo->listing_id)->first();
            $cardExpiry = $guestPaymentInfo->month . '/' . $guestPaymentInfo->year;
            $cardNumber = $guestPaymentInfo->card_number;
            $cardName = $guestPaymentInfo->first_name . ' ' . $guestPaymentInfo->last_name;
            $totalPayment = $bookingInfo->amount;
//            $actualPayableToHost    = $bookingInfo->amount + $bookingInfo->service_charges;   // Old Method
            $actualPayableToMuzbnb = $bookingInfo->amount + $bookingInfo->service_charges;     // New Method
            $muzbnbCharges = $bookingInfo->service_charges * 2;
            //        $totalPayment         = number_format((7/1000)*$totalPayment,2) + $totalPayment;
            //        $deductAmmount        = number_format((15/100)*$totalPayment , 2);

            // OLD METHOD
//            $result = Braintree_Transaction::sale(
//                array(
//                    'amount' => $actualPayableToHost,
//                    'merchantAccountId' => $hostSubMerchant,
//                    'creditCard' => array(
//                        'number' => $cardNumber,
//                        'expirationDate' => $cardExpiry,
//                        'cardholderName' => $cardName
//                    ),
//                    'options' => array(
//                        'submitForSettlement' => true,
//                        'holdInEscrow' => true
//                    ),
//                    'serviceFeeAmount' => $muzbnbCharges
//                )
//            );

            // NEW METHOD
            $result = Braintree_Transaction::sale(
                array(
                    'amount' => $actualPayableToMuzbnb,
                    'creditCard' => array(
                        'number' => $cardNumber,
                        'expirationDate' => $cardExpiry,
                        'cardholderName' => $cardName
                    ),
                    'options' => array(
                        'submitForSettlement' => true
                    )
                )
            );
//            dd($result);
            if ($result->transaction) {
//                if($result->transaction->status == 'authorized' || $result->transaction->status == 'submittedForSettlement'){
//                    $escrow = Braintree_Transaction::holdInEscrow($result->transaction->id);
//                    dd($escrow);
//                }

                $bookingObj = Booking::find($booking_id);
                $tran = new TransactionModel();
                $tran->user_id = auth()->user()->id;
                $tran->list_id = $bookingObj->listing_id;
                $tran->amount = ($bookingInfo->amount + $bookingInfo->service_charges);
                $tran->transction_id = $result->transaction->id;
                $tran->status = isset($result->transaction->escrowStatus) && $result->transaction->escrowStatus != null ? $result->transaction->escrowStatus : 'submitted';
                $tran->transction_time = Carbon::now();
                $tran->save();

                $bookingObj = Booking::find($booking_id);
                $bookingObj->status = 2;
                $bookingObj->transaction_id = $tran->id;
                $bookingObj->save();
                $hostObj = User::find(auth()->user()->id);
                try {
                    /*Email Sent to Client or Room Seller when Accept */
                    $templates = $this->SparkController->getSparkTemplateId('paymentStatusEscrowEmail', $hostObj->email, $hostObj->first_name, '', '', '');
                } catch (\Exception $ex) {
                }


                return collect([
                    'status' => 'success',
                    'transId' => $tran->transction_id
                ]);
            } else {
                return collect([
                    'status' => 'error',
                    'msg' => $result->message
                ]);
            }
            //return redirect('/dashboard/trips')->with('success','Transaction Submitted Successfully.');
        } catch (\Exception $e) {
            return collect([
                'status' => 'error',
                'msg' => $e->getMessage(),
                'code' => $e->getCode(),
                'line' => $e->getLine()
            ]);
//            dd($e);
//            \Log::info('>>>>>>>>>>>>>> ERROR in PaymentController->sale function   >>>>>>>>>>>>>>>>>');
//            \Log::info('Line # ' . $e->getLine());
//            \Log::info('Message : ' . $e->getMessage());
//            \Log::info('>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>');
        }

    }

    public function cancelbooking($id)
    {
        $bookingObj = (new Booking())->find($id);
        $bookingObj->status = 3;
        $bookingObj->save();

        $clientObj = User::find($bookingObj->guest_id);
        try {
            /*Email Sent to Client or Room Seller when Accept */
            $templates = $this->SparkController->getSparkTemplateId('RoomBookingAcceptRejectEmilclient', $clientObj->email, $clientObj->first_name, '', '', '');
            /*Email Sent to Client or Room Seller when Accept*/
            $RoomeSellerEmail = $this->SparkController->getSparkTemplateId('RoomBookingAcceptRejectEmilhost', Auth::user()->email, auth()->user()->first_name, '', '', '');
        } catch (\Exception $ex) {
        }


        // return redirect('/dashboard/booking')->with('success','Booking Cancelled Successfully.');
        return \GuzzleHttp\json_encode("true");
    }


    public function ccMasking($number, $maskingCharacter = 'X')
    {
        return substr($number, 0, 0) . str_repeat($maskingCharacter, strlen($number) - 4) . substr($number, -4);
    }

    public function reservationStatus($bId)
    {
        if (isset($bId) && $bId != '') {
            $booking = Booking::find($bId);
            if ($booking->guest_id == \Auth::user()->id) {
                $listing = Listing::find($booking->listing_id);
                $user_id = auth()->user()->id;
                $userPaymentInfo = UserPayment::where('user_id', $user_id)->get();
                foreach ($userPaymentInfo as $i => $v) {
                    $v->maskedCardNumber = $this->ccMasking($v->card_number, '*');
                }
                $allRules = ListingRule::whereNull('listing_id')->orwhere('listing_id', $listing->id)->get();
                $listingRules = [];
                foreach ($listing->rules as $rule) {
                    $listingRules[] = $rule->id;
                }
                $start_date = Carbon::parse($booking->date_from);
                $end_date = Carbon::parse($booking->date_to);
                $final = $end_date->diffInDays($start_date);
                if ($final == 0) {
                    $final = 1;
                }
                $booking['totaldays'] = $final;
                if ($booking->status == 1) {
                    return view('pages.addPaymentInfo')->with('userPaymentInfo', $userPaymentInfo)->with('listing', $listing)->with('allRules', $allRules)->with('listingRules', $listingRules)->with('booking', $booking);
                } else {
                    return view('pages.addPaymentInfo')->with('userPaymentInfo', $userPaymentInfo)->with('listing', $listing)->with('allRules', $allRules)->with('listingRules', $listingRules)->with('booking', $booking)->with('error', 'Payment already made for this booking!');
                }
            }
        }
    }

    public function payWithStripe(Request $request)
    {
        try {
            $booking = Booking::find($request->bookingId);
            $listing = Listing::find($booking->listing_id);
            // Set your secret key: remember to change this to your live secret key in production
            // See your keys here: https://dashboard.stripe.com/account/apikeys
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            $amount = round(($booking->amount + $booking->charity + $booking->service_charges), 2) * 100;
            // Charge the user's card:
            $charge = \Stripe\Charge::create(array(
                "amount" => $amount,
                "currency" => "usd",
                "description" => "PAYMENT FOR BOOKING ID # " . $booking->id . ".",
                "source" => $request->stripeToken,
            ));

            if ($charge->id) {
                $tran = new TransactionModel();
                $tran->user_id = auth()->user()->id;
                $tran->list_id = $booking->listing_id;
                $tran->amount = ($booking->amount + $booking->charity + $booking->service_charges);
                $tran->transction_id = $charge->id;
                $tran->status = $charge->status;
                $tran->transction_time = Carbon::now();
                $tran->save();
                $booking->status = 2;
                $booking->transaction_id = $tran->id;
                $booking->save();
                return redirect('/dashboard/trips')->with('success', 'Payment Successful!');
            } else {
                return redirect()->back()->with('error', $charge->message);
            }
        } catch (\Exception $e) {
            dd($e);
        }
    }

}