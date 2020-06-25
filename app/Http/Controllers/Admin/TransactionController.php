<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Model\AdminProfile;
use App\Model\Booking;
use App\Model\Notification;
use App\Model\TransactionModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    function __construct() {
        $this->middleware('auth:admin');
        $this->transaction = new TransactionModel();
    }

    public function getAll() {
        try {
            $transactions = $this->transaction->with('listing', 'user')->get();
//            dd($transactions);
            return view('admin.transactions.transaction', ['transactions' => $transactions]);
        } catch (\Exception $e) {
            dd($e);
        }
    }

}