<?php

namespace App\Mail;
use App\Programme;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class JoinProgramme extends Mailable
{
    use Queueable, SerializesModels;
    public $programme;
    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Programme $programme, User $user)
    {
        $this->programme = $programme;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('mail@lifthub.com', 'LiftHub')
        ->subject('Joined Programme')
        ->markdown('emails.join-programme')
        ->with([
            'name' => $this->user->first_name,
            'link' => \URL::to('/').'/dashboard'
        ]);
    }
}
