<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\ExamModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\StudentAddFeesModel;
use App\Models\SubjectModel;
use App\Models\AssignClassTeacherModel;
use App\Models\ClassSubjectModel;
use App\Models\HomeworkModel;
use App\Models\HomeworkSubmitModel;
use App\Models\NoticeBoardModel;
use App\Models\StudentAttendanceModel;

class DashboardController extends Controller
{
    public function dashboard(){
        $data['header_title'] = 'Dashboard';
        if (!empty(Auth::check())){
            if(Auth::user()->user_type == 1){
                $data['getTotalFees'] = StudentAddFeesModel::getTotalFees();
                $data['getTotalTodayFees'] = StudentAddFeesModel::getTotalTodayFees();

                $data['totalAdmin'] = User::getTotalUser(1);
                $data['totalTeacher'] = User::getTotalUser(2);
                $data['totalStudent'] = User::getTotalUser(3);
                $data['totalParent'] = User::getTotalUser(4);

                $data['totalExam'] = ExamModel::getTotalExam();
                $data['totalClass'] = ClassModel::getTotalClass();
                $data['totalSubject'] = SubjectModel::getTotalSubject();

                return view('admin.dashboard', $data);
            }
            else if(Auth::user()->user_type == 2){ 
                $data['totalStudent'] = User::getTeacherStudentCount(Auth::user()->id); 
                $data['totalClass'] = AssignClassTeacherModel::getMyClassSubjectGroupCount(Auth::user()->id);
                $data['totalSubject'] = AssignClassTeacherModel::getMyClassSubjectCount(Auth::user()->id);
                $data['totalNoticeBoard'] = NoticeBoardModel::getRecordUserCount(Auth::user()->user_type);
                
                return view('teacher.dashboard', $data);
            }
            else if(Auth::user()->user_type == 3){
                $data['totalPaidAmount'] = StudentAddFeesModel::totalPaidAmountStudent(Auth::user()->id);
                $data['TotalSubject'] = ClassSubjectModel::MySubjectTotal(Auth::user()->class_id);
                $data['TotalNoticeBoard'] = NoticeBoardModel::getRecordUserCount(Auth::user()->class_id);
                $data['TotalHomeWork'] = HomeworkModel::getRecordStudentCount(Auth::user()->class_id, Auth::user()->id);
                $data['TotalSubmittedHomeWork'] = HomeworkSubmitModel::getRecordStudentCount(Auth::user()->id);
                $data['TotalAttendance'] = StudentAttendanceModel::getRecordStudentCount(Auth::user()->id);
                return view('student.dashboard', $data);
            }
            else if(Auth::user()->user_type == 4){
                $student_ids = User::getMyStudentIds(Auth::user()->id);
                $class_ids = User::getMyStudentClassIds(Auth::user()->id); 
                
                if(!empty($student_ids)){
                    $data['totalPaidAmount'] = StudentAddFeesModel::totalPaidAmountStudentParent($student_ids);
                    $data['TotalAttendance'] = StudentAttendanceModel::getRecordStudentParentCount($student_ids);
                    $data['TotalSubmittedHomeWork'] = HomeworkSubmitModel::getRecordStudentParentCount($student_ids);
                }else{
                    $data['totalPaidAmount'] = 0;
                    $data['TotalAttendance'] = 0;
                    $data['TotalSubmittedHomeWork'] =  0; 
                }
                if(!empty($class_ids) && !empty($student_ids)){
                    $data['TotalHomeWork'] = HomeworkModel::getRecordStudentParentCount($class_ids, $student_ids);
                }else{
                    $data['TotalHomework'] = 0;
                }

                $data['getTotalFees'] = StudentAddFeesModel::getTotalFees();
                $data['totalStudent'] = User::getMyStudentCount(Auth::user()->id);
                $data['TotalNoticeBoard'] = NoticeBoardModel::getRecordUserCount(Auth::user()->user_type);

                return view('parent.dashboard', $data);
            }
        }
    }
}
