<?php

namespace App\Mail;

use App\Models\Orders;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Hash;
use App\Models\Members;

class SendFile extends Mailable
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
        $file = $this->order->file_type.'_file';
        $user_details = Members::find($this->order->member_id);

        //return $this->view('emails.send_file')->attach(base_path('../assets/public/files/').$this->order->productable->$file);
        return $this->subject($this->order->productable->name)->view('emails.send_file')->with('order',$this->order)->with('user_details',$user_details);
    }
}
