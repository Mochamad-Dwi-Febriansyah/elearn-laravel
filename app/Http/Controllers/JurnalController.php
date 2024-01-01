<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JurnalModelModel;
use App\Models\ClassSubjectModel;
use App\Models\AssignClassTeacherModel;
use App\Models\WeekModel;
use App\Models\User;
use App\Models\ClassSubjectTimetableModel;
use App\Models\JurnalModel;
use Illuminate\Support\Facades\Auth;

class JurnalController extends Controller
{ 
    // public function MyJurnal(){
    //     $data['getRecord'] = MaterialModel::getRecord();
    //     $data['header_title'] = "Material List";
    //     return view('teacher.jurnal.list', $data);
    // }
    public function MyJurnal(Request $request){
        $data['getClass'] = AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id);
        
        if(!empty($request->get('class_id')) || !empty($request->get('subject_id'))){
            $data['getClassSubject'] = ClassSubjectModel::mySubject($request->class_id);  
            $data['DateJurnal'] = $request->jurnal_date;
            // $data['getStudent'] = User::getStudentClass($request->get('class_id'));
            // dd($data['getMySubject']); 
        }
        $data['header_title'] = "Marks Register";
        return view('teacher.jurnal.list', $data);
    }
    public function MyJurnalList(){
        $data['getRecord'] = JurnalModel::getRecord();
        $data['header_title'] = "Jurnal List";
        return view('teacher.jurnal.myList', $data);
    }
   
    public function ajax_get_timetable(Request $request){ 
        $html = '';
        $html .= '<option value="">Select Subject</option>';
        $getWeek = WeekModel::getRecord();
        $week = array();
        foreach($getWeek as $value){
            $dataW = array();
            $dataW['week_id'] = $value->id;
            $dataW['week_name'] = $value->name;

            if(!empty($request->class_id) && !empty($request->subject_id)){
                $ClassSubject = ClassSubjectTimetableModel::getRecordClassSubject($request->class_id,$request->subject_id, $value->id);
                if(!empty($ClassSubject)){
                    $dataW['start_time'] = $ClassSubject->start_time; 
                    $dataW['end_time'] = $ClassSubject->end_time; 
                    $dataW['room_number'] = $ClassSubject->room_number;  
                    $html .= '<option value="'.$ClassSubject->id.'">'.$ClassSubject->week_name.' '.$ClassSubject->start_time.' - '.$ClassSubject->end_time.'</option>';
                    // foreach ($ClassSubject as $value) {
                    // }
                    // dd($ClassSubject);
                }else{
                    $dataW['start_time'] = ''; 
                    $dataW['end_time'] = ''; 
                    $dataW['room_number'] = ''; 
                    
                }
            }else{
                $dataW['start_time'] = ''; 
                $dataW['end_time'] = ''; 
                $dataW['room_number'] = ''; 
            }
            $week[] = $dataW;

        }
         
        $data['week'] = $week; 
        // dd($html);
        $json['success'] = $html;
        echo json_encode($json);
    } 
    public function ajax_get_student(Request $request){ 
        $class_id = $request->class_id;
        $getStudent = User::getTeacherStudentGet($class_id);
        // dd($getStudent->count());
        $html = '';
        $html .= '<label style="font-weight: normal; margin-right: 8px">
                        <input type="checkbox" value="" name="" id="">
                </label>';
        foreach($getStudent as $value){
            $html .= '<label style="font-weight: normal; margin-right: 8px">
                            <input type="checkbox" value="'.$value->id.'" name="student_id[]" id="">'.$value->name.$value->last_name.'
                    </label>';
        }
        $json['success'] = $html;
        echo json_encode($json);
    }
    public function MyJurnalAdd(Request $request){
        // dd($request->all());
        if(!empty($request->student_id)){
            foreach($request->student_id as $student_id){
                $getAlreadyFirst = JurnalModel::getAlreadyFirst($request->class_id, $request->subject_id , $student_id);
                if(!empty($getAlreadyFirst)){
                    $getAlreadyFirst->status = $request->status;
                    $getAlreadyFirst->save();
                }else{
                    $save = new JurnalModel;
                    $save->class_id = $request->class_id;
                    $save->subject_id = $request->subject_id;
                    $save->timetable_id = $request->timetable_id;
                    $save->jurnal_date = $request->jurnal_date;
                    $save->student_id = $student_id;
                    $save->kd = $request->kd;
                    $save->indikator = $request->indikator;
                    $save->point = $request->point;
                    $save->status = $request->status;
                    $save->created_by = Auth::user()->id;
                    $save->save();
                }

            }
            return redirect('teacher/my_jurnal')->with('success', "Subject Successfully Assign to Class");
       }else{
            return redirect()->back()->with('error', "Due to some error pls try again");
       }
    }
}
