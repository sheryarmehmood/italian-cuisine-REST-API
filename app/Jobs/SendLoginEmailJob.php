<?php
  
namespace App\Jobs;
  
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\SendEmailLogin;
use Mail;
// use App\Models\User;
use App\Models\User as UserModel;  

class SendLoginEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
  
    // protected $details;
    
    protected $user;

    /**
     * Create a new job instance.
     */
    public function __construct(UserModel $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $email = new SendEmailLogin($this->user);
        Mail::to($this->user->email)->send($email);
    }

    /**
     * Create a new job instance.
     */
    // public function __construct($details)
    // {
    //     $this->details = $details;
    // }
  
    /**
     * Execute the job.
     */
    // public function handle(): void
    // {
    //     $email = new SendEmailLogin();
    //     Mail::to($this->details['email'])->send($email);
    // }


}