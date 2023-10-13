<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;
use App\Models\SubjectModel;
use App\Models\ClassSubjectModel;
use App\Models\HomeworkModel;
use App\Models\AssignClassTeacherModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class HomeworkController extends Controller
{
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
        $homwork->homework_date = trim($request->homework_date);
        $homwork->submission_date = trim($request->submission_date);
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
        $homwork->homework_date = trim($request->homework_date);
        $homwork->submission_date = trim($request->submission_date);
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

    // teacher side
    public function HomeworkTeacher(){
        $class_ids = array(); 
        $getClass = AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id);
        foreach ($getClass as $class) {
            $class_ids[] = $class->class_id;
        }
        $data['getRecord'] = HomeworkModel::getRecordTeacher($class_ids);
        $data['header_title'] = "Homework List";
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
        $homwork->homework_date = trim($request->homework_date);
        $homwork->submission_date = trim($request->submission_date);
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
        $homwork->homework_date = trim($request->homework_date);
        $homwork->submission_date = trim($request->submission_date);
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

    // student side
    public function HomeworkStudent(){
        $data['getRecord'] = HomeworkModel::getRecordStudent(Auth::user()->class_id);
        $data['header_title'] = "My Homework";
        return view('student.homework.list', $data);
    }
}
