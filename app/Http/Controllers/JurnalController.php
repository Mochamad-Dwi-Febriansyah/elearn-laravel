<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassSubjectModel;
use App\Models\AssignClassTeacherModel;
use App\Models\WeekModel;
use App\Models\User;
use App\Models\ClassSubjectTimetableModel;
use App\Models\JurnalModel;
use App\Models\JurnalStudentAreAbsentModel;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportJurnal;
use Barryvdh\DomPDF\Facade\Pdf;

class JurnalController extends Controller
{ 
    // public function MyJurnal(){
    //     $data['getRecord'] = MaterialModel::getRecord();
    //     $data['header_title'] = "Material List";
    //     return view('teacher.jurnal.list', $data);
    // }
    public function export_excel(Request $request){
        return Excel::download(new ExportJurnal,  'Jurnal_'.date('d-m-Y').'.xls');
    }
    public function export_pdf(Request $request){
        $data['getClass'] = AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id);
        $data['getJurnal'] = JurnalModel::getRecord($remove_pagination = 1);
        $data['getStudentJurnal'] = JurnalStudentAreAbsentModel::getRecord();
        // dd($data['getStudentJurnal']); 
        foreach($data['getJurnal'] as $jurnal){
            $arrJurnalStudent = array();
            foreach($data['getStudentJurnal'] as $studentJurnal){
                if($studentJurnal->jurnal_id == $jurnal->id){
                    $dtst['student_id'] = $studentJurnal->student_id; 
                    $dtst['student_name'] = $studentJurnal->name.$studentJurnal->last_name; 
                    $arrJurnalStudent[] = $dtst; 
                }
            }  
            $jurnal->student = $arrJurnalStudent;
        }
        // dd($data['getJurnal']);
        $pdf = Pdf::loadView('teacher.jurnal.export_jurnal', $data)->setPaper('a4', 'landscape');
        return $pdf->download('Jurnal.pdf');
    }
    public function MyJurnal(Request $request){
        $data['getRecord'] = JurnalModel::getRecord();
        // dd($data['getRecord']);
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
        $data['getClass'] = AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id);
        $data['getJurnal'] = JurnalModel::getRecord();
        $data['getStudentJurnal'] = JurnalStudentAreAbsentModel::getRecord();
        // dd($data['getStudentJurnal']); 
        foreach($data['getJurnal'] as $jurnal){
            $arrJurnalStudent = array();
            foreach($data['getStudentJurnal'] as $studentJurnal){
                if($studentJurnal->jurnal_id == $jurnal->id){
                    $dtst['student_id'] = $studentJurnal->student_id; 
                    $dtst['student_name'] = $studentJurnal->name.$studentJurnal->last_name; 
                    $arrJurnalStudent[] = $dtst; 
                }
            }  
            $jurnal->student = $arrJurnalStudent;
        }
        // $data['getJurnal']->student = $arrJurnalStudent; 
        // dd($data['getJurnal']);
        
        $data['header_title'] = "Jurnal List";
        return view('teacher.jurnal.myList', $data);
    }
    // public function MyJurnalList(){
    //     $data['getRecord'] = JurnalModel::getRecord();
    //     dd($data['getRecord']);
    //     $data['header_title'] = "Jurnal List";
    //     return view('teacher.jurnal.myList', $data);
    // }
    // public function MyJurnalListDetail($id){
 
    //     $data['getJurnal'] = JurnalModel::getSingle($id);
    //     $data['getStudentJurnal'] = JurnalStudentAreAbsentModel::getRecordStudentByJurnal($data['getJurnal']->id);
    //     // $data['getJurnal']->student = $data['getStudentJurnal'];
    //     // dd($data['getStudentJurnal']);
    //     $arr=array();
    //     foreach($data['getStudentJurnal'] as $student){
    //         $dtst['student_id'] = $student->student_id; 
    //         $dtst['student_name'] = $student->name.$student->last_name; 
    //         $arr[] = $dtst;
    //     }
    //     $data['getJurnal']->student =$arr; 
    //     // dd($data['getJurnal']);
    //     return view('teacher.jurnal.myListDetail', $data);
    // }
   
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
        // $html .= '<label style="font-weight: normal; margin-right: 8px">
        //                 <input type="checkbox" value="" name="" id="">
        //         </label>';
        foreach($getStudent as $value){
            $html .= '<label style="font-weight: normal; margin-right: 8px">
                            <input type="checkbox" value="'.$value->id.'" name="student_id[]" id="">'.$value->name.$value->last_name.'
                    </label>';
        }
        $json['success'] = $html;
        echo json_encode($json);
    }
    public function MyJurnalAdd(Request $request){
        // dd(date('Ymd'));
        $getJurnalDateCreate = JurnalModel::getAlreadyDateCreate($request->jurnal_date); 
        $dateNow = date('Ymd');
        $tokenAksesJurnal = $dateNow."0".$getJurnalDateCreate; 

        $save = new JurnalModel;
        $save->token_akses_jurnal = $tokenAksesJurnal;
        $save->class_id = $request->class_id;
        $save->subject_id = $request->subject_id;
        $save->timetable_id = $request->timetable_id;
        $save->jurnal_date = $request->jurnal_date; 
        $save->kd = $request->kd;
        $save->indikator = $request->indikator; 
        $save->catatan = $request->catatan; 
        $save->semester = $request->semester; 
        $save->tahun_ajaran = $request->tahun_ajaran; 
        $save->status = 0;
        $save->created_by = Auth::user()->id;
        $save->save();

        if(!empty($request->student_id)){
            $getJurnalByToken = JurnalModel::getSingleByTokenAkses($tokenAksesJurnal); 
            foreach($request->student_id as $student_id){
                $getAlreadyFirst = JurnalStudentAreAbsentModel::getAlreadyFirst($getJurnalByToken->id, $student_id);
                if(!empty($getAlreadyFirst)){
                    $getAlreadyFirst->status = 1;
                    $getAlreadyFirst->save();
                }else{
                    $save = new JurnalStudentAreAbsentModel;
                    $save->jurnal_id = $getJurnalByToken->id;
                    $save->student_id = $student_id;
                    $save->status = 0;
                    $save->save();
                }
            }
            
        } 
        return redirect('teacher/my_jurnal')->with('success', "Successfully Add Jurnal");
    }
    public function JurnaldeleteTeacher($id){
        $getRecord = JurnalModel::getSingle($id);
        if(!empty($getRecord)){
            $getRecord->is_delete = 1;
            $getRecord->save();

            return redirect()->back()->with('success', "Jurnal Successfully Delete");
        }else{
            abort(404);
        }
        $id->delete();
    }
    
}
