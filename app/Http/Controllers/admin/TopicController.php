<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\classes;
use App\Models\subjects;
use App\Models\topics;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function index(){
        $classes = classes::select('*')
        ->where('is_active',1)->get();
        $subjects = subjects::where('is_active',1)->get();
        $topics = topics::select('topics.id as topic_id','topics.name as topic_name','topics.description as topic_description','topics.is_active as topic_status','subjects.name as subject_name','subjects.id as subject_id','classes.id as class_id','classes.name as class_name')
        ->join('subjects','subjects.id','=','topics.subject_id')
        ->join('classes','classes.id','=','subjects.class_id')->paginate(10);
        return view('admin.topic',get_defined_vars());
    }
    // search functionality
    public function topicSearch(Request $request){
        $classes = classes::select('*')->where('is_active',1)->get();
        $subjects = subjects::where('is_active',1)->get();
        $query = topics::select('topics.id as topic_id','topics.name as topic_name','topics.description as topic_description','topics.is_active as topic_status','subjects.name as subject_name','subjects.id as subject_id','classes.id as class_id','classes.name as class_name')
        ->join('subjects','subjects.id','=','topics.subject_id')
        ->join('classes','classes.id','=','subjects.class_id');
        if ($request->class_name) {
            $query->where('subjects.class_id', $request->class_name);
        }
        if ($request->subject_name) {
            $query->where('topics.subject_id', $request->subject_name);
        }
        $topics = $query->paginate(10);
        // dd($topics);
        $viewTable = view('admin.partials.topics-search',compact('topics'))->render();
        $viewPagination = $topics->links()->render();
        return response()->json([
            'table' => $viewTable,
            'pagination' => $viewPagination
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'classname'=> 'required',
            'subject'=> 'required',
            'topic'=> 'required',
            'description'=> 'required'
        ]);
        if($request->id){
            $data = topics::find($request->id);
            $msg = 'Topic updated successfully';
        }
        else{
            $data = new topics();
            $msg = 'Topic added successfully';
        }

        $data->name = $request->topic;
        $data->description = $request->description;
        $data->subject_id = $request->subject;
        $res = $data->save();

        if($res){
            return back()->with('success',$msg);
        }
        else{
            return back()->with('fail','Something went wrong. Please try again later');
        }
    }
    public function status(Request $request){
        // echo 'Test';
        // echo $request->id;
        // echo $request->status;
        // dd();
        $data = topics::find($request->id);
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

}
