<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\CommonController;
use App\Http\Controllers\Controller;
use App\Models\OnlineTests;
use App\Models\questionbank;
use App\Models\subjects;
use App\Models\topics;
use App\Models\OnlineTest;
use App\Models\AssignTest;
use App\Models\testattempted;
use App\Models\testresponssheet;
use Illuminate\Http\Request;
use App\Events\RealTimeMessage;
use App\Models\Notification;


class OnlineTestController extends Controller
{
    public function index()
    {
        $testlists = OnlineTests::select('*', 'online_tests.id as test_id', 'online_tests.name as test_name', 'online_tests.description as test_description', 'online_tests.is_active as test_status', 'classes.name as class_name', 'subjects.name as subject_name', 'topics.name as topic_name')
            ->join('classes', 'classes.id', 'online_tests.class_id')
            ->join('subjects', 'subjects.id', 'online_tests.subject_id')
            ->join('topics', 'topics.id', 'online_tests.topic_id')
            ->get();

        return view('admin.onlinetestlist', compact('testlists'));
    }

    public function create()
    {
        $classes = (new CommonController)->classes();
        return view('admin.onlinetestnew', compact('classes'));
    }

    public function fetchquestions(Request $request)
    {
        // echo $request->topic_id;

        $questions = questionbank::select('*')
            ->where('topic_id', $request->topic_id)
            ->where('is_active', 1)
            ->get();

        return $questions;
    }

    public function store(Request $request)
    {
        $request->validate([
            'testname' => 'required',
            'testdescription' => 'required',
            'classname' => 'required',
            'subject' => 'required',
            'topic' => 'required',
            'maxattempt' => 'required',
            'duration' => 'required',
            'tstartdate' => 'required',
            'testenddate' => 'required',
            'questiondata' => 'required',
        ]);

        if ($request->id) {
            $data = OnlineTests::find($request->id);
            $msg = 'Test updated successfully';
        } else {
            $data = new OnlineTests();
            $msg = 'Test added successfully';
        }
        $data->name = $request->testname;
        $data->description = $request->testdescription;
        $data->class_id = $request->classname;
        $data->subject_id = $request->subject;
        $data->topic_id = $request->topic;
        $data->max_attempt = $request->maxattempt;
        $data->test_duration = $request->duration;
        $data->test_start_date = $request->tstartdate;
        $data->test_end_date = $request->testenddate;
        $data->question_id = json_encode($request->questiondata);
        $res = $data->save();

        if ($res) {
            return back()->with('success', $msg);
        } else {
            return back()->with('fail', 'Something went wrong. Please try again later');
        }
    }

    public function edit($id)
    {
        $tdata = OnlineTests::select('*')->where('id', $id)->first();
        $classes = (new CommonController)->classes();
        $subjects = subjects::select('*')->where('class_id', $tdata->class_id)->where('is_active', 1)->get();
        $topics = topics::select('*')->where('subject_id', $tdata->subject_id)->where('is_active', 1)->get();
        $questions = questionbank::select('*')->where('topic_id', $tdata->topic_id)->where('is_active', 1)->get();
        $questiondatas = OnlineTests::select('question_id')->where('id', $tdata->id)->first();

        // $questiondata = explode(',', $tdata->question_id);
        // $data = ModelName::find($id);
        $qstn = explode('"', $tdata->question_id);
        // return view('package.edit', ['data' => $data,'months' => $SelectedMonths]);
        // foreach($prodmulti as $test)
        // echo $months ;
        // echo "<pre>";
        // dd($months);
        // endforeach
        // $keywords = preg_split('/[\s,-,"]+/', $tdata->question_id);
        // dd($months);
        return view('admin.onlinetestnew', compact(['tdata', 'classes', 'subjects', 'topics', 'questions', 'questiondatas', 'qstn']));
    }

    public function viewquestions($id)
    {
        // Fetch question details based on testid -> Using jQuerry
        $data['questions'] = OnlineTests::where("id", $id)->first();
        return response()->json($data);
    }

    public function studentexams()
    {


        $exams = OnlineTests::select('online_tests.*', 'classes.name as class', 'subjects.name as subject', 'topics.name as topic')
            ->join('classes', 'classes.id', 'online_tests.class_id')
            ->join('subjects', 'subjects.id', 'online_tests.subject_id')
            ->join('topics', 'topics.id', 'online_tests.topic_id')
            ->get();

        foreach ($exams as $exam) {
            $exam->attemptsRemaining = $exam->max_attempt - testattempted::where('student_id', session('userid')->id)
                ->where('test_id', $exam->id)
                ->count();
        }

        $extakens = testattempted::select('testattempteds.*','online_tests.name as exam_name','online_tests.description as exam_description','online_tests.test_duration as duration','online_tests.test_start_date as test_start_date','online_tests.test_end_date as test_end_date')
        ->join('online_tests','online_tests.id','testattempteds.test_id')
        ->where('testattempteds.student_id',session('userid')->id)->where('testattempteds.is_active',1)->orderBy('testattempteds.created_at', 'desc')->get();

        return view('student.exam', compact('exams','extakens'));
    }

    public function taketest($id)
    {

        $onlineTest = OnlineTests::where('id', $id)
            ->where('class_id', session('userid')->class_id)
            ->first();

        // echo session('userid')->class_id;
        // dd($onlineTest);
        // Decode the JSON string to an array
        $questionIds = json_decode($onlineTest->question_id);

        // Fetch the related questions using the decoded question_ids array
        $questions = Questionbank::whereIn('id', $questionIds)->get();


        return view('student.taketest', compact('onlineTest', 'questions'));
    }

    public function saveResponses(Request $request)
    {
        $responses = $request->input('responses'); // Assuming the responses are sent as an array
        $savedId = [];
        $test_id = "";
        $attemptNumber = "";
        foreach ($responses as $response) {
            if ($response) {
                $values = explode(',', $response);

                // Question ID = $values[0]
                // Selection Option = $values[1]
                // Test ID = $values[2]

                $copt = questionbank::select('*')->where('id', $values[0])->first();
                $correctOption = $copt['correct_option'];
                $correct_option = "";
                // Loop through the options and check if any option matches the correct option
                foreach (range(1, 4) as $optionNumber) {
                    $optionField = "option{$optionNumber}";
                    $optionValue = $copt[$optionField];

                    if ($optionValue === $correctOption) {
                        // Option $optionNumber is the correct answer
                        $correct_option = $optionNumber;
                        break; // No need to check other options
                    }
                }
                // checking attempt no.
                $totalattp = OnlineTests::select('max_attempt')->where('id', $values[2])->first();
                $alreadyattp = testattempted::select('*')->where('student_id', session('userid')->id)->where('test_id', $values[2])->count();

                $remaining = ($totalattp->max_attempt) - ($alreadyattp);
                $attemptNumber = $alreadyattp + 1;

                $data = new testresponssheet();
                $data->test_id = $values[2];
                $data->student_id = session('userid')->id;
                $data->attempt_no = $attemptNumber;
                $data->question_id = $values[0];
                $data->correct_option = $correct_option;
                $data->marked_option = $values[1];

                $data->save();
                // Access the ID of the saved record

                $savedId[] = $data->id;
                $test_id = $values[2];

            



                // dd();
            }
        }
        // calculating the total marks
        $marks_ttl = 50;
        $marks_obt = 28;
        // Saving final test data
        $data = new testattempted();
        $data->student_id = session('userid')->id;
        $data->test_id = $test_id;
        $data->attempt_no = $attemptNumber;
        $data->test_attempted_on = now();
        $data->test_time_taken = 0;
        $data->total_marks = $marks_ttl;
        $data->obtained_marks = $marks_obt;
        $data->response_id = json_encode($savedId);
        // $data->status = ;
        // $data->is_active = session('userid')->id;
        $data->save();

        // Update is_attempted in assign_tests table
        AssignTest::where('test_id', $test_id)
        ->where('student_id', session('userid')->id)
        ->update(['is_attempted' => 1]);

        return response()->json(['message' => 'Test Submitted Successfully']);
    }

    public function testreport($id){

        $testid = testattempted::find($id);
        $onlineTest = OnlineTests::where('id', $testid->test_id)
            ->where('class_id', session('userid')->class_id)
            ->first();
        // Decode the JSON string to an array
        $questionIds = json_decode($onlineTest->question_id);
        $responseIds = json_decode($testid->response_id);

        // Fetch the related questions using the decoded question_ids array
        $questionsCount = Questionbank::whereIn('id', $questionIds)->count();
        $responsesCount = testresponssheet::whereIn('id', $responseIds)->count();
        $correctResponsesCount = testresponssheet::whereIn('id', $responseIds)->whereColumn('correct_option', 'marked_option')->count();
        // dd($correctResponsesCount);
        return view('student.testreport',compact('onlineTest','questionsCount','responsesCount','correctResponsesCount'));
    }
    function tutortestreport($id){
        
        $extakens = testattempted::select('testattempteds.*','online_tests.name as exam_name','online_tests.description as exam_description','online_tests.test_duration as duration','online_tests.test_start_date as test_start_date','online_tests.test_end_date as test_end_date')
        ->join('online_tests','online_tests.id','testattempteds.test_id')
        ->where('testattempteds.student_id',session('userid')->id)->where('testattempteds.is_active',1)->orderBy('testattempteds.created_at', 'desc')->get();

        
        $testid = testattempted::find($id);
        $onlineTest = OnlineTests::where('id', $testid->test_id)
            ->where('class_id', session('userid')->class_id)
            ->first();
        // Decode the JSON string to an array
        $questionIds = json_decode($onlineTest->question_id);
        $responseIds = json_decode($testid->response_id);

        // Fetch the related questions using the decoded question_ids array
        $questionsCount = Questionbank::whereIn('id', $questionIds)->count();
        $responsesCount = testresponssheet::whereIn('id', $responseIds)->count();
        $correctResponsesCount = testresponssheet::whereIn('id', $responseIds)->whereColumn('correct_option', 'marked_option')->count();
        // dd($correctResponsesCount);
        return view('student.testreport',compact('onlineTest','questionsCount','responsesCount','correctResponsesCount'));
    }
}
