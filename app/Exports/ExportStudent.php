<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Models\User;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportStudent implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array{
        return [
            "ID",
            "Student ID",
            "Parent Name",
            "Email",
            "Admission Number",
            "Roll Number",
            "Class",
            "Gender",
            "Date Of Birth",
            "Caste",
            "Relogion",
            "Mobile Number",
            "Admission Date",
            "Blood Group",
            "Height",
            "Weight",
            "Status",
            "Created Date",
        ];
    }
    public function map($value): array{

        $student_name = $value->student_name_first.''.$value->student_name_last;
        $parent_name = $value->parent_name.' '.$value->parent_last_name;


        $date_of_birth = '';
        if(!empty($value->date_of_birth)){
            $date_of_birth = date('d-m-Y', strtotime($value->date_of_birth));
        }

        $admission_date = '';
        if(!empty($value->admission_date)){
            $admission_date = date('d-m-Y', strtotime($value->admission_date));
        }

        $status = ($value->status == 0) ? 'Active' : 'Inactive';

        return [
            $value->id,
            $student_name,
            $parent_name,
            $value->email,
            $value->admission_number,
            $value->roll_number,
            $value->class_name,
            $value->gender, 
            $date_of_birth, 
            $value->caste,
            $value->religion,
            $value->mobile_number,
            $admission_date,
            $value->blood_group,
            $value->height,
            $value->weight,
            $status,
            date('d-m-Y', strtotime($value->created_at))
        ];
    }
    public function collection()
    {
        $remove_pagination = 1;
        return User::getStudent($remove_pagination);
    }
}
