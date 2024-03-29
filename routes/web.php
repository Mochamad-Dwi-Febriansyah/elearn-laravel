<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ClassSubjectController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AssignClassTeacherController;
use App\Http\Controllers\ClassTimetableController;
use App\Http\Controllers\ExaminationsController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CommunicateController;
use App\Http\Controllers\HomeworkController;
use App\Http\Controllers\FeesCollectionController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\JurnalController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('login');
// });

Route::get('/', [AuthController::class, 'welcome']);
Route::get('/login', [AuthController::class, 'Login']);
Route::post('login', [AuthController::class, 'AuthLogin']);
Route::get('logout', [AuthController::class, 'Logout']);
Route::get('forgot-password', [AuthController::class, 'forgotpassword']);
Route::post('forgot-password', [AuthController::class, 'PostForgotPassword']);
Route::get('reset/{token}', [AuthController::class, 'reset']);
Route::post('reset/{token}', [AuthController::class, 'PostReset']);
 
Route::group(['middleware' => 'common'], function() {
    Route::get('chat', [ChatController::class, 'chat']);
    Route::post('submit_message', [ChatController::class, 'submit_message']);
    Route::post('get_chat_windows', [ChatController::class, 'get_chat_windows']);
    Route::post('get_chat_search_user', [ChatController::class, 'get_chat_search_user']);
});


Route::group(['middleware' => 'admin'], function() {
    Route::get('admin/dashboard', [DashboardController::class, 'dashboard']);

    //admin url
    Route::get('admin/admin/list', [AdminController::class, 'list']);
    Route::get('admin/admin/add', [AdminController::class, 'add']);
    Route::post('admin/admin/add', [AdminController::class, 'insert']);
    Route::get('admin/admin/edit/{id}', [AdminController::class, 'edit']);
    Route::post('admin/admin/edit/{id}', [AdminController::class, 'update']);
    Route::get('admin/admin/delete/{id}', [AdminController::class, 'delete']);

    //teacher url
    Route::get('admin/teacher/list', [TeacherController::class, 'list']);
    Route::get('admin/teacher/add', [TeacherController::class, 'add']);
    Route::post('admin/teacher/add', [TeacherController::class, 'insert']);
    Route::get('admin/teacher/edit/{id}', [TeacherController::class, 'edit']);
    Route::post('admin/teacher/edit/{id}', [TeacherController::class, 'update']);
    Route::get('admin/teacher/delete/{id}', [TeacherController::class, 'delete']);
    Route::post('admin/teacher/export_excel', [TeacherController::class, 'export_excel']);
    
    // student url
    Route::get('admin/student/list', [StudentController::class, 'list']);
    Route::get('admin/student/add', [StudentController::class, 'add']);
    Route::post('admin/student/add', [StudentController::class, 'insert']);
    Route::get('admin/student/edit/{id}', [StudentController::class, 'edit']);
    Route::post('admin/student/edit/{id}', [StudentController::class, 'update']);
    Route::get('admin/student/delete/{id}', [StudentController::class, 'delete']);
    Route::post('admin/student/import_excel', [StudentController::class, 'import_excel']);
    Route::post('admin/student/export_excel', [StudentController::class, 'export_excel']);

    // parent url
    Route::get('admin/parent/list', [ParentController::class, 'list']);
    Route::get('admin/parent/add', [ParentController::class, 'add']);
    Route::post('admin/parent/add', [ParentController::class, 'insert']);
    Route::get('admin/parent/edit/{id}', [ParentController::class, 'edit']);
    Route::post('admin/parent/edit/{id}', [ParentController::class, 'update']);
    Route::get('admin/parent/delete/{id}', [ParentController::class, 'delete']);
    Route::get('admin/parent/my-student/{id}', [ParentController::class, 'myStudent']);
    Route::get('admin/parent/assign_student_parent/{student_id}/{parent_id}', [ParentController::class, 'AssignStudentParent']);
    Route::get('admin/parent/assign_student_parent_delete/{student_id}', [ParentController::class, 'AssignStudentParentDelete']);
    Route::post('admin/parent/export_excel', [ParentController::class, 'export_excel']);
    
    // class url
    Route::get('admin/class/list', [ClassController::class, 'list']);
    Route::get('admin/class/add', [ClassController::class, 'add']);
    Route::post('admin/class/add', [ClassController::class, 'insert']);
    Route::get('admin/class/edit/{id}', [ClassController::class, 'edit']);
    Route::post('admin/class/edit/{id}', [ClassController::class, 'update']);
    Route::get('admin/class/delete/{id}', [ClassController::class, 'delete']);

    // subject url
    Route::get('admin/subject/list', [SubjectController::class, 'list']);
    Route::get('admin/subject/add', [SubjectController::class, 'add']);
    Route::post('admin/subject/add', [SubjectController::class, 'insert']);
    Route::get('admin/subject/edit/{id}', [SubjectController::class, 'edit']);
    Route::post('admin/subject/edit/{id}', [SubjectController::class, 'update']);
    Route::get('admin/subject/delete/{id}', [SubjectController::class, 'delete']);

    // class subject url
    Route::get('admin/assign_subject/list', [ClassSubjectController::class, 'list']);
    Route::get('admin/assign_subject/add', [ClassSubjectController::class, 'add']);
    Route::post('admin/assign_subject/add', [ClassSubjectController::class, 'insert']);
    Route::get('admin/assign_subject/edit/{id}', [ClassSubjectController::class, 'edit']);
    Route::post('admin/assign_subject/edit/{id}', [ClassSubjectController::class, 'update']);
    Route::get('admin/assign_subject/delete/{id}', [ClassSubjectController::class, 'delete']);
    Route::get('admin/assign_subject/edit_single/{id}', [ClassSubjectController::class, 'edit_single']);
    Route::post('admin/assign_subject/edit_single/{id}', [ClassSubjectController::class, 'update_single']);

    // class timetable url
    Route::get('admin/class_timetable/list', [ClassTimetableController::class, 'list']);
    Route::post('admin/class_timetable/get_subject', [ClassTimetableController::class, 'get_subject']);
    Route::post('admin/class_timetable/add', [ClassTimetableController::class, 'insert_update']);
 
    
    // change password
    Route::get('admin/change_password', [UserController::class, 'change_password']);
    Route::post('admin/change_password', [UserController::class, 'update_change_password']);
    
    // fees collection 
    Route::get('admin/setting', [UserController::class, 'Setting']);
    Route::post('admin/setting', [UserController::class, 'UpdateSetting']);

    // account
    Route::get('admin/account', [UserController::class, 'MyAccount']);
    Route::post('admin/account', [UserController::class, 'UpdateMyAccountAdmin']);
    
    // assign_class_teacher url
    Route::get('admin/assign_class_teacher/list', [AssignClassTeacherController::class, 'list']);
    Route::get('admin/assign_class_teacher/add', [AssignClassTeacherController::class, 'add']); 
    Route::post('admin/assign_class_teacher/add', [AssignClassTeacherController::class, 'insert']); 
    Route::get('admin/assign_class_teacher/edit/{id}', [AssignClassTeacherController::class, 'edit']);
    Route::post('admin/assign_class_teacher/edit/{id}', [AssignClassTeacherController::class, 'update']);
    Route::get('admin/assign_class_teacher/edit_single/{id}', [AssignClassTeacherController::class, 'edit_single']);
    Route::post('admin/assign_class_teacher/edit_single/{id}', [AssignClassTeacherController::class, 'update_single']);
    Route::get('admin/assign_class_teacher/delete/{id}', [AssignClassTeacherController::class, 'delete']);
 
    //exam url
    Route::get('admin/examinations/exam/list', [ExaminationsController::class, 'exam_list']);
    Route::get('admin/examinations/exam/add', [ExaminationsController::class, 'exam_add']);
    Route::post('admin/examinations/exam/add', [ExaminationsController::class, 'exam_insert']);
    Route::get('admin/examinations/exam/edit/{id}', [ExaminationsController::class, 'exam_edit']);
    Route::post('admin/examinations/exam/edit/{id}', [ExaminationsController::class, 'exam_update']);
    Route::get('admin/examinations/exam/delete/{id}', [ExaminationsController::class, 'exam_delete']);

    Route::get('admin/my_exam_result/print', [ExaminationsController::class, 'MyExamResultPrint']);

    //exam schedule url
    Route::get('admin/examinations/exam_schedule', [ExaminationsController::class, 'exam_schedule']);
    Route::post('admin/examinations/exam_schedule_insert', [ExaminationsController::class, 'exam_schedule_insert']);
    
    // marks_register
    Route::get('admin/examinations/marks_register', [ExaminationsController::class, 'marks_register']);
    Route::post('admin/examinations/submit_mark_register', [ExaminationsController::class, 'submit_mark_register']);
    
    Route::post('admin/examinations/single_submit_mark_register', [ExaminationsController::class, 'single_submit_mark_register']);
    
    //mrarks grade url
    Route::get('admin/examinations/marks_grade', [ExaminationsController::class, 'marks_grade']);
    Route::get('admin/examinations/marks_grade/add', [ExaminationsController::class, 'marks_grade_add']);
    Route::post('admin/examinations/marks_grade/add', [ExaminationsController::class, 'marks_grade_insert']);
    Route::get('admin/examinations/marks_grade/edit/{id}', [ExaminationsController::class, 'marks_grade_edit']);
    Route::post('admin/examinations/marks_grade/edit/{id}', [ExaminationsController::class, 'marks_grade_update']);
    Route::get('admin/examinations/marks_grade/delete/{id}', [ExaminationsController::class, 'marks_grade_delete']);

    // attendance
    Route::get('admin/attendance/student', [AttendanceController::class, 'AttendanceStudent']);
    Route::post('admin/attendance/student/save', [AttendanceController::class, 'AttendanceStudentSubmit']);
    Route::get('admin/attendance/report', [AttendanceController::class, 'AttendanceReport']);
    Route::post('admin/attendance/report_export_excel', [AttendanceController::class, 'AttendanceReportExportExcel']);
    
    // communicate
    Route::get('admin/communicate/notice_board', [CommunicateController::class, 'NoticeBoard']);
    Route::get('admin/communicate/notice_board/add', [CommunicateController::class, 'AddNoticeBoard']);
    Route::post('admin/communicate/notice_board/add', [CommunicateController::class, 'InsertNoticeBoard']);
    Route::get('admin/communicate/notice_board/edit/{id}', [CommunicateController::class, 'EditNoticeBoard']);
    Route::post('admin/communicate/notice_board/edit/{id}', [CommunicateController::class, 'UpdateNoticeBoard']);
    Route::get('admin/communicate/notice_board/delete/{id}', [CommunicateController::class, 'DeleteNoticeBoard']);
    
    Route::get('admin/communicate/send_email', [CommunicateController::class, 'SendEmail']);
    Route::post('admin/communicate/send_email', [CommunicateController::class, 'SendEmailUser']);
    Route::get('admin/communicate/search_user', [CommunicateController::class, 'SearchUser']);
    
    // homework
    Route::get('admin/homework/homework', [HomeworkController::class, 'homework']);
    Route::get('admin/homework/homework/add', [HomeworkController::class, 'add']);
    Route::post('admin/ajax_get_subject', [HomeworkController::class, 'ajax_get_subject']);
    Route::post('admin/homework/homework/add', [HomeworkController::class, 'insert']);
    Route::get('admin/homework/homework/edit/{id}', [HomeworkController::class, 'edit']);
    Route::post('admin/homework/homework/edit/{id}', [HomeworkController::class, 'update']);
    Route::get('admin/homework/homework/delete/{id}', [HomeworkController::class, 'delete']);
    
    Route::get('admin/homework/homework/submitted/{id}', [HomeworkController::class, 'submitted']); 
    
    Route::get('admin/homework/homework_report', [HomeworkController::class, 'homework_report']);
    
    //material
    Route::get('admin/material/material', [MaterialController::class, 'material']);
    Route::get('admin/material/material/add', [MaterialController::class, 'add']);
    Route::post('admin/material/material/add', [MaterialController::class, 'material_add']); 
    Route::get('admin/material/material/edit/{id}', [MaterialController::class, 'edit']);
    Route::post('admin/material/material/edit/{id}', [MaterialController::class, 'update']);
    Route::get('admin/material/material/delete/{id}', [MaterialController::class, 'delete']);

    // fees collection 
    Route::get('admin/fees_collection/collect_fees', [FeesCollectionController::class, 'collect_fees']);
    Route::get('admin/fees_collection/collect_fees_report', [FeesCollectionController::class, 'collect_fees_report']);
    Route::get('admin/fees_collection/collect_fees/add_fees/{student_id}', [FeesCollectionController::class, 'collect_fees_add']);
    Route::post('admin/fees_collection/collect_fees/add_fees/{student_id}', [FeesCollectionController::class, 'collect_fees_insert']);

    Route::post('admin/fees_collection/export_collect_fees_report', [FeesCollectionController::class, 'export_collect_fees_report']);
    
    

});
Route::group(['middleware' => 'teacher'], function() {
    Route::get('teacher/dashboard', [DashboardController::class, 'dashboard']);

    // change password
    Route::get('teacher/change_password', [UserController::class, 'change_password']);
    Route::post('teacher/change_password', [UserController::class, 'update_change_password']);
    
    // account
    Route::get('teacher/account', [UserController::class, 'MyAccount']);
    Route::post('teacher/account', [UserController::class, 'UpdateMyAccount']);

    // my student
    Route::get('teacher/my_student', [StudentController::class, 'MyStudent']); 

     // my_calendar
     Route::get('teacher/my_calendar', [CalendarController::class, 'MyCalendarTeacher']);

    // my student & subject
    Route::get('teacher/my_class_subject', [AssignClassTeacherController::class, 'MyClassSubject']); 
    Route::get('teacher/my_class_subject/class_timetable/{class_id}/{subject_id}', [ClassTimetableController::class, 'MyTimetableTeacher']);
    
    // my_exam_timetable
    Route::get('teacher/my_exam_timetable', [ExaminationsController::class, 'MyExamTimetableTeacher']);

    Route::get('teacher/my_exam_result/print', [ExaminationsController::class, 'MyExamResultPrint']);

    // marks_register
    Route::get('teacher/marks_register', [ExaminationsController::class, 'marks_register_teacher']);
    Route::post('teacher/submit_mark_register', [ExaminationsController::class, 'submit_mark_register']);

    Route::post('teacher/single_submit_mark_register', [ExaminationsController::class, 'single_submit_mark_register']);

    // attendance
    Route::get('teacher/attendance/student', [AttendanceController::class, 'AttendanceStudentTeacher']);
    Route::post('teacher/attendance/student/save', [AttendanceController::class, 'AttendanceStudentSubmit']);
    Route::post('teacher/attendance/student/generate', [AttendanceController::class, 'AttendanceStudentGenerate']);
    Route::get('teacher/attendance/report', [AttendanceController::class, 'AttendanceReportTeacher']);
    Route::get('teacher/attendance/report/reportbyclass', [AttendanceController::class, 'AttendanceReportTeacherByClass']);
    Route::get('teacher/attendance/report/reportbyclass/export_pdf', [AttendanceController::class, 'export_pdf']);
    Route::post('teacher/attendance/student/cekAttendance', [AttendanceController::class, 'cekAttendance']);

    // my_notice_board
    Route::get('teacher/my_notice_board', [CommunicateController::class, 'MyNoticeBoardTeacher']);

    // homework
    Route::get('teacher/homework/homework', [HomeworkController::class, 'HomeworkTeacher']);
    Route::get('teacher/homework/homework/add', [HomeworkController::class, 'addTeacher']);
    Route::post('teacher/ajax_get_subject', [HomeworkController::class, 'ajax_get_subject']);
    Route::post('teacher/homework/homework/add', [HomeworkController::class, 'insertTeacher']);
    Route::get('teacher/homework/homework/edit/{id}', [HomeworkController::class, 'EditTeacher']);
    Route::post('teacher/homework/homework/edit/{id}', [HomeworkController::class, 'UpdateTeacher']);
    Route::get('teacher/homework/homework/delete/{id}', [HomeworkController::class, 'delete']);

    Route::get('teacher/homework/homework/submitted/{id}', [HomeworkController::class, 'SubmittedTeacher']);
    Route::post('teacher/homework/homework/submitted/edit_nilai/{id_user}', [HomeworkController::class, 'SubmittedTeacherEditNilai']);

     //material
     Route::get('teacher/material/material', [MaterialController::class, 'materialTeacher']);
     Route::get('teacher/material/material/add', [MaterialController::class, 'addTeacher']);
     Route::post('teacher/material/material/add', [MaterialController::class, 'material_addTeacher']); 
     Route::get('teacher/material/material/edit/{id}', [MaterialController::class, 'editTeacher']);
     Route::post('teacher/material/material/edit/{id}', [MaterialController::class, 'updateTeacher']);
     Route::get('teacher/material/material/delete/{id}', [MaterialController::class, 'deleteTeacher']);
     
     //material
     Route::get('teacher/my_jurnal', [JurnalController::class, 'MyJurnal']);
     Route::get('teacher/my_jurnal/list', [JurnalController::class, 'MyJurnalList']);
    //  Route::get('teacher/my_jurnal/list/detail/{id}', [JurnalController::class, 'MyJurnalListDetail']);
     Route::post('teacher/my_jurnal', [JurnalController::class, 'MyJurnalAdd']);
     Route::post('teacher/my_jurnal/list/export_excel', [JurnalController::class, 'export_excel']);
     Route::get('teacher/my_jurnal/list/export_pdf', [JurnalController::class, 'export_pdf']);
     Route::post('teacher/ajax_get_timetable', [JurnalController::class, 'ajax_get_timetable']);
     Route::post('teacher/ajax_get_student', [JurnalController::class, 'ajax_get_student']);
     Route::post('teacher/my_jurnal/list/edit/{id}', [JurnalController::class, 'JurnalupdateTeacher']);
     Route::get('teacher/my_jurnal/list/delete/{id}', [JurnalController::class, 'JurnaldeleteTeacher']);

});
Route::group(['middleware' => 'student'], function() {
    Route::get('student/dashboard', [DashboardController::class, 'dashboard']); 

    
    // my subject
    // Route::get('student/my_subject', [SubjectController::class, 'MySubject']);
    
    // my subject
    Route::get('student/my_timetable', [ClassTimetableController::class, 'MyTimetable']);
    
    // my_exam_timetable
    // Route::get('student/my_exam_timetable', [ExaminationsController::class, 'MyExamTimetable']);
    
    // account
    Route::get('student/setting/account', [UserController::class, 'MyAccount']);
    Route::post('student/setting/account', [UserController::class, 'UpdateMyAccountStudent']);
    
    // change password
    Route::get('student/setting/change_password', [UserController::class, 'change_password']);
    Route::post('student/setting/change_password', [UserController::class, 'update_change_password']);

    // my_calendar
    Route::get('student/my_calendar', [CalendarController::class, 'MyCalendar']);

    // my_exam_result
    // Route::get('student/my_exam_result', [ExaminationsController::class, 'MyExamResult']);
    // Route::get('student/my_exam_result/print', [ExaminationsController::class, 'MyExamResultPrint']);

    // my_attendance
    Route::get('student/my_attendance', [AttendanceController::class, 'MyAttendanceStudent']);

    // my_notice_board
    // Route::get('student/my_notice_board', [CommunicateController::class, 'MyNoticeBoardStudent']);
 
     // homework
    //  Route::get('student/my_homework', [HomeworkController::class, 'HomeworkStudent']);
     Route::get('student/homework/my_homework', [HomeworkController::class, 'HomeworkStudent']);
     Route::get('student/homework/my_homework/{id}', [HomeworkController::class, 'HomeworkStudentDetail']);
     Route::get('student/homework/my_homework/submit_homework/{id}', [HomeworkController::class, 'SubmitHomework']);
     Route::post('student/homework/my_homework/submit_homework/{id}', [HomeworkController::class, 'SubmitHomeworkInsert']);

     // submit homework
    //  Route::get('student/my_submitted_homework', [HomeworkController::class, 'HomeworkSubmitedStudent']);
     Route::get('student/homework/my_submitted_homework', [HomeworkController::class, 'HomeworkSubmitedStudent']);
     Route::get('student/homework/my_submitted_homework/{id}', [HomeworkController::class, 'HomeworkSubmitedStudentDetail']);
     Route::get('student/homework/my_submitted_homework/edit/{id}', [HomeworkController::class, 'HomeworkSubmitedStudentEdit']);
     Route::post('student/homework/my_submitted_homework/edit/{id}', [HomeworkController::class, 'HomeworkSubmitedStudentEditSubmit']);

     // fees_collection
    //  Route::get('student/fees_collection', [FeesCollectionController::class, 'CollectFeesStudent']);
    //  Route::post('student/fees_collection', [FeesCollectionController::class, 'CollectFeesStudentPayment']);
    //  Route::get('student/paypal/payment-error', [FeesCollectionController::class, 'PaymentError']);
    //  Route::get('student/paypal/payment-success', [FeesCollectionController::class, 'PaymentSuccess']);
    //  Route::get('student/stripe/payment-error', [FeesCollectionController::class, 'PaymentError']);
    //  Route::get('student/stripe/payment-success', [FeesCollectionController::class, 'PaymentSuccessStripe']);

    Route::get('student/my_material', [MaterialController::class, 'MyMaterial']); 
    Route::get('student/my_material/subject={subject_id}', [MaterialController::class, 'MyMaterialDetail']); 

});
Route::group(['middleware' => 'parent'], function() {
    Route::get('parent/dashboard', [DashboardController::class, 'dashboard']); 

    // change password
    Route::get('parent/change_password', [UserController::class, 'change_password']);
    Route::post('parent/change_password', [UserController::class, 'update_change_password']);

    
    // account
    Route::get('parent/account', [UserController::class, 'MyAccount']);
    Route::post('parent/account', [UserController::class, 'UpdateMyAccountParent']);

    Route::get('parent/my_student/subject/{student_id}', [SubjectController::class, 'ParentStudentSubject']);

    Route::get('parent/my_student/exam_timetable/{student_id}', [ExaminationsController::class, 'ParentMyExamTimetable']);

    Route::get('parent/my_student/calendar/{student_id}', [CalendarController::class, 'MyCalendarParent']);
    
    Route::get('parent/my_student/exam_result/{student_id}', [ExaminationsController::class, 'ParentMyExamResult']);

    Route::get('parent/my_exam_result/print', [ExaminationsController::class, 'MyExamResultPrint']);
    
    Route::get('/parent/my_student/subject/class_timetable/{class_id}/{subject_id}/{student_id}', [ClassTimetableController::class, 'MyTimetableParent']);
    
    Route::get('parent/my_student', [ParentController::class, 'MyStudentParent']);
    
    Route::get('parent/my_student/attendance/{student_id}', [AttendanceController::class, 'MyAttendanceParent']);

      // my_notice_board
      Route::get('parent/my_notice_board', [CommunicateController::class, 'MyNoticeBoardParent']);
      Route::get('parent/my_student_notice_board', [CommunicateController::class, 'MyStudentNoticeBoardParent']);
      
      Route::get('parent/my_student/homework/{student_id}', [HomeworkController::class, 'HomeworkStudentParent']);
      Route::get('parent/my_student/submitted_homework/{student_id}', [HomeworkController::class, 'SubmittedHomeworkStudentParent']);

      Route::get('parent/my_student/fees_collection/{student_id}', [FeesCollectionController::class, 'CollectFeesStudentParent']);
      Route::post('parent/my_student/fees_collection/{student_id}', [FeesCollectionController::class, 'CollectFeesStudentPaymentParent']);
      Route::get('parent/paypal/payment-error/{student_id}', [FeesCollectionController::class, 'PaymentErrorParent']);
      Route::get('parent/paypal/payment-success/{student_id}', [FeesCollectionController::class, 'PaymentSuccessParent']);

      Route::get('parent/stripe/payment-error/{student_id}', [FeesCollectionController::class, 'PaymentErrorStripeParent']);
      Route::get('parent/stripe/payment-success/{student_id}', [FeesCollectionController::class, 'PaymentSuccessStripeParent']);
});
