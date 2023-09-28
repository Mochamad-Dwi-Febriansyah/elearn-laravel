<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\AssignClassTeacherModel;
use Illuminate\Support\Facades\Auth;

class AssignClassTeacherController extends Controller
{
    public function list(){ 
        $data['header_title'] = "Assign Class Teacher";
        $data['getRecord'] = AssignClassTeacherModel::getRecord();
        return view('admin.assign_class_teacher.list', $data);
    }
    public function add(){
        $data['getClass'] = ClassModel::getClass();
        $data['getTeacher'] = User::getTeacherClass();
        $data['header_title'] = "Add New Assign Class Teacher";
        return view('admin.assign_class_teacher.add', $data);
    }
    public function insert(Request $request){ 
        if(!empty($request->teacher_id)){
             foreach($request->teacher_id as $teacher_id){
                 $getAlreadyFirst = AssignClassTeacherModel::getAlreadyFirst($request->class_id, $teacher_id);
                 if(!empty($getAlreadyFirst)){
                     $getAlreadyFirst->status = $request->status;
                     $getAlreadyFirst->save();
                 }else{
                     $save = new AssignClassTeacherModel;
                     $save->class_id = $request->class_id;
                     $save->teacher_id = $teacher_id;
                     $save->status = $request->status;
                     $save->created_by = Auth::user()->id;
                     $save->save();
                 }
 
             }
             return redirect('admin/assign_class_teacher/list')->with('success', "Assign Class to Teacher Successfully");
        }else{
             return redirect()->back()->with('error', "Due to some error pls try again");
        }
     }
}
