<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // mailtype : 1 = welcome/registration, 2 = trial class booking, 3 = trial class confirmed, 4 = enrollment
        if($this->details['mailtype'] == 1)
            return $this->view('emails.welcome')
            ->subject('Welcome Onboard')
                    ->with([
                        'user_name'     => $this->details['name'],
                        'email'         => $this->details['email'],
                        'user_mobile'   => $this->details['mobile'],
                        'user_password' => $this->details['password'],
                    ]);

        if($this->details['mailtype'] == 2)
                    return $this->view('emails.trialbooked')
                    ->subject('Trial Class Booked Successfully!')
                    ->with([
                    'user_name'  => $this->details['name'],
                    'slot_1'     => $this->details['slot_1'],
                    'slot_2'     => $this->details['slot_2'],
                    'slot_3'     => $this->details['slot_3'],
                    'tutor_name' => $this->details['tutor_name'],
                    ]);
        if($this->details['mailtype'] == 3)
                    return $this->view('emails.trialconfirmed')
                    ->subject('Trial Class Confirmed!')
                    ->with([
                    'user_name' => $this->details['name'],
                    'confirmed_slot' => $this->details['confirmed_slot'],
                    'tutor_name' => $this->details['tutor_name'],
                    ]);
        if($this->details['mailtype'] == 4)
                    return $this->view('emails.enrolled')
                    ->subject('Enrollment Successfull!')
                    ->with([
                    'user_name' => $this->details['name'],
                    'total_classes' => $this->details['total_classes'],
                    'tutor_name' => $this->details['tutor_name'],
                    ]);
         if($this->details['mailtype'] == 5)
            return $this->view('emails.earlytest')
            ->subject('Early Driving Test Enquiry!')
            ->with([
                 'user_name' => $this->details['name'],
                 'email' => $this->details['email'],
                 'number' => $this->details['phone'],
                'test_centres' => $this->details['test_centres'],
                'center1' => $this->details['center1'],
                'center2' => $this->details['center2'],
                'center3' => $this->details['center3'],
                'number' => $this->details['phone'],
                'latest_date' => $this->details['latest_date'],
                'license_number' => $this->details['license_number'],
                'theory_number' => $this->details['theory_number'],
                'earliest_date' => $this->details['earliest_date']
            ]);
         if($this->details['mailtype'] == 6)
            return $this->view('emails.admin')
            ->subject('New User Request!')
            ->with([
                 'user_name'     => $this->details['name'],
                 'user_mobile'   => $this->details['mobile'],
                 'user_password' => $this->details['password']
            ]);
            
        if($this->details['mailtype'] == 7)
            return $this->view('emails.newuser')
            ->subject('New User Request!')
            ->with([
                'name'  =>  $this->details['name'],
                'phone' =>  $this->details['phone'],
                'email' =>  $this->details['email'],
                'classpuchased'  =>  $this->details['classpuchased'],
                'postcode'       => $this->details['postcode'],
                'transaction_id' => $this->details['transaction_id'],
                'total_amount'   =>   $this->details['total_amount'],
                 'licence' =>$this->details['licence'],
                'theory_certificate' => $this->details['pass_theory'],
                "practical_test_centre"=>$this->details['prefered_test_center'],
            ]);
        if($this->details['mailtype'] == 8)
            return $this->view('emails.transaction')
            ->subject('New User Request!')
            ->with([
                'name'  =>  $this->details['name'],
                'phone' =>  $this->details['phone'],
                'email' =>  $this->details['email'],
                'classpuchased'  =>  $this->details['classpuchased'],
                'postcode'       => $this->details['postcode'],
                'transaction_id' => $this->details['transaction_id'],
                'total_amount'   =>   $this->details['total_amount']
            ]);
        

    }
}
