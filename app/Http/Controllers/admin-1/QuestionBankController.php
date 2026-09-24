<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\CommonController;
use App\Http\Controllers\Controller;
use App\Models\questionbank;
use App\Models\subjects;
use App\Models\topics;
use Illuminate\Http\Request;

class QuestionBankController extends Controller
{
    public function index(){

        $questions = questionbank::select('*','questionbanks.id as question_id','questionbanks.is_active as question_status','classes.name as class','subjects.name as subject','topics.name as topic')
        ->join('classes','classes.id','questionbanks.class_id')
        ->join('subjects','subjects.id','questionbanks.subject_id')
        ->join('topics','topics.id','questionbanks.topic_id')
        ->get();
        return view('admin.questionbanklist',compact('questions'));

    }

    public function create(){
        $classes = (new CommonController)->classes();
        return view('admin.questionbank',compact('classes'));
    }
    public function store(Request $request){
        
        $request->validate([
            'classname'=>'required',
            'subject'=>'required',
            'topic'=>'required',
            'question'=>'required',
            'optiona'=>'required',
            'optionb'=>'required',
            'optionc'=>'required',
            'optiond'=>'required',
            'correctanswer'=>'required',
        ]);
        if($request->id){
            $data = questionbank::find($request->id);
            $msg = 'Question updated successfully';
        }
        else{
            $data = new questionbank();
            $msg = 'Question added successfully';
        }
        $data->class_id = $request->classname;
        $data->subject_id = $request->subject;
        $data->topic_id=$request->topic;
        $data->question=$request->question;
        $data->option1=$request->optiona;
        $data->option2=$request->optionb;
        $data->option3=$request->optionc;
        $data->option4=$request->optiond;
        if($request->correctanswer == 'A'){
            $data->correct_option=$request->optiona;
        }
        if($request->correctanswer == 'B'){
            $data->correct_option=$request->optionb;
        }
        if($request->correctanswer == 'C'){
            $data->correct_option=$request->optionc;
        }
        if($request->correctanswer == 'D'){
            $data->correct_option=$request->optiond;
        }

        $data->remarks=$request->remarks;

        $res = $data->save();
        if($res){
            return back()->with('success',$msg);
        }
        else{
            return back()->with('fail','Something went wrong. Please try again later');
        }
    }

    public function status(Request $request){
        $data = questionbank::find($request->id);
        if($request->status == 1){
            $status = 0;
        }
        if($request->status == 0){
            $status = 1;
        }
        $data->is_active = $status;

       $res = $data->save();
     return json_encode(array('statusCode'=>200));
    }
    
    public function view($id){
        $classes = (new CommonController)->classes();
        $qdata = questionbank::select('*')
        ->where('id', $id)->first();
        $subjects = subjects::select('*')->where('class_id',$qdata->class_id)->get();
        $topics = topics::select('*')->where('subject_id',$qdata->subject_id)->get();
        $label = 'Update Question';
        return view('admin.questionbank',compact('qdata','classes','subjects','topics','label'));
    }
}
