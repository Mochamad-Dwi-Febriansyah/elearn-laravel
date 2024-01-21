<?php

namespace App\Http\Controllers;

use App\Models\AssignClassTeacherModel;
use App\Models\ClassModel;
use App\Models\User;
use App\Models\StudentAttendanceModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportAttendance;
use App\Models\ClassSubjectModel;
use Barryvdh\DomPDF\Facade\Pdf;

class AttendanceController extends Controller
{
    public function AttendanceStudent(Request $request){
        $data['getClass'] = ClassModel::getClass();

        if(!empty($request->get('class_id')) && !empty($request->get('attendance_date'))){
            $data['getStudent'] = User::getStudentClass($request->get('class_id'));
        }

        $data['header_title'] = "Attendance Student";  
        return view('admin.attendance.student', $data);
    }
    public function AttendanceStudentGenerate(Request $request){
        $getStudent = User::getStudentClass($request->get('class_id'));
        foreach($getStudent as $student){
            $check_attendance = StudentAttendanceModel::CheckAlreadyAttendance($student->id,$request->class_id,$request->attendance_date);
            if(!empty($check_attendance)){
                $attendance = $check_attendance;
            }else{
                $attendance = new StudentAttendanceModel;
                $attendance->student_id = $student->id;
                $attendance->class_id = $request->class_id;
                $attendance->subject_id = $request->subject_id;  
                $attendance->timetable_id = $request->timetable_id;  
                $attendance->attendance_date = $request->attendance_date;
                $attendance->created_by = Auth::user()->id;
                $attendance->attendance_type = 1;
            }
            $attendance->save();

        }
        $json['message'] = "Attendance Successfully Generated";
        echo json_encode($json);
    }
    public function AttendanceStudentSubmit(Request $request){
        $check_attendance = StudentAttendanceModel::CheckAlreadyAttendance($request->student_id,$request->class_id,$request->attendance_date);

        if(!empty($check_attendance)){
            $attendance = $check_attendance;
        }else{
            $attendance = new StudentAttendanceModel;
            $attendance->student_id = $request->student_id;
            $attendance->class_id = $request->class_id;
            $attendance->subject_id = $request->subject_id;
            $attendance->timetable_id = $request->timetable_id;
            $attendance->attendance_date = $request->attendance_date;
            $attendance->created_by = Auth::user()->id;
        }
        $attendance->attendance_type = $request->attendance_type;

        $attendance->save();

        $json['message'] = "Attendance Successfully Saved";
        echo json_encode($json);
    }
    public function AttendanceReport(){
        $data['getClass'] = ClassModel::getClass();
        $data['getRecord'] = StudentAttendanceModel::getRecord();
        $data['header_title'] = "Attendance Report";  
        return view('admin.attendance.report', $data);
    }

    public function AttendanceReportExportExcel(Request $request){
        return Excel::download(new ExportAttendance,  'AttendanceReport_'.date('d-m-Y').'.xls');
    }
    
    // teacher side
    public function AttendanceStudentTeacher(Request $request){
        $data['getClass'] = AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id);
        if(!empty($request->get('class_id')) && !empty($request->get('attendance_date'))){
            $data['getStudent'] = User::getStudentClass($request->get('class_id'));
        }
        
        $data['header_title'] = "Attendance Student";  
        return view('teacher.attendance.student', $data);
    }
    public function AttendanceReportTeacher(Request $request){
        $getClass = AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id);
        $classarray = array();
        foreach($getClass as $value){
            $classarray[] = $value->class_id;
        } 
        $data['getClass'] = $getClass;
        $data['getRecord'] = StudentAttendanceModel::getRecordTeacher($classarray);
        // dd($data['getRecord']); 
        $data['header_title'] = "Attendance Report";  
        return view('teacher.attendance.report', $data);
    }
    public function AttendanceReportTeacherByClass(Request $request){ 
        $getClass = AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id);
        $classarray = array();
        foreach($getClass as $value){
            $classarray[] = $value->class_id;
        }
        // dd($classarray);
        $data['getClass'] = $getClass;
        $data['getAttendanceDate'] = StudentAttendanceModel::getRecordDate($request->get('class_id'), $request->get('subject_id'));
        if(!empty($request->get('class_id')) && !empty($request->get('subject_id'))){
        $data['getStudent'] = User::getStudentClass($request->get('class_id'));
        $data['getAttendanceClassSubject'] = StudentAttendanceModel::getRecordTeacherClassSubjectBaru($request->get('class_id'), $request->get('subject_id'));
        // dd($data['getAttendanceClassSubject']);
        foreach ($data['getStudent'] as $student) {
            $arrDate = array();
            foreach ($data['getAttendanceDate'] as $getDate) { 
                foreach ($data['getAttendanceClassSubject']  as $attendance) {
                    if(($getDate->attendance_date==$attendance->attendance_date) && ($student->id==$attendance->student_id)){
                        $d['attendance_date'] = $attendance->attendance_date;
                        $d['attendance_type'] = $attendance->attendance_type;
                        $arrDate[] = $d;
                    }
                    $student->attendance = $arrDate;
                }
           }
        //    dd($data['getStudent']);
        }
          
        //  dd($data['getStudent'][0]); 
         }
        $data['header_title'] = "Attendance Report";  
        return view('teacher.attendance.reportbyclass', $data);
        }

    public function export_pdf(Request $request){
        // $getClass = AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id);
        // $classarray = array();
        // foreach($getClass as $value){
        //     $classarray[] = $value->class_id;
        // }
        // $data['getClass'] = $getClass; 
        $data['getClass'] = ClassSubjectModel::getAlreadyFirstKhusus($request->get('class_id'), $request->get('subject_id')); 
        // dd($data['getClass']);
        $data['getAttendanceDate'] = StudentAttendanceModel::getRecordDate($request->get('class_id'), $request->get('subject_id')); 
        if(!empty($request->get('class_id')) && !empty($request->get('subject_id'))){
            $data['getStudent'] = User::getStudentClass($request->get('class_id'));
            $data['getAttendanceClassSubject'] = StudentAttendanceModel::getRecordTeacherClassSubjectBaru($request->get('class_id'), $request->get('subject_id'));
        foreach ($data['getStudent'] as $student) {
            $arrDate = array();
            foreach ($data['getAttendanceDate'] as $getDate) { 
                foreach ($data['getAttendanceClassSubject']  as $attendance) {
                    if(($getDate->attendance_date==$attendance->attendance_date) && ($student->id==$attendance->student_id)){
                        $d['attendance_date'] = $attendance->attendance_date;
                        $d['attendance_type'] = $attendance->attendance_type;
                        $arrDate[] = $d;
                    }
                    $student->attendance = $arrDate;
                }
           }
        //
        }
        }
        $pdf = Pdf::loadView('teacher.attendance.export_attendance', $data)->setPaper('a4', 'landscape');

        return $pdf->download('Atttendance.pdf');
    }
    public function cekAttendance(Request $request){
        $check_attendance = StudentAttendanceModel::CheckAlreadyAttendanceCekAttendance($request->class_id,$request->subject_id,$request->timetable_id,$request->attendance_date);
        if(empty($check_attendance)){
            $html = '';
            $html .= '<button class="btn btn-primary">Generate Attendance</button>'; 
        }
        $json['success'] = $html;
        echo json_encode($json);
    }
   
    // student side
    public function MyAttendanceStudent(){ 
        $data['getClass'] = StudentAttendanceModel::getClassStudent(Auth::user()->id);
        $data['getRecord'] = StudentAttendanceModel::getRecordStudent(Auth::user()->id);
        $data['header_title'] = "My Attendance";  
        return view('student.my_attendance', $data);
    }
    
    // student side
    public function MyAttendanceParent($student_id){
        $data['getStudent'] = User::getSingle($student_id);
        $data['getClass'] = StudentAttendanceModel::getClassStudent($student_id);
        $data['getRecord'] = StudentAttendanceModel::getRecordStudent($student_id);
        $data['header_title'] = "My Attendance";  
        return view('parent.my_attendance', $data);
    }

}
