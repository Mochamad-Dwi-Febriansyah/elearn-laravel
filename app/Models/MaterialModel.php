<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class MaterialModel extends Model
{
    use HasFactory;
    protected $table = 'material';
    static public function getSingle($id){
        return self::find($id);
    }
    static public function getSingleRecord($id){
        $return = MaterialModel::select('material.*', 'class.name as class_name', 'subject.name as subject_name', 'users.name as created_by_name')
        ->join('users','users.id', '=','material.created_by')
        ->join('class','class.id', '=','material.class_id')
        ->join('subject','subject.id', '=','material.subject_id')
        ->find($id);
        return $return;
    } 
    static public function getRecord(){
        $return = MaterialModel::select('material.*', 'class.name as class_name', 'subject.name as subject_name', 'users.name as created_by_name')
                                    ->join('users','users.id', '=','material.created_by')
                                    ->join('class','class.id', '=','material.class_id')
                                    ->join('subject','subject.id', '=','material.subject_id')
                                    ->where('material.is_delete', '=', 0);

                                    if(!empty(Request::get('class_name'))){
                                        $return = $return->where('class.name', 'like', '%'. Request::get('class_name'). '%');
                                    }
                                    if(!empty(Request::get('subject_name'))){
                                        $return = $return->where('subject.name', 'like', '%'. Request::get('subject_name'). '%');
                                    }  
                                    if(!empty(Request::get('from_created_date'))){
                                        $return = $return->whereDate('material.created_at', '>=', Request::get('from_created_date'));
                                    } 
                                    if(!empty(Request::get('to_created_date'))){
                                        $return = $return->whereDate('material.created_at', '<=', Request::get('to_created_date'));
                                    } 
    

        $return = $return->orderBy('material.id', 'desc')
                                    ->paginate(20);
        return $return;
    }
    static public function getRecordByClassSubject($class_id, $subject_id){
        $return = MaterialModel::select('material.*', 'class.name as class_name', 'subject.name as subject_name', 'users.name as created_by_name')
            ->join('users','users.id', '=','material.created_by')
            ->join('class','class.id', '=','material.class_id')
            ->join('subject','subject.id', '=','material.subject_id')
            ->where('material.class_id', '=', $class_id)
            ->where('material.subject_id', '=', $subject_id); 
        $return = $return->orderBy('material.id', 'desc')
                                    ->paginate(20);
        return $return;
    }
    static public function getRecordTeacher($class_ids){ 
        $return = MaterialModel::select('material.*', 'class.name as class_name', 'subject.name as subject_name', 'users.name as created_by_name')
                                    ->join('users','users.id', '=','material.created_by')
                                    ->join('class','class.id', '=','material.class_id')
                                    ->join('subject','subject.id', '=','material.subject_id')
                                    ->where('material.class_id' ,'=', $class_ids)
                                    ->where('material.is_delete', '=', 0);

                                    if(!empty(Request::get('class_name'))){
                                        $return = $return->where('class.name', 'like', '%'. Request::get('class_name'). '%');
                                    }
                                    if(!empty(Request::get('subject_name'))){
                                        $return = $return->where('subject.name', 'like', '%'. Request::get('subject_name'). '%');
                                    }  
                                    if(!empty(Request::get('from_created_date'))){
                                        $return = $return->whereDate('homework.created_at', '>=', Request::get('from_created_date'));
                                    } 
                                    if(!empty(Request::get('to_created_date'))){
                                        $return = $return->whereDate('homework.created_at', '<=', Request::get('to_created_date'));
                                    } 
    

        $return = $return->orderBy('material.id', 'desc')
                                    ->paginate(20);
        return $return;
    } 
    public function getDocument(){
        if(!empty($this->document_file && file_exists('upload/material/'.$this->document_file) )){
            return url('upload/material/'.$this->document_file);
        }else{
            return "";
        }
    } 
}
