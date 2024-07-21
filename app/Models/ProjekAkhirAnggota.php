<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class ProjekAkhirAnggota extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'projek_akhir_anggota'; 
    static public function getRecord(){
        $return = ProjekAkhirAnggota::select('projek_akhir_anggota.*',  'users.name as user_name', 'users.last_name as user_last_name')
                                    ->join('users','users.id', '=','projek_akhir_anggota.student_id');

                                    // if(!empty(Request::get('class_name'))){
                                    //     $return = $return->where('class.name', 'like', '%'. Request::get('class_name'). '%');
                                    // } 
    

        $return = $return->orderBy('projek_akhir_anggota.id', 'desc')
                                    ->get();
        return $return;
    }
    static public function getAnggota($projek_akhir_id){
        return self::select('users.name as user_name', 'users.last_name as user_last_name')
                        ->join('users', 'users.id', '=', 'projek_akhir_anggota.student_id')
                        ->where('projek_akhir_id', '=', $projek_akhir_id) 
                        ->where('projek_akhir.is_delete', '=', 0)
                        ->get();
    }
}
