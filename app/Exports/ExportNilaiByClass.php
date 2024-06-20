<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\HomeworkSubmitModel;
use App\Models\User;
use App\Models\HomeworkModel;

class ExportNilaiByClass implements FromCollection, WithMapping, WithHeadings
{
    protected $class_id;
    protected $subject_id;
    protected $homework_ids;

    public function __construct($class_id, $subject_id) {
        $this->class_id = $class_id;
        $this->subject_id = $subject_id;
        $this->homework_ids = []; // Inisialisasi array untuk menampung ID tugas
    }

    public function headings(): array {
        // Pastikan bahwa $this->homework_ids sudah terisi dengan ID tugas yang relevan
        if (empty($this->homework_ids)) {
            return ["Student ID", "Student Name"]; // Jika belum terisi, kembalikan headings default
        }

        // Inisialisasi array headings dengan ID dan Nama Siswa
        $headings = ["Student ID", "Student Name"];

        // Menambahkan setiap tugas ke dalam headings
        foreach ($this->homework_ids as $homework_id) {
            $headings[] = "tugas " . $homework_id;
        }
        // dd($headings);
        return $headings;
    }

    public function map($value): array {
        $student_name = $value->name . ' ' . $value->last_name;

        // Inisialisasi array result dengan ID dan Nama Siswa
        $result = [
            'id' => $value->id,
            'name' => $student_name,
        ];

        // Pastikan bahwa $this->homework_ids sudah terisi dengan ID tugas yang relevan
        foreach ($this->homework_ids as $homework_id) {
            $key = "tugas " . $homework_id;
            $result[$key] = $value->{$key};
        }
        // dd($result);
        return $result;
    }

    public function collection() {
        if (!empty($this->class_id) && !empty($this->subject_id)) { 
            // Mengambil data siswa berdasarkan class_id
            $data['getStudent'] = User::getStudentClass($this->class_id);
        
            // Mengambil data tugas berdasarkan class_id dan subject_id
            $data['getHomework'] = HomeworkModel::getRecordTeacherClassSubject($this->class_id, $this->subject_id);
        
            // Menyimpan ID tugas untuk digunakan dalam headings dan map
            foreach ($data['getHomework'] as $hmwrk) {
                $this->homework_ids[] = $hmwrk->id;
            }

            // Iterasi setiap siswa untuk mengambil nilai tugas
            foreach ($data['getStudent'] as $student) {
                // Inisialisasi nilai tugas di level atas
                foreach ($this->homework_ids as $homework_id) {
                    $student->{"tugas " . $homework_id} = null;
                }
        
                // Mengambil data pengumpulan tugas berdasarkan homework_id
                foreach ($data['getHomework'] as $hmwrk) {
                    $data['getSubmitHomework'] = HomeworkSubmitModel::getSubmitHomeworkByClassSubject($hmwrk->id);
        
                    // Memasukkan nilai ke dalam properti siswa
                    foreach ($data['getSubmitHomework'] as $smbt) {
                        if ($student->id == $smbt->student_id) {
                            $student->{"tugas " . $hmwrk->id} = $smbt->nilai;
                        }
                    }
                }
            }
        
            return collect($data['getStudent']);
        }
        
        return collect([]);
    }
}
