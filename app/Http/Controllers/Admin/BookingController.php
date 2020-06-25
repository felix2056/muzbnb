<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Model\AdminProfile;
use App\Model\Booking;
use App\Model\Notification;
use App\Model\TransactionModel;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Braintree_Transaction;
use Braintree_Customer;
use Braintree_WebhookNotification;
use Braintree_Subscription;
use Braintree_CreditCard;

class BookingController extends Controller
{
    function __construct() {
        $this->middleware('auth:admin');
        $this->booking = new Booking();
        $this->transaction = new TransactionModel();
        $this->user = new User();
    }

    public function getAll() {
        try {
            $bookings = $this->booking->with('listing', 'guestInfo', 'hostInfo', 'transaction')->get();
//            dd($bookings);
            return view('admin.bookings.booking', ['bookings' => $bookings]);
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function refund(Request $request) {
        try {
            // Set your secret key: remember to change this to your live secret key in production
            // See your keys here: https://dashboard.stripe.com/account/apikeys
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            $result = \Stripe\Refund::create(array(
                "charge" => $request->id,
            ));
            //$result = Braintree_Transaction::refund($request->id);
//            dd($result);
            if($result->status == 'succeeded') {
                $transaction = $this->transaction->where('transction_id', '=', $request->id)->first();
                $transaction->refund = 1;
                $transaction->save();
                $booking = $this->booking->where('transaction_id', '=', $transaction->id)->first();
                $booking->status = 4;
                $booking->save();
                return collect([
                    'status' => 'success',
                    'msg' => 'Amount Refunded Successfully!',
                    'code' => 200
                ]);
            } else {
                return collect([
                    'status' => 'error',
                    'msg' => 'Something went wrong!',
                    'code' => 404
                ]);
            }
        } catch (\Exception $e) {
            return collect([
                'status' => 'error',
                'msg' => $e->getMessage(),
                'code' => $e->getCode()
            ]);
        }
    }

    public function cancelBooking(Request $request) {
        try {
            $bookingObj = $this->booking->find($request->id);
            if(count($bookingObj) > 0) {
                $bookingObj->status = 3;
                $bookingObj->save();
                return collect([
                    'status' => 'success',
                    'msg' => 'Booking Cancelled!',
                    'code' => 200
                ]);
            }
//            $clientObj = User::find($bookingObj->guest_id);
//            /*Email Sent to Client or Room Seller when Accept */
//            $templates = $this->SparkController->getSparkTemplateId('RoomBookingAcceptRejectEmilclient', $clientObj->email, $clientObj->first_name ,'', '','');
//            /*Email Sent to Client or Room Seller when Accept*/
//            $RoomeSellerEmail = $this->SparkController->getSparkTemplateId('RoomBookingAcceptRejectEmilhost', Auth::user()->email, auth()->user()->first_name ,'', '','');
        } catch (\Exception $e) {
            return collect([
                'status' => 'error',
                'msg' => $e->getMessage(),
                'code' => $e->getCode()
            ]);
        }
    }

    public function release(Request $request) {
        try {
            $bookingId = $request->bookingid;
            $hostId = $request->hostid;
            $amount = (string)$request->amount;

            $host = $this->user->find($hostId);
            $booking = $this->booking->where('id', '=', $request->bookingid)->first();

            \PaymentRails\Configuration::publicKey(env('PAYMENT_RAILS_ACCESS_KEY'));
            \PaymentRails\Configuration::privateKey(env('PAYMENT_RAILS_SECRET_KEY'));
            \PaymentRails\Configuration::environment(env('PAYMENT_RAILS_ENVIRONMENT'));

            $response = \PaymentRails\Batch::create([
                'sourceCurrency' => 'USD',
                'payments' => [
                    [
                        'recipient' => [ 'id' => $host->recipient_id ],
                        'sourceAmount' => $amount,
                        'memo' => ''
                    ]
                ]
            ]);
//            dd($response);
            if ($response && count($response) > 0) {
                $booking->status = 2;
                $booking->save();
                return collect([
                    'status' => 'success',
                    'msg' => 'Amount Released Successfully!',
                    'code' => 200
                ]);
            } else {
                return collect([
                    'status' => 'error',
                    'msg' => 'Something went wrong!',
                    'code' => 404
                ]);
            }

        } catch (\Exception $e) {
            return collect([
                'status' => 'error',
                'msg' => $e->getMessage(),
                'code' => $e->getCode(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ]);
        }
    }

}