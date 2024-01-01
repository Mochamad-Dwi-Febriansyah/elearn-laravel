<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\WeekModel;

class ClassSubjectTimetableModel extends Model
{
    use HasFactory;
    protected $table = 'class_subject_timetable';
    static public function getRecordClassSubject($class_id, $subject_id, $week_id){
        $return = ClassSubjectTimetableModel::select('class_subject_timetable.*', 'week.id as week_id', 'week.name as week_name')->
        where('class_id', '=',$class_id)->where('subject_id', '=',$subject_id)->where('week_id', '=',$week_id)->join('week', 'class_subject_timetable.week_id','=','week.id')->first();
        return $return;
    }
}
