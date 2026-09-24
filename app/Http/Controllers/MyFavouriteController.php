<?php

namespace App\Http\Controllers;

use App\Models\MyFavourite;
use App\Models\tutorregistration;
use Illuminate\Http\Request;

class MyFavouriteController extends Controller
{
    function index()
    {
    }
    function addfav($id)
    {
        $tutorchk = tutorregistration::select('*')->where('id', $id)->first();
        if ($tutorchk) {
            $exists = MyFavourite::select('*')->where('student_id', session('userid')->id)->where('tutor_id', $id)->first();
            if (!$exists) {
                $data = new MyFavourite();
                $data->student_id = session('userid')->id;
                $data->tutor_id = $id;
                $res = $data->save();

                if ($res) {
                    return redirect()->to('student/searchtutor')->with('success', 'Favourite Added Successfully');
                } else {
                    return redirect()->to('student/searchtutor')->with('fail', 'Something Went Wrong. Try Again Later');
                }
            } else {
                $res =  MyFavourite::where('student_id', session('userid')->id)
                    ->where('tutor_id', $id)
                    ->delete();
                if ($res) {
                    return redirect()->to('student/searchtutor')->with('success', 'Favourite Removed Successfully');
                } else {
                    return redirect()->to('student/searchtutor')->with('fail', 'Something Went Wrong. Try Again Later');
                }
            }
        } else {
            return redirect()->to('student/searchtutor')->with('fail', 'Something Went Wrong. Try Again Later');
        }
    }
    function removefav($id)
    {
    }
}
