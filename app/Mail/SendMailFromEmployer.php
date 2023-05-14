<?php
  
namespace App\Mail;
   
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
  
class SendMailFromEmployer extends Mailable
{
    use Queueable, SerializesModels;
  
    public $data;
   
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }
   
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('superadmin2@app.com')->subject('Online Jobs Login Crendential')
                    ->view('admin.part_time_employer.mail_send')->with('data', $this->data);;
    }
}