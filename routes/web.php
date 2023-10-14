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

Route::get('/', [AuthController::class, 'Login']);
Route::post('login', [AuthController::class, 'AuthLogin']);
Route::get('logout', [AuthController::class, 'Logout']);
Route::get('forgot-password', [AuthController::class, 'forgotpassword']);
Route::post('forgot-password', [AuthController::class, 'PostForgotPassword']);
Route::get('reset/{token}', [AuthController::class, 'reset']);
Route::post('reset/{token}', [AuthController::class, 'PostReset']);
 
Route::get('admin/admin/list', function() {
    return view('admin.admin.list');
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
    
    // student url
    Route::get('admin/student/list', [StudentController::class, 'list']);
    Route::get('admin/student/add', [StudentController::class, 'add']);
    Route::post('admin/student/add', [StudentController::class, 'insert']);
    Route::get('admin/student/edit/{id}', [StudentController::class, 'edit']);
    Route::post('admin/student/edit/{id}', [StudentController::class, 'update']);
    Route::get('admin/student/delete/{id}', [StudentController::class, 'delete']);

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

    // marks_register
    Route::get('teacher/marks_register', [ExaminationsController::class, 'marks_register_teacher']);
    Route::post('teacher/submit_mark_register', [ExaminationsController::class, 'submit_mark_register']);

    Route::post('teacher/single_submit_mark_register', [ExaminationsController::class, 'single_submit_mark_register']);

    // attendance
    Route::get('teacher/attendance/student', [AttendanceController::class, 'AttendanceStudentTeacher']);
    Route::post('teacher/attendance/student/save', [AttendanceController::class, 'AttendanceStudentSubmit']);
    Route::get('teacher/attendance/report', [AttendanceController::class, 'AttendanceReportTeacher']);

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

});
Route::group(['middleware' => 'student'], function() {
    Route::get('student/dashboard', [DashboardController::class, 'dashboard']); 

    
    // my subject
    Route::get('student/my_subject', [SubjectController::class, 'MySubject']);
    
    // my subject
    Route::get('student/my_timetable', [ClassTimetableController::class, 'MyTimetable']);
    
    // my_exam_timetable
    Route::get('student/my_exam_timetable', [ExaminationsController::class, 'MyExamTimetable']);
    
    // account
    Route::get('student/account', [UserController::class, 'MyAccount']);
    Route::post('student/account', [UserController::class, 'UpdateMyAccountStudent']);
    
    // change password
    Route::get('student/change_password', [UserController::class, 'change_password']);
    Route::post('student/change_password', [UserController::class, 'update_change_password']);

    // my_calendar
    Route::get('student/my_calendar', [CalendarController::class, 'MyCalendar']);

    // my_exam_result
    Route::get('student/my_exam_result', [ExaminationsController::class, 'MyExamResult']);

    // my_attendance
    Route::get('student/my_attendance', [AttendanceController::class, 'MyAttendanceStudent']);

    // my_notice_board
    Route::get('student/my_notice_board', [CommunicateController::class, 'MyNoticeBoardStudent']);
 
     // homework
     Route::get('student/my_homework', [HomeworkController::class, 'HomeworkStudent']);
     Route::get('student/my_homework/submit_homework/{id}', [HomeworkController::class, 'SubmitHomework']);
     Route::post('student/my_homework/submit_homework/{id}', [HomeworkController::class, 'SubmitHomeworkInsert']);

     // submit homework
     Route::get('student/my_submited_homework', [HomeworkController::class, 'HomeworkSubmitedStudent']);

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
    
    Route::get('/parent/my_student/subject/class_timetable/{class_id}/{subject_id}/{student_id}', [ClassTimetableController::class, 'MyTimetableParent']);
    
    Route::get('parent/my_student', [ParentController::class, 'MyStudentParent']);
    
    Route::get('parent/my_student/attendance/{student_id}', [AttendanceController::class, 'MyAttendanceParent']);

      // my_notice_board
      Route::get('parent/my_notice_board', [CommunicateController::class, 'MyNoticeBoardParent']);
      Route::get('parent/my_student_notice_board', [CommunicateController::class, 'MyStudentNoticeBoardParent']);
      
      Route::get('parent/my_student/homework/{student_id}', [HomeworkController::class, 'HomeworkStudentParent']);
      Route::get('parent/my_student/submitted_homework/{student_id}', [HomeworkController::class, 'SubmittedHomeworkStudentParent']);
});
