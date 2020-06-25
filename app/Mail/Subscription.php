<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Models\Orders;
use App\Models\Members;

class Subscription extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Orders $order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user_details = Members::find($this->order->member_id);

        return $this->subject($this->order->productable->subscription_name)->view('emails.subscribed')->with('order',$this->order)->with('user_details',$user_details);
    }
}
