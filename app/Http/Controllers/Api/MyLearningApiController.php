<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\learningcontents;
use App\Models\payments\paymentstudents;
use Illuminate\Http\Request;

class MyLearningApiController extends Controller
{
    public function index(Request $request){

        $this->validate($request, [
            'id' => 'required',
        ]);
        $id = $request->id;
        $pdetails = paymentstudents::select('*')->where('class_id',$id)->where('student_id',$id)->first();
        $query = learningcontents::select('learningcontents.*','topics.name as topic_name')
        ->join('topics','topics.id','learningcontents.topic_id')
        ->leftJoin('subjects','subjects.id','learningcontents.subject_id');
        if($request->input('topic')){
            $query->where('topics.name','like', '%' . $request->topic . '%');
            $requests = $request->all();
        }
       $learnings =  $query->get();
        $res =[
            'status' => 'success',
            'data' => $learnings
        ];
       return response()->json($res);
        return view('student.mylearnings',get_defined_vars());
    }

    public function parent_index(Request $request){
        $pdetails = paymentstudents::select('*')->where('class_id',session('userid')->id)->where('student_id',session('userid')->id)->first();
        $query = learningcontents::select('learningcontents.*','topics.name as topic_name')
        // ->join('paymentstudents','paymentstudents.subject_id','learningcontents.subject_id')
        // ->join('paymentdetails','paymentdetails.transaction_id','paymentstudents.transaction_id')
        ->join('topics','topics.id','learningcontents.topic_id')
        ->join('classes','classes.id','learningcontents.class_id')
        ->join('subjects','subjects.id','learningcontents.subject_id')
        // ->where('paymentstudents.student_id',session('userid')->id)
        ->where('classes.id',session('userid')->class_id)
        ->where('subjects.id',$pdetails->subject_id);
        if($request->input('topic')){
            $query->where('topics.name','like', '%' . $request->topic . '%');
            $requests = $request->all();
        }
        // ->where('paymentstudents.class_id',session('userid')->class_id)
       $learnings =  $query->paginate(10);
        return view('parent.mylearnings',get_defined_vars());
    }
}
