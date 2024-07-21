<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class ProjekAkhir extends Model
{
    use HasFactory;
    protected $table = 'projek_akhir';
    static public function getSingle($id){
        return self::find($id);
    }
    static public function getbyClass($class_id){
        return self::select('projek_akhir.*')
                        ->where('class_id', '=', $class_id)  
                        ->get();
    }
    static public function getRecord(){
        $return = ProjekAkhir::select('projek_akhir.*')
                                    // ->join('users','users.id', '=','projek_akhir.created_by') 
                                    ->where('projek_akhir.is_delete', '=', 0)
                                    ->join('class', 'class.id', '=','projek_akhir.class_id');
                                    if(!empty(Request::get('class_name'))){
                                        $return = $return->where('class.name', 'like', '%'. Request::get('class_name'). '%');
                                    } 
    

        $return = $return->orderBy('projek_akhir.id', 'desc')
                                    ->get();
        return $return;
    }
    static public function getAlreadyFirst($class_id, $student_id){
        return self::select('projek_akhir.*', 'class.name as class_name')
                        ->where('class_id', '=', $class_id)
                        ->join('class', 'class.id', '=', 'projek_akhir.class_id')
                        ->where('student_id', '=', $student_id)
                        ->where('projek_akhir.is_delete', '=', 0)
                        ->first();
    }
    static public function cekProjekAnggota($class_id, $student_id){
        return self::select('projek_akhir.*', 'class.name as class_name')
                        ->join('class', 'class.id', '=', 'projek_akhir.class_id')
                        ->join('projek_akhir_anggota', 'projek_akhir_anggota.projek_akhir_id', '=', 'projek_akhir.id')
                        ->where('class_id', '=', $class_id)
                        ->where('projek_akhir_anggota.student_id', '=', $student_id)
                        ->where('projek_akhir.is_delete', '=', 0)
                        ->first();
    }
    static public function getAlreadyFirstGroupbyNamaProyek($class_id, $projek_name){
        return self::select('projek_akhir.*', 'class.name as class_name', 'users.name as user_name', 'users.last_name as user_last_name')
                        ->where('projek_akhir.class_id', '=', $class_id)
                        ->where('nama_projek', '=', $projek_name)
                        ->join('class', 'class.id', '=', 'projek_akhir.class_id')
                        ->join('users', 'users.id', '=', 'projek_akhir.student_id')
                        ->where('projek_akhir.is_delete', '=', 0)
                        ->get();
    }
    // static public function getAlreadyFirstH($class_id, $student_id){
    //     return self::select('projek_akhir.*', 'class.name as class_name', 'users.name as user_name', 'users.last_name as user_last_name')
    //                     ->where('projek_akhir.class_id', '=', $class_id)
    //                     ->where('nama_projek', '=', $projek_name)
    //                     ->join('class', 'class.id', '=', 'projek_akhir.class_id')
    //                     ->join('users', 'users.id', '=', 'projek_akhir.student_id')
    //                     ->get();
    // }
}
