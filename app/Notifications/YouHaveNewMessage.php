<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class YouHaveNewMessage extends Notification
{
    use Queueable;

    protected $data;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
        ->level('success')
        ->greeting('Hello '.$notifiable->name)
        ->from('no-reply@muzbnb.com', 'MuzBNB')
        ->subject('You have a new message from ' .$this->data['user']['name'])
        ->line($this->data['message']['body'])
        // ->action('Login', url($url))
        ->salutation('Best Regards From Muzbnb Staff');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message' => 'You have a new message from ' . $this->message['user'],
            'link' => '/dashboard/messages/',
            'icon' => 'fa fa-envelope text-aqua'
        ];
    }
}
