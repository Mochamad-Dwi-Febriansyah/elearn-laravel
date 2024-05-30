<?php

namespace App\Exports;

use App\Models\HomeworkSubmitModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportNilaiTugasExport implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array{
        return [
            "ID", 
            "Name",
            "Nilai"
        ];
    }
    public function map($value): array{
  
        $student_name = $value->student_name_first.''.$value->student_name_last;
        
        return [
            $value->id,
            $student_name,    
            $value->nilai,    
        ];
    }
    public function collection()
    {
        $remove_pagination = 1;
        return HomeworkSubmitModel::getRecord($remove_pagination);
    }
}
