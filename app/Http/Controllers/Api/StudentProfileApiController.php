<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\studentachievement;
use App\Models\studentprofile;
use App\Models\studentregistration;
use App\Models\studentreviews;
use App\Models\classes;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class StudentProfileApiController extends Controller
{
    public function index(Request $request)
    {
        try{
            $this->validate($request, [
                'id' => 'required'
            ]);
            $id = $request->id;
            $student = studentregistration::select('*', 'studentregistrations.name as name', 'studentprofiles.name as student_name','studentregistrations.mobile as mobile', 'studentregistrations.email as email', 'classes.name as gradename')
                        ->join('studentprofiles', 'studentprofiles.student_id', '=', 'studentregistrations.id')
                        ->leftJoin('classes', 'classes.id', '=', 'studentregistrations.class_id')
                        ->where('studentregistrations.id', '=', $id)
                        ->first();

            $achievement = studentachievement::select('*')->where('student_id', '=', $id)->get();

            $reviews = studentreviews::select('studentreviews.id', 'studentreviews.name', 'studentreviews.ratings', 'studentreviews.subject_id', 'studentreviews.student_id', 'subjects.name as subject')
                        ->join('subjects', 'subjects.id', '=', 'studentreviews.subject_id')
                        ->where('studentreviews.student_id', '=', $id)->get();

            if (!$student) {
                $dob = "";
            } else {
                $dob = Carbon::parse($student->dob)->format('j-F-Y');
            }
            return response()->json(['student' => $student, 'dob' => $dob, 'achievement' => $achievement, 'reviews' => $reviews], 200);
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }



        return view('student.profile', compact('student', 'dob', 'achievement', 'reviews'));
    }
    public function edit($id)
    {
        try{

            $student = studentregistration::select('*', 'studentregistrations.name as name','studentprofiles.name as student_name', 'studentregistrations.mobile as mobile', 'studentregistrations.email as email', 'classes.name as gradename')
                ->join('studentprofiles', 'studentprofiles.student_id', '=', 'studentregistrations.id')
                ->leftJoin('classes', 'classes.id', '=', 'studentregistrations.class_id')
                ->where('studentregistrations.id', '=', $id)
                ->first();
            $achievement = studentachievement::select('*')
                ->where('student_id', '=', $id)->get();

            $reviews = studentreviews::select('studentreviews.id', 'studentreviews.name', 'studentreviews.ratings', 'studentreviews.subject_id', 'studentreviews.student_id', 'subjects.name as subject')
                ->join('subjects', 'subjects.id', '=', 'studentreviews.subject_id')
                ->where('studentreviews.student_id', '=', $id)->get();
        
            if (!$student) {
                $dob = "";
            } else {
                $dob = Carbon::parse($student->dob)->format('Y-m-d');
            }
            return response()->json([
                            'student' => $student,
                            'dob' => $dob,
                            'reviews' => $reviews,
                            'achievement' => $achievement,
                            'message' => 'successfully.',
                        ]);
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
        return view('student.profileupdate', compact('student', 'dob', 'achievement', 'reviews'));
    }

    // return view('student.profileupdate');

  public function updateprofiledata(Request $request)
    {
        try{

  
            $student = studentprofile::where('student_id', '=', $request->id)->first();
       
            if ($student) {
                $ppic = studentprofile::find($student->id);
            } else {
                $ppic = new studentprofile();
            }

            $ppic->student_id = $request->id;
            $ppic->name = $request->name;
            $ppic->dob = $request->dob;
            $ppic->gender = $request->gender;
            $ppic->grade = $request->grade;
            $ppic->mobile = $student->mobile;
            $ppic->email = $student->email;
            $ppic->secondary_mobile = $request->secmobile;
            $ppic->school_name = $request->school;
            $ppic->fathers_name = $request->fname;
            $ppic->mothers_name = $request->mname;

            if ($request->file) {
                $imageName = time() . '.' . $request->file->extension();
                $request->file->move(public_path('images/students/profilepics'), $imageName);
                $ppic->profile_pic = $imageName;
            }

            $res = $ppic->save();
         
           
            if ($res) {
                DB::commit();
                return response()->json([
                    'message' => 'successfully.',
                ]);
            }else{
                return response()->json([
                    'status' => '400',
                    'error' => 'Failed to update profile'
                ]);
            }
        }catch(\Exception $e){
        return response()->json(['error' => $e->getMessage()], 500);
        }

    }

   
    public function studentacadd(Request $request){

        $request->validate([
            'achievementName'=>'required',
            'achievementDesc'=>'required',
            'id'=>'required'
        ]);
        $achv = new studentachievement();
        $achv->name = $request->achievementName;
        $achv->description = $request->achievementDesc;
        $achv->date = $request->achDate;
        $achv->student_id = $request->id;
        $res = $achv->save();
        if ($res) {
            return response()->json([
                'status' => 'success',
                'code' => '200',
                'message' => 'successfully.',
            ]);
            return back()->with('success', 'Achievement added successfully');
        } else {
            return response()->json([
                'status' => 'Fail',
                'code' => '400',
                'message' => 'Error occurred while adding achievement. Please try again later.',
            ]);
        }
    }
    
    public function studentacdel($id){
        $achv =  DB::delete('delete from studentachievements where id = ?',[$id]);
        if ($achv) {
            return response()->json([
                'status' => 'success',
                'code' => '200',
                'message' => 'Achievement deleted successfully.',
            ]);
            return back()->with('success', 'Achievement deleted successfully');
        } else {
            return response()->json([
                'status' => 'Fail',
                'code' => '400',
                'message' => 'Error occurred while deleting achievement. Please try again later.',
            ]);
        }
    }

    public function studentprofile($id)
    {
        

        $student = studentregistration::select('studentregistrations.*', 'studentregistrations.name as name', 'studentregistrations.mobile as mobile',
                         'studentregistrations.email as email')
                            ->join('studentprofiles', 'studentprofiles.student_id', '=', 'studentregistrations.id')
                            ->join('classes', 'classes.id', '=', 'studentregistrations.class_id')
                            ->where('studentregistrations.id', $id)
                            ->first();
        $achievement = studentachievement::select('*')->where('student_id', '=', $id)->get();

        $reviews = studentreviews::select('studentreviews.id', 'studentreviews.name', 'studentreviews.ratings', 'studentreviews.subject_id', 'studentreviews.student_id', 'subjects.name as subject')
            ->join('subjects', 'subjects.id', '=', 'studentreviews.subject_id')
            ->where('studentreviews.student_id', '=', $id)->get();

        if (!$student) {
            $dob = "";
        } else {
            $dob = Carbon::parse($student->dob)->format('j-F-Y');
        }

        return view('student.profile', compact('student', 'dob', 'achievement', 'reviews'));
    }

    public function studentslist(){
        $stdlists = studentregistration::select('*','studentregistrations.id as student_id','studentregistrations.name as student_name','studentregistrations.mobile as student_mobile','studentregistrations.email as student_email','studentregistrations.is_active as student_status','classes.name as class_name')
                    ->leftjoin('classes','classes.id','=','studentregistrations.class_id')
                    ->orderby('studentregistrations.created_at','desc')->paginate(100);
        $classes = classes::where('is_active',1)->get();
        return view('admin.students', get_defined_vars());

    }
    public function studentslistsearch(Request $request){
        // dd($request->all());
        $query = studentregistration::select('*','studentregistrations.id as student_id','studentregistrations.name as student_name','studentregistrations.mobile as student_mobile','studentregistrations.email as student_email','studentregistrations.is_active as student_status','classes.name as class_name')
        ->join('classes','classes.id','=','studentregistrations.class_id');

        if ($request->student_name) {
            $query->where('studentregistrations.name','like', '%' . $request->student_name . '%');
        }
        if ($request->student_mobile) {
            $query->where('studentregistrations.mobile','like', '%' . $request->student_mobile . '%');
        }
        if ($request->class_name) {
            $query->where('studentregistrations.class_id', $request->class_name);
        }
        if ($request->status_field) {
            if($request->status_field=='2'){
                $request->status_field = '0';
            }
            $query->where('studentregistrations.is_active',$request->status_field);
        }
        $stdlists = $query->paginate(10);
        $type = 'students';
        $viewTable = view('admin.partials.students-tutor-search', compact('stdlists','type'))->render();
        $viewPagination = $stdlists->links()->render();
        return response()->json([
            'table' => $viewTable,
            'pagination' => $viewPagination
        ]);
    }
    public function status(Request $request){
        $data = studentregistration::find($request->id);
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
