<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;
use App\Models\SubjectModel;
use App\Models\ClassSubjectModel;
use App\Models\User;
use App\Models\HomeworkModel;
use App\Models\HomeworkSubmitModel;
use App\Models\AssignClassTeacherModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class HomeworkController extends Controller
{
    public function homework_report(){
        $data['getRecord'] = HomeworkSubmitModel::getHomeworkReport();
        $data['header_title'] = "Homework Report";
        return view('admin.homework.report', $data);
    }

    public function homework(){ 
        $data['getRecord'] = HomeworkModel::getRecord();
        $data['header_title'] = "Homework List";
        return view('admin.homework.list', $data);
    }
    public function add(){ 
        $data['getClass'] = ClassModel::getClass();
        $data['getSubject'] = SubjectModel::getSubject();
        $data['header_title'] = "Add New Homework";
        return view('admin.homework.add', $data);
    }
    public function ajax_get_subject(Request $request){
        $class_id = $request->class_id;
        $getSubject = ClassSubjectModel::MySubject($class_id);
        $html = '';
        $html .= '<option value="">Select Subject</option>';
        // dd($getSubject);
        foreach ($getSubject as $value) {
            $html .= '<option value="'.$value->subject_id.'">'.$value->subject_name.'</option>';
        }
        $json['success'] = $html;
        echo json_encode($json);
    } 
    public function insert(Request $request){
        $homwork = new HomeworkModel;
        $homwork->class_id = trim($request->class_id);
        $homwork->subject_id = trim($request->subject_id);
        $homwork->tugas_title = trim($request->tugas_title);
        $homwork->homework_date = trim($request->homework_date);
        $homwork->submission_date = trim($request->submission_date);
        $homwork->submission_limits = trim($request->submission_limits);
        $homwork->description = trim($request->description);
        $homwork->created_by = Auth::user()->id;
        if(!empty($request->file('document_file'))){ 
            $ext = $request->file('document_file')->getClientOriginalExtension();
            $file = $request->file('document_file');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/homework/', $filename);

            $homwork->document_file = $filename;
        }
        
        $homwork->save();
        
        return redirect('admin/homework/homework')->with('success', 'Homework successfully added.');
    }
    public function edit($id){
        $getRecord = HomeworkModel::getSingle($id);
        $data['getRecord'] = $getRecord;
        $data['getSubject'] = ClassSubjectModel::MySubject($getRecord->class_id);
        $data['getClass'] = ClassModel::getClass();
        $data['header_title'] = 'Edit Homework';
        return view('admin.homework.edit', $data);
    }
    public function update(Request $request, $id){
        $homwork = HomeworkModel::getSingle($id);
        $homwork->class_id = trim($request->class_id);
        $homwork->subject_id = trim($request->subject_id);
        $homwork->tugas_title = trim($request->tugas_title);
        $homwork->homework_date = trim($request->homework_date);
        $homwork->submission_date = trim($request->submission_date);
        $homwork->submission_limits = trim($request->submission_limits);
        $homwork->description = trim($request->description);
        if(!empty($request->file('document_file'))){ 
            $ext = $request->file('document_file')->getClientOriginalExtension();
            $file = $request->file('document_file');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/homework/', $filename);

            $homwork->document_file = $filename;
        }
        
        $homwork->save();
        
        return redirect('admin/homework/homework')->with('success', 'Homework successfully Updated');
    }
    public function delete($id){
        $getRecord = HomeworkModel::getSingle($id);
        if(!empty($getRecord)){
            $getRecord->is_delete = 1;
            $getRecord->save();
            
            return redirect()->back()->with('success', 'Homework successfully deleted.');
        }else{
            abort(404);
        }
        
    }
    public function submitted($homework_id){
        $homwork = HomeworkModel::getSingle($homework_id);
        if(!empty($homwork)){
            $data['homework_id'] = $homework_id;
            $data['getRecord'] = HomeworkSubmitModel::getRecord($homework_id);
            $data['header_title'] = "Submitted Homework";
            return view('admin.homework.submitted', $data);
        }else{
            abort(404);
        }
    }

    // teacher side
    public function HomeworkTeacher(){
        $class_ids = array(); 
        $record = array();  
        $data['getClass'] = AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id); 
        // dd($getClass);
        // foreach ($getClass as $class) { 
        //     $class_ids[] = $class->class_id;
        // }
        foreach ($data['getClass'] as $class) {
            $p = HomeworkModel::getRecordTeacher($class->class_id) ;
            $record[] = $p;
        }
        // $columns = array_combine($record);
        // $data['getRecord'] = HomeworkModel::getRecordTeacher($class_ids) ; 
        // dd($data['getRecord']);
        $data['header_title'] = "Homework List";
        $data['getRecord'] = array(); 
        foreach ($record as $rc) {
            foreach ($rc as $q) {
                $data['getRecord'][] = $q;
            }
        }
        // dd($data['getRecord']);
        return view('teacher.homework.list', $data);
    }
    public function addTeacher(){ 
        $data['getClass'] = AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id);
        $data['getSubject'] = SubjectModel::getSubject();
        $data['header_title'] = "Add New Homework";
        return view('teacher.homework.add', $data);
    }
    public function insertTeacher(Request $request){
        $homwork = new HomeworkModel;
        $homwork->class_id = trim($request->class_id);
        $homwork->subject_id = trim($request->subject_id);
        $homwork->tugas_title = trim($request->tugas_title);
        $homwork->homework_date = trim($request->homework_date);
        $homwork->submission_date = trim($request->submission_date);
        $homwork->submission_limits = trim($request->submission_limits);
        $homwork->description = trim($request->description);
        $homwork->created_by = Auth::user()->id;
        if(!empty($request->file('document_file'))){ 
            $ext = $request->file('document_file')->getClientOriginalExtension();
            $file = $request->file('document_file');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/homework/', $filename);

            $homwork->document_file = $filename;
        }
        
        $homwork->save();
        
        return redirect('teacher/homework/homework')->with('success', 'Homework successfully added.');
    }
    public function EditTeacher($id){
        $getRecord = HomeworkModel::getSingle($id);
        $data['getRecord'] = $getRecord;
        $data['getSubject'] = ClassSubjectModel::MySubject($getRecord->class_id);
        $data['getClass'] = AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id);
        $data['header_title'] = 'Edit Homework';
        return view('teacher.homework.edit', $data);
    }
    public function UpdateTeacher(Request $request, $id){
        $homwork = HomeworkModel::getSingle($id);
        $homwork->class_id = trim($request->class_id);
        $homwork->subject_id = trim($request->subject_id);
        $homwork->tugas_title = trim($request->tugas_title);
        $homwork->homework_date = trim($request->homework_date);
        $homwork->submission_date = trim($request->submission_date);
        $homwork->submission_limits = trim($request->submission_limits);
        $homwork->description = trim($request->description);
        if(!empty($request->file('document_file'))){ 
            $ext = $request->file('document_file')->getClientOriginalExtension();
            $file = $request->file('document_file');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/homework/', $filename);

            $homwork->document_file = $filename;
        }
        
        $homwork->save();
        
        return redirect('teacher/homework/homework')->with('success', 'Homework successfully Updated');
    }
    public function SubmittedTeacher($homework_id){
        $homwork = HomeworkModel::getSingle($homework_id);
        if(!empty($homwork)){
            $data['homework_id'] = $homework_id;
            $data['getRecord'] = HomeworkSubmitModel::getRecord($homework_id);
            $data['header_title'] = "Submitted Homework";
            return view('teacher.homework.submitted', $data);
        }else{
            abort(404);
        }
    }
    public function SubmittedTeacherEditNilai($homework_id, Request $request){
        // dd($request->all());
        $save = HomeworkSubmitModel::getSIngle($homework_id);
        $save->nilai = $request->nilai;
        $save->catatan = $request->catatan;
        $save->save();

        $json['message'] = "Sukses Mengedit Nilai"; 
        echo json_encode($json);    
    }

    // student side
    public function HomeworkStudent(){
        $data['getRecord'] = HomeworkModel::getRecordStudent(Auth::user()->class_id, Auth::user()->id);
        $data['header_title'] = "My Homework"; 
        return view('student.homework.list', $data);
    }
    // public function HomeworkStudentDetail($id){
    //     $data['getRecord'] = HomeworkModel::getSingle($id);
    //     $data['header_title'] = "My Detail Homework";
    //     return view('student.homework.list_detail', $data);
    // } 
    public function HomeworkStudentDetail($homework_id){
        $data['getRecord'] = HomeworkModel::getSingleRecord($homework_id); 
        $data['header_title'] = "Submit My Homework";
        // dd($data['getRecord']);
        return view('student.homework.list_detail', $data);
    }
    public function SubmitHomework($homework_id){
        $data['getRecord'] = HomeworkModel::getSingle($homework_id);
        $data['header_title'] = "Submit My Homework";
        return view('student.homework.submit', $data);
    }
    public function SubmitHomeworkInsert($homework_id, Request $request){
        $cek_homework_submit = HomeworkSubmitModel::cekSubmittedHomework($homework_id, Auth::user()->id);
        // dd($cek_homework_submit);
        if(empty($cek_homework_submit)){
            $homework = new HomeworkSubmitModel;
            $homework->homework_id = $homework_id;
            $homework->student_id = Auth::user()->id;
            $homework->description = $request->description;
            if(!empty($request->file('document_file'))){ 
                $ext = $request->file('document_file')->getClientOriginalExtension();
                $file = $request->file('document_file');
                $randomStr = date('Ymdhis').Str::random(20);
                $filename = strtolower($randomStr).'.'.$ext;
                $file->move('upload/homework/', $filename);
                
                $homework->document_file = $filename;
            }
            $homework->submission_late = $request->submission_late;
            $homework->save();
    
            return redirect('student/homework/my_homework')->with('success', 'Homework successfully Submitted');
        }else{ 
            $cek_homework_submit = HomeworkSubmitModel::cekSubmittedHomework($homework_id, Auth::user()->id);
            $cek_homework_submit->delete();
            
            $homework = new HomeworkSubmitModel;
            $homework->homework_id = $homework_id;
            $homework->student_id = Auth::user()->id;
            $homework->description = $request->description;
            if(!empty($request->file('document_file'))){ 
                $ext = $request->file('document_file')->getClientOriginalExtension();
                $file = $request->file('document_file');
                $randomStr = date('Ymdhis').Str::random(20);
                $filename = strtolower($randomStr).'.'.$ext;
                $file->move('upload/homework/', $filename);
                
                $homework->document_file = $filename;
            }
            $homework->submission_late = $request->submission_late;
            $homework->save();
    
            return redirect('student/homework/my_homework')->with('success', 'Homework successfully Submitted');
        }
    }
    public function HomeworkSubmitedStudent(){
        $data['getRecord'] = HomeworkSubmitModel::getRecordStudent(Auth::user()->id);
        $data['header_title'] = "My Submited Homework"; 
        return view('student.homework.submitted_list', $data);
    }
    public function HomeworkSubmitedStudentDetail($submitted_id){
        $data['getRecord'] = HomeworkSubmitModel::getSingleRecord($submitted_id);   
        // dd($data['getRecord']->getHomework);
        $data['header_title'] = "My Submited Homework"; 
        return view('student.homework.submitted_list_detail', $data);
    }
    public function HomeworkSubmitedStudentEdit($id){
        $data['getRecord'] = HomeworkSubmitModel::getSingleRecord($id); 
        // dd($data['getRecord']);
        $data['header_title'] = "My Submited Homework";
        return view('student.homework.submitted_list_edit', $data);
    }
    public function HomeworkSubmitedStudentEditSubmit(Request $request, $id){
        $homwork = HomeworkSubmitModel::getSingle($id); 
        $homwork->submission_late = trim($request->submission_late);
        if(!empty($request->file('document_file'))){ 
            $ext = $request->file('document_file')->getClientOriginalExtension();
            $file = $request->file('document_file');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/homework/', $filename);
            
            $homwork->document_file = $filename;
        }
        $homwork->description = trim($request->description);
        
        $homwork->save();
        
        return redirect('student/homework/my_submitted_homework')->with('success', 'Homework successfully Updated');
    }
    
    // parent side
    public function HomeworkStudentParent($student_id){
        $getStudent = User::getSingle($student_id);
        $data['getRecord'] = HomeworkModel::getRecordStudent($getStudent->class_id, $getStudent->id);
        $data['getStudent'] = $getStudent;
        $data['header_title'] = "Student Homework";
        return view('parent.homework.list', $data);
    }
    public function SubmittedHomeworkStudentParent($student_id){
        $getStudent = User::getSingle($student_id);
        $data['getRecord'] = HomeworkSubmitModel::getRecordStudent($getStudent->id);
        $data['getStudent'] = $getStudent;
        $data['header_title'] = "Student Submited Homework";
        return view('parent.homework.submitted_list', $data);
    }
}
