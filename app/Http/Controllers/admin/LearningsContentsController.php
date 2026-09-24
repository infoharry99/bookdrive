<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\CommonController;
use App\Http\Controllers\Controller;
use App\Models\learningcontents;
use App\Models\classes;
use App\Models\subjects;
use App\Models\topics;
use Illuminate\Http\Request;

class LearningsContentsController extends Controller
{
    public function index()
    {

        $contents = learningcontents::select('*','learningcontents.id as contentid','learningcontents.is_active as contentstatus','classes.name as classname','subjects.name as subjectname','topics.name as topicname')
        ->join('classes','classes.id','learningcontents.class_id')
        ->join('subjects','subjects.id','learningcontents.subject_id')
        ->join('topics','topics.id','learningcontents.topic_id')
        ->paginate(10);
        $classes = classes::where('is_active',1)->get();
        $subjects = subjects::where('is_active',1)->get();
        $topics = topics::where('is_active',1)->get();
        return view('admin.learningcontentslist',get_defined_vars());
    }
    // search functionality
    public function search(Request $request)
    {
       //  return $request->all();
        $query = learningcontents::select('*','learningcontents.id as contentid','learningcontents.is_active as contentstatus','classes.name as classname','subjects.name as subjectname','topics.name as topicname')
        ->join('classes','classes.id','learningcontents.class_id')
        ->join('subjects','subjects.id','learningcontents.subject_id')
        ->join('topics','topics.id','learningcontents.topic_id');
        // ->get();
        if ($request->class_name) {
            $query->where('learningcontents.class_id', $request->class_name);
        }
        if ($request->subject_name) {
            $query->where('learningcontents.subject_id', $request->subject_name);
        }
        if ($request->topic_name) {
            $query->where('learningcontents.topic_id', $request->topic_name);
        }
        if ($request->status_field) {
            if($request->status_field=='2'){
                $request->status_field = '0';
            }
            $query->where('learningcontents.is_active',$request->status_field);
        }


        $contents = $query->paginate(5);
        $type = 'contents';
        $viewTable = view('admin.partials.students-tutor-search', compact('contents','type'))->render();
        $viewPagination = $contents->links()->render();
        return response()->json([
            'table' => $viewTable,
            'pagination' => $viewPagination
        ]);
    }

    public function add()
    {
        $pagename = 'Add Learning Content';
        $classes = (new CommonController)->classes();
        return view('admin.addlearningcontents', compact('classes','pagename'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'classid' => 'required',
            'subjectid' => 'required',
            'topicid' => 'required'
        ]);

        if ($request->contentid) {
            $data = learningcontents::find($request->contentid);
        } else {
            $data = new learningcontents();
        }

        $data->class_id = $request->classid;
        $data->subject_id = $request->subjectid;
        $data->topic_id = $request->topicid;
        if ($request->uploadcontent) {
            $contentlink = time() . '.' . $request->uploadcontent->extension();
            $request->uploadcontent->move(public_path('uploads/documents/learningcontents'), $contentlink);
            $data->content_link = $contentlink;
        }
        if ($request->uploadvideo) {
            $videolink = time() . '.' . $request->uploadvideo->extension();
            $request->uploadvideo->move(public_path('uploads/videos/learningcontents'), $videolink);
            $data->video_link = $videolink;
        }

        $data->content_description = $request->contentdescription;
        $data->video_description = $request->videodescription;
        $data->blog_link = $request->bloglink;
        $data->blog_description = $request->blogdescription;
        $data->is_active = 1;


        $res = $data->save();
        if ($data) {
            return back()->with('success', 'Content added successfully');
        } else {
            return back()->with('fail', 'Something went wrong. Please try again later');
        }
    }
    public function status(Request $request){
        $data = learningcontents::find($request->id);
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

    public function edit($id){
        $pagename = 'Update content details';
        $classes = (new CommonController)->classes();
        $ucontents = learningcontents::find($id);
        return view('admin.addlearningcontents',compact('ucontents','pagename','classes'));
    }
}
