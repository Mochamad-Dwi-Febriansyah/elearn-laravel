<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping; 
use App\Models\HomeworkSubmitModel;
use App\Models\User;
use App\Models\HomeworkModel;
use GuzzleHttp\Psr7\Request;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportNilaiByClass implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $class_id;
    protected $subject_id;
    public function __construct($class_id, $subject_id) {
        $this->class_id = $class_id;
        $this->subject_id = $subject_id;
    }
    public function headings(): array{
        return [ 
            "Student ID",
            "Student Name",
            "Class Name", 
        ];
    }
    public function map($value): array{

        $student_name = $value->name.''.$value->name_last;

        // $attendance_type = '';
        // if ($value->attendance_type == 1){
        //     $attendance_type = 'Present'; 
        // }else if($value->attendance_type == 2){
        //     $attendance_type = 'Late'; 
        // }else if($value->attendance_type == 3){
        //     $attendance_type = 'Absent'; 
        // }else if($value->attendance_type == 4){
        //     $attendance_type = 'Half Day'; 
        // }
        return [ 
            $value->id,
            $student_name,
            $value->nilai, 
            // $attendance_type, 
            // date('d-m-Y', strtotime($value->attendance_date)),
            // $value->created_name,
            // date('d-m-Y', strtotime($value->created_at))
        ];
    }
    public function collection()
    {
        if(!empty($this->class_id)  && !empty($this->subject_id)){ 
            // $class_id = ClassModel::getClassByclassName($request->get('class_name'));
            // dd($class_id->id);
            $data['getStudent'] = User::getStudentClass($this->class_id);
            // dd($data['getStudent']);
            $data['getHomework'] = HomeworkModel::getRecordTeacherClassSubject($this->class_id, !empty($this->subject_id));
            // dd($data['getHomework']);
            foreach($data['getStudent'] as $student){
                $dataHomework = array();
                foreach($data['getHomework'] as $hmwrk){
                    $data['getSubmitHomework'] = HomeworkSubmitModel::getSubmitHomeworkByClassSubject($hmwrk->id);
                    // $dataHomework[] = $data['getSubmitHomework'];
                    foreach($data['getSubmitHomework'] as $smbt){
                        if(($hmwrk->id == $smbt->homework_id) && ($student->id == $smbt->student_id)){
                            $d['tugas_id'] = $hmwrk->id;
                            // $d['tugas_title'] = $hmwrk->tugas_title;
                            $d['nilai'] = $smbt->nilai;
                            $dataHomework[] = $d;
                        }
                        $student->nilai = $dataHomework;
                    }
                }
                // dd($student);
            }
            // dd($data['getStudent']);
            // $data['getSubmitHomework'] = HomeworkSubmitModel::getSubmitHomeworkByClassSubject($request->get('class_id'), !empty($request->get('subject_id')));
        }

        $remove_pagination = 1;
        return $data['getStudent'];
    }
}
