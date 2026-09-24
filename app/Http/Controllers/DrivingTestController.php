<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\DrivingTestRequest;
use App\Mail\SendMail;

class DrivingTestController extends Controller
{
    public function showForm()
    {
        return view('front-cms.driving_test_form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required',
            'phone' => 'required|string',
            'test_centres' => 'required|string',
            'earliest_date' => 'required|date',
            'latest_date' => 'nullable|date',
            'license_number' => 'required|string',
            'theory_number' => 'nullable|string',
            'center1' => 'nullable|string',
            'center2' => 'nullable|string',
            'center3' => 'nullable|string',
        ]);

        DrivingTestRequest::create($request->except('_token'));
          $details = [
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'test_centres' => $request->test_centres,
                'center1' => $request->center1,
                'center2' => $request->center2,
                'center3' => $request->center3,
                'earliest_date' => $request->earliest_date,
                'latest_date' => $request->latest_date,
                'license_number' => $request->license_number,
                'theory_number' => $request->theory_number,
                'earliest_date' => $request->earliest_date,
                'mailtype' => 5,
            ];

        Mail::to('7daysinstructors@gmail.com')->send(new SendMail($details));

        return redirect()->back()->with('success', 'Your request has been submitted successfully!');
    }
}
