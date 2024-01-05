<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JurnalStudentAreAbsentModel extends Model
{
    use HasFactory;
    protected $table = 'jurnal_student_are_absent';
    static public function getAlreadyFirst($id, $student_id){
        return self::where('jurnal_id', '=', $id) 
                        ->where('student_id', '=', $student_id)
                        ->first();
    }
    static public function getRecord(){
        return self::join('users', 'jurnal_student_are_absent.student_id','=', 'users.id')
                    ->get();
    }
    static public function getRecordStudentByJurnal($jurnal_id){
        return self::where('jurnal_id', '=', $jurnal_id)
                    ->join('users', 'jurnal_student_are_absent.student_id','=', 'users.id')
                    ->get();
    }
 
}
