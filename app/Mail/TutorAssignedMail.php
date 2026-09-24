<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TutorAssignedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $tutor;
    public $student;

    public function __construct($tutor, $student)
    {
        $this->tutor = $tutor;
        $this->student = $student;
    }

    public function build()
    {
        return $this->subject('New Student Assigned to You')
                    ->view('emails.tutor_assigned');
    }
}
