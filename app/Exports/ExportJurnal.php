<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\JurnalModel;
use App\Models\User;

class ExportJurnal implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array{
        return [
            "Kelas", 
            "Mata Pelajaran", 
            "Tanggal",
            "Peserta Didik Tidak Hadir", 
            "Kompetensi Dasar",
            "Indikator",
            "Catatan",
        ];
    }
    public function map($value): array{
        // dd($value);
 
        $parent_name = $value->name.' '.$value->last_name;
  
        $status = ($value->status == 0) ? 'Active' : 'Inactive';

        return [
            $value->class_name,
            $value->subject_name,
            date('d-m-Y', strtotime($value->jurnal_date)),
            $parent_name, 
            $value->kd, 
            $value->indikator, 
            $value->catatan, 
        ];
    }
    public function collection()
    {
        $remove_pagination = 1;
        return JurnalModel::getRecord($remove_pagination);
    }
}
