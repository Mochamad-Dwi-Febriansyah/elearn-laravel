<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\Auth;
use App\Models\User; 
use App\Models\AssignClassTeacherModel; 
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportStudent;
use App\Imports\ImportUser;
use App\Models\ProjekAkhirAnggota;

class StudentController extends Controller
{
    public function import_excel(Request $request){  
        Excel::import(new ImportUser, $request->file('filexls')); 
        return redirect('/admin/student/list')->with('success', 'All good!');
    }
    public function export_excel(Request $request){
        return Excel::download(new ExportStudent,  'Student_'.date('d-m-Y').'.xls');
    }
    public function list(){
        $data['getRecord'] = User::getStudent();
        $data['header_title'] = "Student List";
        return view('admin.student.list', $data);
    }
    public function add(){
        $data['getClass'] = ClassModel::getClass();
        $data['header_title'] = "Add New Student";
        return view('admin.student.add', $data);
    }
    public function insert(Request $request){  
        request()->validate([
            'email' => 'required|email|unique:users',
            'blood_group' => 'max:10',
            'mobile_number' => 'max:15|min:8',
            'admission_number' => 'max:50',
            'roll_number' => 'max:50',
            'caste' => 'max:50',
            'religion' => 'max:50',
            'height' => 'max:10',
            'weight' => 'max:10',
        ]);

        $student = new User;
        $student->name = trim($request->name);
        $student->last_name = trim($request->last_name);
        $student->admission_number = trim($request->admission_number);
        $student->roll_number = trim($request->roll_number);
        $student->class_id = trim($request->class_id);
        $student->gender = trim($request->gender);
        if(!empty($request->date_of_birth)){
            $student->date_of_birth = trim($request->date_of_birth);
        }
        if(!empty($request->file('profile_pic'))){
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/profile/', $filename);

            $student->profile_pic = $filename;
        }     
        $student->caste = trim($request->caste);
        $student->religion = trim($request->religion);
        $student->mobile_number = trim($request->mobile_number);
        if(!empty($request->admission_date)){
            $student->admission_date = trim($request->admission_date);
        } 
        $student->blood_group = trim($request->blood_group);
        $student->height = trim($request->height);
        $student->weight = trim($request->weight);
        $student->status = trim($request->status);
        $student->email = trim($request->email);
        $student->password = Hash::make($request->password);
        $student->user_type = 3;
        $student->save();
        
        return redirect('admin/student/list')->with('success', 'Student successfully Created');
    }
    public function edit($id){
        $data['getRecord'] = User::getSingle($id);
        if(!empty($data['getRecord'])){
            $data['getClass'] = ClassModel::getClass();
            $data['header_title'] = "Edit Student";
            return view('admin.student.edit', $data);
        }else{
            abort(404);
        }
    }
    public function update($id, Request $request){
        request()->validate([
            'email' => 'required|email|unique:users,email,'.$id,
            'blood_group' => 'max:10',
            'mobile_number' => 'max:15|min:8',
            'admission_number' => 'max:50',
            'roll_number' => 'max:50',
            'caste' => 'max:50',
            'religion' => 'max:50',
            'height' => 'max:10',
            'weight' => 'max:10',
        ]);
        $student = User::getSingle($id);
        $student->name = trim($request->name);
        $student->last_name = trim($request->last_name);
        $student->admission_number = trim($request->admission_number);
        $student->roll_number = trim($request->roll_number);
        $student->class_id = trim($request->class_id);
        $student->gender = trim($request->gender);
        if(!empty($request->date_of_birth)){
            $student->date_of_birth = trim($request->date_of_birth);
        }
        if(!empty($request->file('profile_pic'))){
            if(!empty($student->getProfile())){
                unlink('upload/profile/'.$student->profile_pic);
            }
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/profile/', $filename);

            $student->profile_pic = $filename;
        }
        
        $student->caste = trim($request->caste);
        $student->religion = trim($request->religion);
        $student->mobile_number = trim($request->mobile_number);
        if(!empty($request->admission_date)){
            $student->admission_date = trim($request->admission_date);
        } 
        $student->blood_group = trim($request->blood_group);
        $student->height = trim($request->height);
        $student->weight = trim($request->weight);
        $student->status = trim($request->status);
        $student->email = trim($request->email);
        if (!empty($request->password)){
            $student->password = Hash::make($request->password);  
        } 
        $student->save();
        
        return redirect('admin/student/list')->with('success', 'Student successfully updated.');
    }
    public function delete($id){
        $getRecord = User::getSingle($id);
        if(!empty($getRecord)){
            $getRecord->is_delete = 1;
            $getRecord->save();
            
            return redirect()->back()->with('success', 'Student successfully deleted.');
        }else{
            abort(404);
        }
        
    }
    // teacher side work
    public function MyStudent(){
        $data['getRecord'] = User::getTeacherStudent(Auth::user()->id);
        $data['getClass'] = AssignClassTeacherModel::getMyAssigenClass(Auth::user()->id); 
        $data['header_title'] = "My Student List";
        $data['jumlah_siswa'] = count($data['getRecord']);
        return view('teacher.my_student', $data);
    }
    public function ajax_get_student(Request $request){ 
        $class_id = $request->class_id;
        $getStudent = User::getStudentClass($class_id);
        $cekAnggota = ProjekAkhirAnggota::getRecord();
        
        // Mendapatkan array dari semua student_id yang ada di $cekAnggota
        $anggotaIds = $cekAnggota->pluck('student_id')->toArray();

        // Mengecualikan siswa yang sudah menjadi anggota projek akhir
        $studentsWithoutProject = $getStudent->whereNotIn('id', $anggotaIds); 

        // dd($getStudent);
        // dd($getStudent->count());
        $html = '';
        // $html .= '<label style="font-weight: normal; margin-right: 8px">
        //                 <input type="checkbox" value="" name="" id="">
        //         </label>';
        foreach($studentsWithoutProject as $value){
            if($value->id === intval($request->student_id)){
                // dd(gettype(intval($request->student_id)));
                //   $html .= '<label style="font-weight: normal; margin-right: 8px">'.$value->name.$value->last_name.'</label>';
                  $html .= '<label style="font-weight: normal; margin-right: 8px">
                            <input type="hidden"  value="'.$value->id.'" name="student_id[]" id="">
                    </label>';
            }else{
                $html .= '<label style="font-weight: normal; margin-right: 8px">
                        <input type="radio" class="ml-4" value="'.$value->id.'" name="student_id[]" id=""> ' .$value->name.$value->last_name.'
                </label>'; 
                    } 
        }
        $json['success'] = $html; 
        echo json_encode($json);
    }
}
