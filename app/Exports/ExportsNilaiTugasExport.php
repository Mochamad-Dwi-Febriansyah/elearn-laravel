<?php

namespace App\Exports;

use App\Models\HomeworkSubmitModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportsNilaiTugasExport implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }
    public function headings(): array{
        return [
            "ID", 
            "Name",
            "Nilai"
        ];
    }
    public function map($value): array{
  
        $student_name = $value->users_name.''.$value->last_name;
        
        return [
            $value->id,
            $student_name,    
            $value->nilai,    
        ];
    }
    public function collection()
    { 
        return HomeworkSubmitModel::getRecord($this->id);
    }
}
