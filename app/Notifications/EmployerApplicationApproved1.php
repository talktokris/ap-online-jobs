<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class EmployerApplicationApproved1 extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($password,$email,$name)
    {
        // dd('test');
        // $this->data = $data;
        $this->password = $password;
        $this->email = $email;
        $this->name = $name;
    }

    // private $data;
    private $password;
    private $email;
    private $name;

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
                    ->line($this->name)
                    ->line('Congratulation ! Your applicattion has been approved.')
                    ->line('Use following credential to login into the system:')
                    ->line('Username: ' . $this->email)
                    ->line('Password: ' . $this->password)
                    ->action('Login',route('employer.login'))
                    ->line('Please login and change your password.')
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
           
        ];
    }
}
