<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\studentreviews;

class FeedbackController extends Controller
{
    public function index(){
        $classes = (new CommonController)->classes();
        $student_reviews = studentreviews:: select('studentreviews.name as description','studentreviews.ratings','subjects.name as subject_name','classes.name as class_name','batches.name as batch_name','studentregistrations.name as student_name')
           ->leftjoin('studentregistrations','studentregistrations.id','studentreviews.student_id')
            ->leftjoin('subjects', 'subjects.id', '=', 'studentreviews.subject_id')
            ->leftjoin('batches', 'batches.id', '=', 'studentreviews.batch_id')
            ->leftjoin('classes', 'classes.id', '=', 'studentreviews.class_id')->where('studentreviews.tutor_id',session('userid')->id)->paginate(10);
        return view('tutor.feedback',get_defined_vars());
    }


    public function tutorsubmitstudentreview(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'batchid' => 'required',
            'subject' => 'required',
            'class' => 'required',
            'student' => 'required',
            'rating' => 'required',
            'comments' => 'required',
        ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'errors' => $validator->errors(),
        ], 422); // 422 Unprocessable Entity status code for validation errors
    }

    $check = studentreviews::where('subject_id',$request->subject)->where('class_id',$request->class)
    ->where('student_id',$request->student)->where('batch_id',$request->batchid)->where('tutor_id',session('userid')->id)->first();

    if($check){
        $review = $check;
    }else{
        $review = new studentreviews();
    }

        $review->name = $request->comments;
        $review->ratings = $request->rating;
        $review->subject_id = $request->subject;
        $review->class_id = $request->class;
        $review->tutor_id = session('userid')->id;
        $review->student_id =$request->student;
        $review->batch_id =$request->batchid;
        $res = $review->save();

        return response()->json(['success' => 'Review Added Successfully']);

    }
}
