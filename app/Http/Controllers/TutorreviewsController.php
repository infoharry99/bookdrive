<?php

namespace App\Http\Controllers;

use App\Models\studentreviews;
use App\Models\tutorreviews;
use Illuminate\Http\Request;

class TutorreviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(tutorreviews $tutorreviews)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(tutorreviews $tutorreviews)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, tutorreviews $tutorreviews)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(tutorreviews $tutorreviews)
    {
        //
    }
    public function feedbacksubmitstudent(Request $request)
    {
        $request->validate([
            'subject_id' => 'required',
            'tutor_id' => 'required',
            'rating' => 'required',
            'comments' => 'required',
        ]);

        $data = new tutorreviews();
        $data->name = $request->comments;
        $data->ratings = $request->rating;
        $data->subject_id = $request->subject_id;
        $data->tutor_id = $request->tutor_id;
        $data->student_id = session('userid')->id;

        $res = $data->save();
        if ($res) {
            return back()->with('success', 'Feedback submitted successfully!');
        } else {
            return back()->with('fail', 'Feedback submission failed!');
        }
    }

    public function studentfeedbacklist(){
        $feedbacks = studentreviews::select('studentreviews.*','subjects.name as subject')
        ->join('subjects','subjects.id','studentreviews.subject_id')
        ->where('student_id',session('userid')->id)
        ->get();

        return view('student.feedback',compact('feedbacks'));
    }
}
