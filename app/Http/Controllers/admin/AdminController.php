<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DrivingTestRequest;

class AdminController extends Controller
{
    public function index()
    {
        $requests = DrivingTestRequest::orderBy('created_at', 'desc')->get();
        return view('admin.drivingrequests', compact('requests'));
    }
}

