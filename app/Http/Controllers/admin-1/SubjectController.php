<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\classes;
use App\Models\subjects;
use App\Models\subjectcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    public function index(){
       
        $classes = classes::select('*')
        ->where('is_active',1)->get();
        $subjects = subjects::select('classes.id as class_id','classes.name as class_name','subjects.name as subject_name','subjects.id as subject_id','subjects.is_active as subject_status','subjects.image as subject_image')
        ->join('classes','classes.id','=','subjects.class_id')->get();
        $scategories = subjectcategory::select('*')->where('is_active',1)->get();
        return view('admin.subject',compact('subjects','classes','scategories'));
    }
    
    public function store(Request $request){
        $request->validate([
            'classname'=> 'required',
            'subject'=> 'required',
            'uploadimage'=>'required'
        ]);
        if($request->id){
            $data = subjects::find($request->id);
            $msg = 'Subject updated successfully';
        }
        else{
            $data = new subjects();
            $msg = 'Subject added successfully';
        }
        $imageName = time().'.'.$request->uploadimage->extension();  
     
        $request->uploadimage->move(public_path('images/subjects'), $imageName);
  
        $data->class_id = $request->classname;
        $data->name = $request->subject;
        $data->image = $imageName;
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
        $data = subjects::find($request->id);
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
