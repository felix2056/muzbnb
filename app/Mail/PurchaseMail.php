<?php

namespace App\Mail;

use App\Models\License;
use App\Models\Orders;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Hash;
use App\Models\Members;

class PurchaseMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $license;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Orders $order, License $license)
    {
        $this->order = $order;
        $this->license = $license;
    }

    public function build()
    {
        $user_details = Members::find($this->order->member_id);

        return $this->subject($this->order->productable->name)->view('emails.purchase')->with('order',$this->order)->with('license',$this->license)->with('user_details',$user_details);
    }
}
