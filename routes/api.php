<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HomeApiController;
use App\Http\Controllers\Api\FormApiController;
use App\Http\Controllers\Api\StudentProfileApiController;
use App\Http\Controllers\Api\SubjectsApiController;
use App\Http\Controllers\Api\TutorSearchApiController;
use App\Http\Controllers\Api\DashboardApiController;
use App\Http\Controllers\Api\ClassApiController;
use App\Http\Controllers\Api\MyLearningApiController;
use App\Http\Controllers\Api\AssignmentsApiController;
use App\Http\Controllers\Api\PaymentsApiController;
use App\Http\Controllers\Api\MessagesApiController;
use App\Http\Controllers\Api\SlotBookingApiController;




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/deleteaccount', [AuthController::class, 'deleteaccount']);
Route::post('advanceSearchForm', [FormApiController::class, 'store']);
Route::get('/store-price-details', [FormApiController::class, 'storeprice'])->name('store-price-details');
Route::get('finalSearch', [FormApiController::class, 'AshowForm']);
Route::post('storeforms', [FormApiController::class, 'storeforms'])->name('storeforms');

Route::get('notifications',[HomeApiController::class,'notifications'])->name('notifications');
Route::get('markAsRead/{id}',[HomeApiController::class,'markAsRead'])->name('markAsRead');
Route::get('checkNotificationDetails/{id}',[HomeApiController::class,'checkNotificationDetails'])->name('checkNotificationDetails');
Route::get('findatutor',[HomeApiController::class,'findatutor'])->name('findatutor');
Route::get('tutor-details/{id}',[HomeApiController::class,'tutordetails'])->name('tutordetails');
Route::get('index/slots/search', [SlotBookingController::class, 'indexslotsearch'])->name('index.slots.search');
Route::get('resources', [HomeApiController::class, 'indexresources'])->name('index.resources');
Route::get('resources/{id}', [HomeApiController::class, 'indexresourcesdetails'])->name('index.resources.details');
Route::post('toptutorsearch',[HomeApiController::class, 'toptutorsearch'])->name('toptutorsearch');
Route::get('reviews',[HomeApiController::class,'reviewslist'])->name('revieweslist');
Route::post('makearequest', [HomeApiController::class, 'makearequest'])->name('makearequest');
Route::get('/checkPostcode/{postcode}', [HomeApiController::class, 'checkPostcode']);

Route::get('dashboard', [DashboardApiController::class, 'index'])->name('student.dashboard');
Route::get('notifications', [DashboardApiController::class, 'notificationslist'])->name('student.notifications');

Route::get('classes', [ClassApiController::class, 'studentclass'])->name('student.classes');
Route::post('classes-search', [ClassApiController::class, 'studentclassSearch'])->name('student.classes-search');
Route::get('liveclass/join/update',[ZoomClassesController::class,'liveclassjoinupdate'])->name('tutor.liveclass.join.update');

// student profile
Route::get('profile', [StudentProfileApiController::class, 'index'])->name('student.profile');
Route::get('profileupdate/{id}', [StudentProfileApiController::class, 'edit'])->name('student.profileupdate');
Route::post('updateprofiledata', [StudentProfileApiController::class, 'updateprofiledata'])->name('student.updateprofiledata');
Route::post('updateprofilepic', [StudentProfileApiController::class, 'profilepicupdate'])->name('student.profilepicupdate');
Route::post('studentacadd', [StudentProfileApiController::class, 'studentacadd'])->name('student.studentacadd');
Route::get('studentacdel/{id}', [StudentProfileApiController::class, 'studentacdel'])->name('student.studentacdel');    
Route::get('dashboard', [DashboardApiController::class, 'index'])->name('student.dashboard');
// Route::get('notifications', [DashboardController::class, 'notificationslist'])->name('student.notifications');

// tutor search
Route::get('yourtutor', [TutorSearchApiController::class, 'yourtutor'])->name('student.yourtutor');
Route::get('tutorprofile/{id}', [TutorSearchApiController::class, 'tutorprofile'])->name('student.tutorprofile');
Route::get('searchtutor', [TutorSearchApiController::class, 'index'])->name('student.searchtutor');
Route::get('sorttutor/{value}/{type}', [TutorSearchApiController::class, 'sorttutor'])->name('student.sorttutor');
Route::post('tutoradvs', [TutorSearchApiController::class, 'tutoradvs'])->name('student.tutoradvs');
Route::any('mylearnings', [MyLearningApiController::class, 'index'])->name('student.mylearnings');

Route::get('enrollsuccess', [TutorSearchApiController::class, 'enrollsuccess'])->name('student.enrollsuccess');
Route::get('slot', [TutorSearchApiController::class, 'slot'])->name('student.slot');
Route::get('enrollnow', [TutorSearchApiController::class, 'enrollnow'])->name('student.admission');
Route::post('purchaseclass', [TutorSearchApiController::class, 'purchaseclass'])->name('student.purchaseclass');


Route::get('assignments',[AssignmentsApiController::class,'studentassignmentslist'])->name('student.assignments.list');
Route::post('assignments/upload',[AssignmentsApiController::class,'studentassignmentsupload'])->name('student.assignments.upload');
Route::post('assignments-search',[AssignmentsApiController::class,'studentassignmentsSearch'])->name('student.assignments.search');

// Student Fees/Payments
Route::get('studentpayments', [PaymentsApiController::class, 'studentpayments'])->name('student.studentpayments');
Route::post('studentpayments-search', [PaymentsApiController::class, 'studentpaymentsSearch'])->name('student.payments-search');

 // Message By Student
 Route::get('messages', [MessagesApiController::class, 'messagesbystudent'])->name('student.messages');
 Route::post('sendmessage', [MessagesApiController::class, 'messagesentbystudent'])->name('student.messages.send');
 Route::get('tutormessages', [MessagesApiController::class, 'messagesbystudenttutormessages'])->name('student.messages.tutormessages');

 Route::post('/save-slot', [SlotBookingApiController::class, 'store'])->name('store.slot');
 Route::post('/slotavail', [SlotBookingApiController::class, 'checkAvailability'])->name('save.cavailability');

 Route::get('subjects', [SubjectsApiController::class, 'index'])->name('student.subjects');
 Route::get('subjectlist', [SubjectsApiController::class, 'subjectlist'])->name('student.subjectlist');
 // Syllabus
 Route::get('subjects/syllabus/{id}', [SubjectsApiController::class, 'getsyllabus'])->name('student.subjects.syllabus');

 //rishi
 Route::post('/save-availability', [SlotBookingApiController::class, 'saveAvailability'])->name('save.availability');    
 
 Route::get('completed-classes', [ClassApiController::class, 'studentCompletedclass'])->name('student.completed-classes');
