<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Models\subjects;
use App\Models\syllabus;
use App\Models\topics;
use Illuminate\Http\Request;
use DB;

class SubjectsController extends Controller
{
    public function index(){
        $subjectlist = subjects::select('*','subjects.name as subjectname','subjects.id as subjectid','tutorprofiles.name as tutorname')
        ->join('tutorsubjectmappings','tutorsubjectmappings.subject_id','=','subjects.id')
        ->join('tutorprofiles','tutorprofiles.tutor_id','=','tutorsubjectmappings.tutor_id')
        ->join('paymentstudents','paymentstudents.subject_id','=','subjects.id')
        ->join('paymentdetails','paymentdetails.transaction_id','paymentstudents.transaction_id')
        ->where('paymentstudents.student_id',session('userid')->id)
        ->where('paymentdetails.status',1)
        ->get();
        return view('student.selectedsubjects', compact('subjectlist'));
    }
    public function subjectlist(){
        $subjectlist = subjects::select('*','subjects.name as subjectname','subjects.id as subjectid','tutorprofiles.name as tutorname')
        ->join('tutorsubjectmappings','tutorsubjectmappings.subject_id','=','subjects.id')
        ->join('tutorprofiles','tutorprofiles.tutor_id','=','tutorsubjectmappings.tutor_id')
        ->join('paymentstudents','paymentstudents.subject_id','=','subjects.id')
        ->join('paymentdetails','paymentdetails.transaction_id','paymentstudents.transaction_id')
        // ->where('paymentstudents.student_id',session('userid')->id)
        ->where('paymentdetails.status',1)
        ->get();
        return view('student.listsubjects', compact('subjectlist'));
    }
    
    public function parent_index(){
        $subjectlist = subjects::select('*','subjects.name as subjectname','subjects.id as subjectid','tutorprofiles.name as tutorname')
        ->join('tutorsubjectmappings','tutorsubjectmappings.subject_id','=','subjects.id')
        ->join('tutorprofiles','tutorprofiles.tutor_id','=','tutorsubjectmappings.tutor_id')
        ->join('paymentstudents','paymentstudents.subject_id','=','subjects.id')
        ->join('paymentdetails','paymentdetails.transaction_id','paymentstudents.transaction_id')
        ->where('paymentstudents.student_id',session('userid')->id)
        ->where('paymentdetails.status',1)
        ->get();
        return view('parent.selectedsubjects', compact('subjectlist'));
    }

    public function getsyllabus($id){

        $subject = subjects::select('*')->where('id',$id)->first();
        $topics = topics::select('*')->where('subject_id',$id)->get();
        $syllabus = syllabus::select('*')->get();
        return view('student.mathssyllabus',compact('subject','topics','syllabus'));
    }
}
