<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassSubjectModel;
use Illuminate\Support\Facades\Auth;
use App\Models\ClassModel;
use App\Models\MaterialModel;
use App\Models\SubjectModel;
use Illuminate\Support\Str;
use App\Models\AssignClassTeacherModel;

class MaterialController extends Controller
{
    //admin
    public function material(){
        $data['getRecord'] = MaterialModel::getRecord();
        $data['header_title'] = "Material List";
        return view('admin.material.list', $data);
    }
    public function add(){ 
        $data['getClass'] = ClassModel::getClass();
        $data['getSubject'] = SubjectModel::getSubject();
        $data['header_title'] = "Add New Material";
        return view('admin.material.add', $data);
    }
    public function material_add(Request $request){
        $homwork = new MaterialModel();
        $homwork->class_id = trim($request->class_id);
        $homwork->subject_id = trim($request->subject_id);
        $homwork->material_title = trim($request->material_title); 
        $homwork->description = trim($request->description);
        $homwork->created_by = Auth::user()->id;
        if(!empty($request->file('document_file'))){ 
            $ext = $request->file('document_file')->getClientOriginalExtension();
            $file = $request->file('document_file');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/material/', $filename);

            $homwork->document_file = $filename;
        }
        
        $homwork->save();
        
        return redirect('admin/material/material')->with('success', 'Material successfully added.');
    }
    public function edit($id){
        $getRecord = MaterialModel::getSingle($id);
        $data['getRecord'] = $getRecord;
        $data['getSubject'] = ClassSubjectModel::MySubject($getRecord->class_id);
        $data['getClass'] = ClassModel::getClass();
        $data['header_title'] = 'Edit Material';
        return view('admin.material.edit', $data);
    }
    public function update(Request $request, $id){
        $homwork = MaterialModel::getSingle($id); 
        $homwork->class_id = trim($request->class_id);
        $homwork->subject_id = trim($request->subject_id);
        $homwork->material_title = trim($request->material_title); 
        $homwork->description = trim($request->description);
        $homwork->created_by = Auth::user()->id;
        if(!empty($request->file('document_file'))){ 
            $ext = $request->file('document_file')->getClientOriginalExtension();
            $file = $request->file('document_file');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/material/', $filename);

            $homwork->document_file = $filename;
        }
        
        $homwork->save();
        
        return redirect('admin/material/material')->with('success', 'Material successfully Updated');
    }

    public function delete($id){
        $getRecord = MaterialModel::getSingle($id);
        if(!empty($getRecord)){
            $getRecord->is_delete = 1;
            $getRecord->save();
            
            return redirect()->back()->with('success', 'Material successfully deleted.');
        }else{
            abort(404);
        }
        
    }

    //teacher
    // public function materialTeacher(){
    //     $class_ids = array(); 
    //     $getClass = AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id);
    //     foreach ($getClass as $class) {
    //         $class_ids[] = $class->class_id;
    //     }  
    //     $data['getRecord'] = MaterialModel::getRecordTeacher($class_ids);
        
    //     $data['header_title'] = "Material List";
    //     return view('teacher.material.list', $data);
    // }
    public function materialTeacher(){
        $class_ids = array(); 
        $record = array();  
        $data['getRecord'] = array(); 
        $getClass = AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id);
        // foreach ($getClass as $class) {
        //     $class_ids[] = $class->class_id;
        // } 
        foreach ($getClass as $class) {
            $p = MaterialModel::getRecordTeacher($class->class_id);
            $record[] = $p;
        } 
        foreach ($record as $rc) {
            foreach ($rc as $q) {
                $data['getRecord'][] = $q;
            }
        }
        // dd($data['getRecord']);
        $data['header_title'] = "Material List";
        return view('teacher.material.list', $data); 
       
    }
    public function addTeacher(){ 
        $data['getClass'] = AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id);
        $data['getSubject'] = SubjectModel::getSubject();
        $data['header_title'] = "Add New Material";
        return view('teacher.material.add', $data);
    }
    public function material_addTeacher(Request $request){
        $homwork = new MaterialModel();
        $homwork->class_id = trim($request->class_id);
        $homwork->subject_id = trim($request->subject_id);
        $homwork->material_title = trim($request->material_title); 
        $homwork->description = trim($request->description);
        $homwork->created_by = Auth::user()->id;
        if(!empty($request->file('document_file'))){ 
            $ext = $request->file('document_file')->getClientOriginalExtension();
            $file = $request->file('document_file');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/material/', $filename);

            $homwork->document_file = $filename;
        }
        
        $homwork->save();
        
        return redirect('teacher/material/material')->with('success', 'Material successfully added.');
    }
    public function editTeacher($id){
        $getRecord = MaterialModel::getSingle($id);
        $data['getRecord'] = $getRecord;
        $data['getSubject'] = ClassSubjectModel::MySubject($getRecord->class_id);
        $data['getClass'] = ClassModel::getClass();
        $data['header_title'] = 'Edit Material';
        return view('teacher.material.edit', $data);
    }
    public function updateTeacher(Request $request, $id){ 
        $homwork = MaterialModel::getSingle($id); 
        $homwork->class_id = trim($request->class_id);
        $homwork->subject_id = trim($request->subject_id);
        $homwork->material_title = trim($request->material_title); 
        $homwork->description = trim($request->description);
        $homwork->created_by = Auth::user()->id;
        if(!empty($request->file('document_file'))){ 
            $ext = $request->file('document_file')->getClientOriginalExtension();
            $file = $request->file('document_file');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/material/', $filename);

            $homwork->document_file = $filename;
        }
        
        $homwork->save();
        
        return redirect('teacher/material/material')->with('success', 'Material successfully Updated');
    }

    public function deleteTeacher($id){ 
        $getRecord = MaterialModel::getSingle($id);
        if(!empty($getRecord)){
            $getRecord->is_delete = 1;
            $getRecord->save();
            
            return redirect()->back()->with('success', 'Material successfully deleted.');
        }else{
            abort(404);
        }
        
    }

    //student
    public function MyMaterial(){
        $data['getRecord'] = ClassSubjectModel::GetClassSubjectByStudent(Auth::user()->class_id);
        $data['header_title'] = "My Material";
        // dd($data['getRecord']);
        return view('student.material.list', $data);
    }
    public function MyMaterialDetail($subject_id){  
        $data['getRecord'] = MaterialModel::getRecordByClassSubject(Auth::user()->class_id, $subject_id);
        $data['header_title'] = "My Material Detail"; 
        // dd($data['getRecord']);
        return view('student.material.list_material_subject_id', $data);
    }
}

