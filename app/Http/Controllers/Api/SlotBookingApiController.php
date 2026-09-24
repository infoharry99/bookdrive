<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SlotBooking;
use App\Models\subjects;
use App\Models\status;
use App\Models\studentregistration;
use Carbon\Carbon;
use App\Events\RealTimeMessage;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\classes;
use App\Models\Form;
use Illuminate\Support\Facades\DB;

class SlotBookingApiController extends Controller
{
  
    public function store(Request $request)
    {
        $data = $request->input('data');
        $tutorId = $data['tutor_id'];
        $slots = $data['slots']; 

        if (!is_array($slots)) {
            return response()->json(['error' => 'Invalid data format'], 400);
        }

        $slots = array_unique($slots);
        $conflictingSlots = [];
        for ($i = 0; $i < count($slots); $i++) {

            if (isset($slots[$i + 1])) {
                $startSlot = $slots[$i];
                $endSlot = $slots[$i + 1];
                $startDateTime = Carbon::parse($startSlot);
                $endDateTime = Carbon::parse($endSlot);
                $slotDate = $startDateTime->toDateString();
                $startTime = $startDateTime->format('H:i');
                $endTime = $endDateTime->format('H:i');  
                
                $existingSlot = DB::table('availability_slots')
                    ->where('tutor_id', $tutorId)
                    ->where('slot_date', $slotDate)
                    ->where('slot_start_time', $startTime)
                    ->where('slot_end_time', $endTime)
                    ->first();

                if ($existingSlot) {
                    $conflictingSlots[] = [
                        'slot_date' => $slotDate,
                        'slot_start_time' => $startTime,
                        'slot_end_time' => $endTime,
                    ];
                } else {
                    // Insert the slot into the database if not booked
                    DB::table('availability_slots')->insert([
                        'tutor_id' => $tutorId,
                        'slot_date' => $slotDate,
                        'slot_start_time' => $startTime,
                        'slot_end_time' => $endTime,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
            $i++;
        }
        if (!empty($conflictingSlots)) {
            return response()->json([
                'message' => 'Some slots are already booked. Please select other slots.',
                'conflicting_slots' => $conflictingSlots,
            ], 409); 
        }

        // Return success response
        return response()->json(['message' => 'Slots saved successfully']);
    }

    public function store_old(Request $request)
    {
        // Retrieve the data from the request
        $data = $request->input('data');

        // Extract tutor ID and slot date
        $tutorId = $data['tutor_id'];
        $slots = $data['slots']; // This is an array of date-time strings

        // Check if slots is an array
        if (!is_array($slots)) {
            return response()->json(['error' => 'Invalid data format'], 400);
        }

        // Remove duplicate slots
        $slots = array_unique($slots);

        // Store the data in the database
        for ($i = 0; $i < count($slots); $i++) {
            // Check if there is a next slot available for pairing
            if (isset($slots[$i + 1])) {
                // Current slot is the start time
                $startSlot = $slots[$i];

                // Next slot is the end time
                $endSlot = $slots[$i + 1];

                // Convert the start and end slot to Carbon objects
                $startDateTime = Carbon::parse($startSlot);
                $endDateTime = Carbon::parse($endSlot);

                // Extract the date and start time
                $startDate = $startDateTime->toDateString();  // '2025-01-27'
                $startTime = $startDateTime->format('H:i');   // '08:00'

                // Extract the end time
                $endTime = $endDateTime->format('H:i');  // '09:00'

                // Insert the slot into the database
                DB::table('availability_slots')->insert([
                    'tutor_id' => $tutorId,
                    'slot_date' => $startDate,  // Store just the date part
                    'slot_start_time' => $startTime,  // Store just the start time
                    'slot_end_time' => $endTime,  // Store the end time from the next slot
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Skip the current slot because it's been paired already
            $i++;  // Increment to skip the next slot which is already used as an end time
        }

        // Return success response
        return response()->json(['message' => 'Slots saved successfully']);
    }

    public function checkAvailability(Request $request)
    {
    
        // Validate if 'data' exists in the request
        $data = $request->input('data');
        if (!$data) {
            return response()->json(['error' => 'No data provided'], 400);
        }
        $tutorId = isset($data['tutor_id']) ? $data['tutor_id'] : null;
        $slotDate = isset($data['slot_date']) ? $data['slot_date'] : null;
        $startTime = isset($data['start_time']) ? $data['start_time'] : null;
        //   echo "<pre>";
        //   print_r($tutorId);exit;
        // Check if the necessary parameters are present
        if (!$tutorId || !$slotDate || !$startTime) {
            return response()->json(['error' => 'Missing required parameters'], 400);
        }

        // Check if the slot is already booked in the availability_slots table
        $existingSlot = DB::table('availability_slots')
            ->where('tutor_id', $tutorId)
            ->where('slot_date', $slotDate)
            ->where('slot_start_time', $startTime)
            ->first();

        if ($existingSlot) {
            // If slot is already booked, return booked status
            return response()->json(['status' => 'booked']);
        }

        // If slot is available, return available status
        return response()->json(['status' => 'available']);
    }


    public function store11(Request $request)
    {
        // Retrieve the data from the request
        $data = $request->input('data');

        // Extract tutor ID and slot date
        $tutorId = $data['tutor_id'];
        $slotDate = $data['slot_date']; // Base date (e.g., '2025-01-27')
        $slots = $data['slots']; // This is an array of date-time strings
        $startTimes = $data['start_times']; // Array of start times

        // Check if slots and start_times are arrays
        if (!is_array($slots) || !is_array($startTimes)) {
            return response()->json(['error' => 'Invalid data format'], 400);
        }

        // Remove duplicate slots
        $slots = array_unique($slots);

        // Store the data in the database
        $startTime = null;
        $endTime = null;

        // Loop through the slots and start_times in pairs
        for ($i = 0; $i < count($slots); $i++) {
            // Get the current start time and the next one for end time
            $startSlot = $slots[$i];

            // Ensure we have a valid next start time for the end time
            if (isset($slots[$i + 1])) {
                $endSlot = $slots[$i + 1];
            } else {
                break;  // Exit the loop if there's no pair
            }

            // Convert the slot times to Carbon objects
            $startDateTime = Carbon::parse($startSlot);
            $endDateTime = Carbon::parse($endSlot);
            
            // Extract the date and start time
            $startDate = $startDateTime->toDateString();  // '2025-01-27'
            $startTime = $startDateTime->format('H:i');   // '08:00'

            // Extract the end time
            $endTime = $endDateTime->format('H:i');  // '09:00'

            // Insert the slot into the database
            DB::table('availability_slots')->insert([
                'tutor_id' => $tutorId,
                'slot_date' => $startDate,  // Store just the date part
                'slot_start_time' => $startTime,  // Store just the start time
                'slot_end_time' => $endTime,  // Store the end time from the next slot
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Return success response
        return response()->json(['message' => 'Slots saved successfully']);
    }

    public function saveAvailability_old2(Request $request)
    {
        try{
            // Validate the incoming request
            $request->validate([
                'tutor_id' => 'required|exists:tutorprofiles,tutor_id',
                'slotDate' => 'required|date',
            ]);

            // Get the tutor_id and selected date from the form
            $tutor_id = $request->tutor_id;
            $slotDate = $request->slotDate;

            // Fetch available time slots from the `slot_bookings` table for the selected tutor and date
            $availableSlots = SlotBooking::where('tutor_id', $tutor_id)->where('class_days', $slotDate)
                                ->select('slot', 'slot_end', 'date')->get();

            // Arrays to store new slots and existing slots
            $newSlots = [];
            $existingSlots = [];

            foreach ($availableSlots as $slot) {
            
                $exists = DB::table('availability_slots')
                            ->where('tutor_id', $tutor_id)
                            ->where('slot_start_time', $slot->slot)
                            ->where('slot_end_time', $slot->slot_end)
                            ->where('slot_date', $slotDate)
                            ->exists();

                if ($exists) {

                    $existingSlots[] = [
                        'tutor_id' => $tutor_id,
                        'slot_start_time' => $slot->slot,
                        'slot_end_time' => $slot->slot_end,
                        'slot_date' => $slotDate,
                    ];
                } else {
                    DB::table('availability_slots')->insert([
                        'tutor_id' => $tutor_id,
                        'slot_start_time' => $slot->slot,
                        'slot_end_time' => $slot->slot_end,
                        'slot_date' => $slotDate,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    $newSlots[] = [
                        'tutor_id' => $tutor_id,
                        'slot_start_time' => $slot->slot,
                        'slot_end_time' => $slot->slot_end,
                        'slot_date' => $slotDate,
                    ];
                }
            }

            // Return the data as a JSON response (for dynamic rendering in the view)
            return response()->json([
                'availableSlots' => $availableSlots,
                'selectedDate' => $slotDate,
                //'newSlots' => $newSlots,
                'existingSlots' => $existingSlots,
                'message' => 'Availability slots processed successfully.',
            ]);
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function saveAvailability(Request $request)
    {
        try{
            // Validate the incoming request
            $request->validate([
                'tutor_id' => 'required|exists:tutorprofiles,tutor_id',
                'slotDate' => 'required|date',
            ]);

            $tutor_id = $request->input('tutor_id');
            $slotDate = $request->input('slotDate');
            $availableSlots = SlotBooking::where('tutor_id', $tutor_id)
                            ->where('class_days', $slotDate)
                            ->select('slot', 'slot_end','date')
                            ->get();
            $exists = DB::table('availability_slots')
                    ->where('tutor_id', $tutor_id)
                    ->get();
            return response()->json([
                'status' => 'success',
                'message' => 'Availability slots processed successfully.',
                'availableSlots' => $availableSlots,
                'selectedDate' => $slotDate,
                'exists' => $exists,
                
            ]);
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    public function tutorslots(){

        $slots = SlotBooking::select('slot_bookings.*', 'studentprofiles.name as student_name', 'subjects.name as subject')
                            ->leftJoin('studentprofiles', 'studentprofiles.student_id', '=', 'slot_bookings.student_id')
                            ->leftJoin('subjects', 'subjects.id', '=', 'slot_bookings.subject_id')
                            ->where('slot_bookings.tutor_id', session('userid')->id)
                            ->where(function($query) {
                                $query->whereDate('slot_bookings.date', '>=', Carbon::today())
                                    ->orWhere(function($query) {
                                        $query->whereDate('slot_bookings.date', '=', Carbon::today())
                                                ->whereTime('slot_bookings.date', '>=', Carbon::now());
                                    });
                            })
                            ->orderby('slot_bookings.date','asc')
                            ->get();

        $subjects = subjects::select('subjects.*')
                    ->join('tutorsubjectmappings','tutorsubjectmappings.subject_id','subjects.id')
                    ->where('tutorsubjectmappings.tutor_id',session('userid')->id)
                    ->where('subjects.is_active',1)
                    ->get();

        $students = studentregistration::select('studentregistrations.*')
                    ->leftJoin('paymentstudents', function($join) {
                        $join->on('paymentstudents.student_id', '=', 'studentregistrations.id')
                            ->where('paymentstudents.tutor_id', '=', session('userid')->id);
                    })
                    ->whereNotNull('paymentstudents.student_id')
                    ->distinct()
                    ->where('studentregistrations.is_active',1)
                    ->get();
        return view('tutor.slotcreate',compact('slots','subjects','students'));
    }

    public function slotscreate(Request $request)
    {
        $request->validate([
            'classdate' => 'required',
            'classtime' => 'required',
        ]);

        $requestedDateTime = Carbon::parse($request->classdate . ' ' . $request->classtime);
        $endDateTime = Carbon::parse($request->classdate . ' ' . $request->endtime);
        $existingSlots = SlotBooking::where('tutor_id', session('userid')->id)
                        ->where('date', $requestedDateTime->format('Y-m-d'))
                        ->whereBetween('slot', [
                            $requestedDateTime->subHour()->format('H:i:s'),
                            $requestedDateTime->addHour()->format('H:i:s'),
                        ])->get();
        if ($existingSlots->isEmpty()) {

            $sucsmsg = ($request->slotid) ? 'Slot updated successfully!' : 'Slot created successfully!';
            $ermsg = ($request->slotid) ? 'Slot updation failed!' : 'Slot creation failed!';

            $slotbooking = ($request->slotid) ? SlotBooking::find($request->slotid) : new SlotBooking();
            $slotbooking->date = $requestedDateTime->format('Y-m-d');
            $slotbooking->slot = $requestedDateTime->format('H:i:s');
            $slotbooking->status = 0;
            $slotbooking->slot_end = $endDateTime->format('H:i:s');
            $slotbooking->class_days =$requestedDateTime->format('Y-m-d');
            $slotbooking->tutor_id = session('userid')->id;
            $res = $slotbooking->save();

            if ($res) {

                $repeatOption = $request->input('repeatOption');
                switch ($repeatOption) {
                    case 'forday':
                    break;
                    case 'forweek':
                    case 'formonth':
                        $conflictMessage = $this->replicateSlotsForPeriod($requestedDateTime, ($repeatOption == 'forweek') ? 7 : 30, $endDateTime);
                        if ($conflictMessage) {
                            return back()->with('success', $sucsmsg)->with('conflict', $conflictMessage);
                        }
                    break;
                }

                return back()->with('success', $sucsmsg);
            } else {
                return back()->with('fail', $ermsg);
            }
        } else {
            
            $conflictingTimes = $existingSlots->pluck('slot')->map(function ($time) {
                return Carbon::parse($time)->format('h:i A');
            })->implode(', ');

            return back()->with('fail', 'Slot creation failed. There is a conflicting slot within the 1-hour gap. Conflicting times: ' . $conflictingTimes);
        }
    }

    public function reschedule(Request $request){
        $getdata = SlotBooking::where('id',$request->currentslotid)->first();

        $updatedata = SlotBooking::find($request->changedslottime);
        $updatedata->status = $getdata->status;
        $updatedata->student_id = $getdata->student_id;
        $updatedata->booked_at = Carbon::now();
        $updatedata->transaction_id = $getdata->transaction_id;
        $updatedata->class_schedule_id = $getdata->class_schedule_id;
        $updatedata->contact_admin = $getdata->contact_admin;
        $updatedata->remarks = $getdata->remarks;
        $updatedata->save();

        $cleardata = SlotBooking::find($request->currentslotid);
        $cleardata->status = 0;
        $cleardata->student_id = NULL;
        $cleardata->booked_at = NULL;
        $cleardata->transaction_id = NULL;
        $cleardata->class_schedule_id = NULL;
        $cleardata->contact_admin = 0;
        $cleardata->remarks = NULL;
        $cleardata->save();

        //////////////// Here I need to pass notification into db
        $notificationdata = new Notification();
        $notificationdata->alert_type = 7;
        $notificationdata->notification = "You slots has been modified";
        $notificationdata->initiator_id = session('userid')->id;
        $notificationdata->initiator_role = session('userid')->role_id;
        $notificationdata->event_id = $request->currentslotid;
        // Sending to admin
        // if($request->receiver_role_id == 1){
        //     $notificationdata->show_to_admin = 1;
        //     $notificationdata->show_to_admin_id = $request->receiver_id;
        //     // $notificationdata->show_to_all_admin = 1;
        // }
        // // Sending to tutor
        // if($request->receiver_role_id == 2){
        //     $notificationdata->show_to_tutor = 1;
        //     $notificationdata->show_to_tutor_id = $request->receiver_id;
        //     // $notificationdata->show_to_all_tutor = 0;
        // }
        // Sending to student
        // if($request->receiver_role_id == 3){
            $notificationdata->show_to_student = 1;
            $notificationdata->show_to_student_id = $getdata->student_id;
            // $notificationdata->show_to_all_student = 0;
        // }
        // Sending to parent
        // if($request->receiver_role_id == 3){
        //     $notificationdata->show_to_parent = 1;
        //     $notificationdata->show_to_parent_id = $request->receiver_id;
        //     // $notificationdata->show_to_all_parent = 0;
        // }
        $notificationdata->read_status = 0;

        $notified = $notificationdata->save();
        broadcast(new RealTimeMessage('$notification'));

        return back()->with('success', 'Slot changed successfully!');
    }

    private function replicateSlotsForPeriod($sourceDateTime, $days, $endDateTime)
    {
        $conflictMessage = null;

        for ($dayOffset = 1; $dayOffset <= $days; $dayOffset++) {
            $currentDate = now()->addDays($dayOffset)->toDateString();

            // Check for existing slots within the 1-hour gap for the target day
            $existingSlots = SlotBooking::where('tutor_id', session('userid')->id)
                ->where('date', $currentDate)
                ->whereBetween('slot', [
                    $sourceDateTime->subHour()->format('H:i:s'),
                    $sourceDateTime->addHour()->format('H:i:s'),
                ])
                ->get();

            if ($existingSlots->isNotEmpty()) {
                // Conflicting slots found for the current day
                $conflictingTimes = $existingSlots->pluck('slot')->map(function ($time) {
                    return Carbon::parse($time)->format('h:i A');
                })->implode(', ');

                $conflictMessage = ($conflictMessage) ?
                    $conflictMessage . "<br>Conflict on $currentDate: $conflictingTimes" :
                    "Conflict on $currentDate: $conflictingTimes";
            } else {
                // No conflicting slots, proceed to replicate the slot
                $slotbooking = new SlotBooking();
                $slotbooking->date = $currentDate;
                $slotbooking->slot = $sourceDateTime->format('H:i:s');
                $slotbooking->slot_end = $endDateTime->format('H:i:s');
                $slotbooking->status = 0;
                $slotbooking->class_days =$sourceDateTime->format('Y-m-d');
                $slotbooking->tutor_id = session('userid')->id;
                $slotbooking->save();
            }
        }

        return $conflictMessage;
    }


    public function slotsdelete(Request $request)
    {
        $request->validate([
            'slotdeleteid' => 'required',
        ]);

        // Assuming SlotBooking is the model associated with the slot_bookings table
        $slotbooking = SlotBooking::where('tutor_id', session('userid')->id)
            ->where('id', $request->slotdeleteid)
            ->first();

        if ($slotbooking) {
            // Found the slot, now delete it
            $slotbooking->delete();

            return back()->with('success', 'Slot deleted successfully!');
        } else {
            // Slot not found
            return back()->with('fail', 'Slot not found or you do not have permission to delete it.');
        }

    }

    public function tutorslotsearch(Request $request) {
        $searchDate = $request->searchDate;
        $subject = $request->selectsubject;
        $student = $request->selectstudent;
        $bookingStatus = $request->bookingstatus;
        $classStatus = $request->classstatus;
        // dd($request->all());
        // Assuming 'date' is the column in your 'slot_bookings' table where the date is stored
        $slotsQuery = SlotBooking::select('slot_bookings.*', 'studentprofiles.name as student_name', 'subjects.name as subject')
        ->leftJoin('studentprofiles', 'studentprofiles.student_id', '=', 'slot_bookings.student_id')
        ->leftJoin('subjects', 'subjects.id', '=', 'slot_bookings.subject_id')
        ->where('slot_bookings.tutor_id', session('userid')->id);

        if($student){
            $slotsQuery->where('slot_bookings.student_id',$student);
        }

        if($subject){
            $slotsQuery->where('slot_bookings.subject_id',$subject);
        }

        if ($searchDate) {
            $slotsQuery->where('slot_bookings.date', $searchDate); // Filter by the selected date if available
        }
        if($bookingStatus){

            if($bookingStatus == 2){
                $bookingStatus = 0;
            }
        $slotsQuery->where('status',$bookingStatus);
        }
        if($classStatus){

            // if($bookingStatus == 2){
            //     $bookingStatus = 0;
            // }
        $slotsQuery->where('is_class_scheduled',$classStatus);
        }

        $slots = $slotsQuery->get();


        $subjects = subjects::select('subjects.*',)
        ->join('tutorsubjectmappings','tutorsubjectmappings.subject_id','subjects.id')
        ->where('tutorsubjectmappings.tutor_id',session('userid')->id)
        ->where('subjects.is_active',1)
        ->get();

        $students = studentregistration::select('studentregistrations.*')
        ->leftJoin('paymentstudents', function($join) {
            $join->on('paymentstudents.student_id', '=', 'studentregistrations.id')
                ->where('paymentstudents.tutor_id', '=', session('userid')->id);
        })
        ->whereNotNull('paymentstudents.student_id')
        ->distinct()
        ->where('studentregistrations.is_active',1)
        ->get();

        return view('tutor.slotcreate', compact('slots','subjects','students'));
    }

    public function indexslotsearch(Request $request) {
        // Get the selected date from the request
        $selectedDate = $request->input('date');
        $tutorid = $request->input('tutorid');

        // Assuming 'date' is the column in your 'slot_bookings' table where the date is stored
        $slots = SlotBooking::select('*')
        ->where('slot_bookings.tutor_id', $tutorid)
            ->where('slot_bookings.date', $selectedDate) // Assuming there is a 'status' column for the slot status
            ->get();

        // Return the filtered slots as JSON
        return response()->json($slots);
    }

    function slotsupdate(Request $request){
        // dd($request->all());
        $request->validate([
            'markactive' => 'required',
            // 'classtime' => 'required',
        ]);

        $requestedDateTime = Carbon::parse($request->classdate . ' ' . $request->classtime);

        // // Check for existing slots within the 1-hour gap
        // $existingSlots = SlotBooking::where('tutor_id', session('userid')->id)
        //     ->where('date', $requestedDateTime->format('Y-m-d'))
        //     ->whereBetween('slot', [
        //         $requestedDateTime->subHour()->format('H:i:s'),
        //         $requestedDateTime->addHour()->format('H:i:s'),
        //     ])
        //     ->get();

        // if ($existingSlots->isEmpty()) {
        //     // No conflicting slots, proceed to create the new slot
            // if ($request->slotid) {
                $slotbooking = SlotBooking::find($request->slotid);
                $sucsmsg = 'Slot updated successfully!';
                $ermsg = 'Slot updation failed!';
            // } else {
            //     $slotbooking = new SlotBooking();
            //     $sucsmsg = 'Slot created successfully!';
            //     $ermsg = 'Slot creation failed!';
            // }

            // $slotbooking->date = $requestedDateTime->format('Y-m-d');
            // $slotbooking->slot = $requestedDateTime->format('H:i:s');
            $slotbooking->status = 0;
            // $slotbooking->tutor_id = session('userid')->id;
            $slotbooking->student_id = NULL;

            $res = $slotbooking->save();

            if ($res) {
                return back()->with('success', $sucsmsg);
            } else {
                return back()->with('fail', $sucsmsg);
            }
        // } else {
        //     // Conflicting slots found
        //     $conflictingTimes = $existingSlots->pluck('slot')->map(function ($time) {
        //         return Carbon::parse($time)->format('h:i A');
        //     })->implode(', ');

        //     return back()->with('fail', 'Slot creation failed. There is a conflicting slot within the 1-hour gap. Conflicting times: ' . $conflictingTimes);
        // }
    }

    public function admintutorslots(){
    
        $subjects = subjects::where('is_active',1)->get();
            $classes = classes::where('is_active',1)->get();
            $statuses = status::select('*')->get();
            $slots = SlotBooking::select('slot_bookings.*','studentprofiles.name as student_name','subjects.name as subject','tutorregistrations.name as tutor_name')
            ->leftJoin('studentprofiles','studentprofiles.student_id','=','slot_bookings.student_id')
            ->leftJoin('subjects','subjects.id','=','slot_bookings.subject_id')
            ->leftJoin('tutorregistrations','tutorregistrations.id','slot_bookings.tutor_id')
            ->orderby('slot_bookings.created_at','desc')
            ->whereDate('slot_bookings.date', '>=', now()->toDateString())
            ->paginate(100);
        return view('admin.tutorslotslist', get_defined_vars());
    }

    public function admintutorslotssearch(Request $request){

        $subjects = subjects::where('is_active',1)->get();
            $classes = classes::where('is_active',1)->get();
            $statuses = status::select('*')->get();
            $query = SlotBooking::select('slot_bookings.*','studentprofiles.name as student_name','subjects.name as subject','tutorregistrations.name as tutor_name')
            ->leftJoin('studentprofiles','studentprofiles.student_id','=','slot_bookings.student_id')
            ->leftJoin('subjects','subjects.id','=','slot_bookings.subject_id')
            ->leftJoin('tutorregistrations','tutorregistrations.id','slot_bookings.tutor_id');
            // ->whereDate('slot_bookings.date', '>=', now()->toDateString())

            if ($request->student_name) {
                $query->where('studentprofiles.name', 'like', '%' . $request->student_name . '%');
            }

            if ($request->student_mobile) {
                $query->where('studentprofiles.mobile', 'like', '%' . $request->student_mobile . '%');
            }

            if ($request->tutor_name) {
                $query->where('tutorregistrations.name', 'like', '%' . $request->tutor_name . '%');
            }

            if ($request->tutor_mobile) {
                $query->where('tutorregistrations.mobile', 'like', '%' . $request->tutor_mobile . '%');
            }

            if ($request->start_date && $request->end_date) {
                $query->whereBetween('slot_bookings.date', [$request->start_date, $request->end_date]);
            } elseif ($request->start_date) {
                $query->where('slot_bookings.date', '>=', $request->start_date);
            } elseif ($request->end_date) {
                $query->where('slot_bookings.date', '<=', $request->end_date);
            }


            if ($request->status) {
                $query->where('slot_bookings.status', '=', $request->status);
            }



                $slots=  $query->get();
                // ->get();
            // ->get();
        return view('admin.tutorslotslist', get_defined_vars());
    }

}
