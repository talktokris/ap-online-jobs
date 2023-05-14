<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class EmployersSelectedGWConfirmByAgent extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data,$name)
    {
        $this->data = $data;
        $this->name= $name;
    }

    private $data;
    private $name;

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
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
                    ->line($this->name)
                    ->line('You have received confirmation/finalization from the Ap Online Jobs for the resume/bio data that you have selected. Please login to the link below.')
                    ->action('Login',route('employer.login'))
                    ->line('Thank you for using Onlinejobs!');
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
            'message' => 'GW Confirmed by agent!!',
            'link' => route('demand', $this->data->id),
        ];
    }
}
