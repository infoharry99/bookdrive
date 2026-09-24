<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StudentAssignedMail extends Mailable
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
        return $this->subject('Your Tutor Has Been Assigned')
                    ->view('emails.student_assigned');
    }
}
