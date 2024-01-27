<?php
  
namespace App\Mail;
  
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
// use App\Models\User;
use App\Models\User as UserModel;
  
class SendEmailLogin extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    /**
     * Create a new message instance.
     */
    public function __construct(UserModel $user)
    {
        $this->user = $user;  
    }
  

     /**
     * Build the message.
     */
    public function build(): self
    {
        return $this->view('emails.login')
                    ->subject('Mail from Laravel Jobs');
                    // ->with(['user' => $this->user]); 
                    // Pass $user to the view
    }


    /**
     * Get the message envelope.
     */
    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         subject: 'Mail from Laravel Events',
    //     );
    // }
  
    /**
     * Get the message content definition.
     */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'emails.login',
    //     );
    // }
  
    /**
     * Get the attachments for the message.
     *
     * @return array

     */
    // public function attachments(): array
    // {
    //     return [];
    // }
}