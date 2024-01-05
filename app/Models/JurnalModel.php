<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class JurnalModel extends Model
{
    use HasFactory;
    protected $table = 'jurnal';
    static public function getSingle($id){
        $return  = self::select('jurnal.*', 'class_subject_timetable.start_time as timetable_start','class_subject_timetable.end_time as timetable_end', 'week.name as week_name', 'class.name as class_name', 'subject.name as subject_name', 'users.name as created_by_name')
                        ->join('subject', 'subject.id', '=', 'jurnal.subject_id')
                        ->join('class', 'class.id', '=', 'jurnal.class_id')
                        ->join('users', 'users.id', '=', 'jurnal.created_by')
                        ->join('class_subject_timetable', 'class_subject_timetable.id', '=', 'jurnal.timetable_id')
                        ->join('week', 'class_subject_timetable.week_id', '=', 'week.id')
                        // ->join('jurnal_student_are_absent', 'jurnal_student_are_absent.jurnal_id', '=', 'jurnal.id')
                        ->where('jurnal.is_delete', '=', 0) 
                        ->where('jurnal.id', '=', $id) ;
                        $return = $return->orderBy('jurnal.id', 'desc')
                        ->first();

        return $return;
    }
    static public function getSingleByTokenAkses($tokenAksesJurnal){
        return self::where('token_akses_jurnal', '=', $tokenAksesJurnal)->first();
    }
    static public function getSingleBygetJurnalDateCreate($JurnalDateCreate){
        return self::where('subject_id', '=', $JurnalDateCreate)->first();
    }
    static public function getAlreadyDateCreate($jurnal_date){
        return self::where('jurnal_date', '=', $jurnal_date)
                        ->count();
    } 
    static public function getAlreadyFirst($class_id, $subject_id, $student_id){
        return self::where('class_id', '=', $class_id)
                        ->where('subject_id', '=', $subject_id)
                        ->where('student_id', '=', $student_id)
                        ->first();
    } 
    static public function getRecord(){ 
        $return  = self::select('jurnal.*', 'class_subject_timetable.start_time as timetable_start','class_subject_timetable.end_time as timetable_end', 'week.name as week_name', 'class.name as class_name', 'subject.name as subject_name', 'users.name as created_by_name')
                        ->join('subject', 'subject.id', '=', 'jurnal.subject_id')
                        ->join('class', 'class.id', '=', 'jurnal.class_id')
                        ->join('users', 'users.id', '=', 'jurnal.created_by')
                        ->join('class_subject_timetable', 'class_subject_timetable.id', '=', 'jurnal.timetable_id')
                        ->join('week', 'class_subject_timetable.week_id', '=', 'week.id')
                        // ->join('jurnal_student_are_absent', 'jurnal_student_are_absent.jurnal_id', '=', 'jurnal.id')
                        ->where('jurnal.is_delete', '=', 0) ;
                        if(!empty(Request::get('class_name'))){
                            $return = $return->where('class.name', 'like', '%'. Request::get('class_name'). '%');
                        }
                        if(!empty(Request::get('subject_name'))){
                            $return = $return->where('subject.name','like', '%'. Request::get('subject_name'). '%');
                        }
                        if(!empty(Request::get('date'))){
                            $return = $return->whereDate('subject.created_at', '=', Request::get('date'));
                        }
                        $return = $return->orderBy('jurnal.id', 'desc')
                        ->paginate(20);
        
        return $return;

    }
}
