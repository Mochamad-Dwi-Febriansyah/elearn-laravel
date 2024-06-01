<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjekAkhir;
use App\Models\ProjekAkhirAnggota;
use App\Models\AssignClassTeacherModel;
use Illuminate\Support\Facades\Auth;

class ProjekAkhirController extends Controller
{
    // teacher side
    public function MyProjectAkhir(){ 
        $data['header_title'] = "Projek Akhir List";
        $data['getClass'] = AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id);
        $projek = ProjekAkhir::getRecord();
        $anggota = ProjekAkhirAnggota::getRecord();
        $newArr = array();
        foreach($projek as $p){
            $dataProjek = array();
            foreach($anggota as $a){
                // dd(intval($a->projek_akhir_id));
                if($p->id === intval($a->projek_akhir_id)){
                    $dat = array();
                    $dat = $a;
                    // dd($dat);
                    $dataProjek[] = $dat;
                }
            }
            $p['anggota'] = $dataProjek;
            // dd($p);
            $newArr[] = $p; 
        } 
        $data['getRecord'] = $newArr;
        // dd($newArr);
        return view('teacher.my_projek_akhir.my_projek_akhir', $data);
    }
    // student side
    public function postProjekAkhir(Request $request){  
        if(!empty($request->student_id)){
                        $save = new ProjekAkhir;
                        $save->class_id = $request->class_id;
                        $save->nama_projek = $request->nama_projek;
                        $save->created_by = $request->student_created_projek;
                        $save->save();  
            foreach($request->student_id as $student_id){ 
                            $saveAnggota = new ProjekAkhirAnggota;
                            $saveAnggota->projek_akhir_id = $save->id;
                            $saveAnggota->student_id = $student_id;
                            $saveAnggota->save();
                        }
                        return redirect()->back()->with('success', 'Berhasil membuat permintaan');
        }
        else{
            return redirect()->back()->with('error', "Permintaan gagal diproses");
        }
    } 
    public function editMyProjectAkhir($id){
        $data['getRecord'] = ProjekAkhir::getSingle($id);
        if(!empty($data['getRecord'])){ 
            $data['header_title'] = "Edit Projek Akhir";
            return view('teacher.my_projek_akhir.edit', $data);
        }else{
            abort(404);
        }
    }
    
    public function UpdateMyProjectAkhir($id, Request $request){
        $save = ProjekAkhir::getSingle($id);
        $save->tanggal_pengerjaan = $request->tanggal_pengerjaan;
        $save->waktu_mulai = $request->waktu_mulai;
        $save->waktu_selesai = $request->waktu_selesai;
        $save->tempat_pengerjaan = $request->tempat_pengerjaan; 
        $save->catatan = $request->catatan; 
        $save->nilai = $request->nilai; 
        $save->status = $request->status;   
        $save->save();
        
        return redirect('teacher/my_projek_akhir')->with('success', 'Akhir Projek successfully updated.');
    }
    public function DeleteMyProjectAkhir($id){
        $getRecord = ProjekAkhir::getSingle($id);
        if(!empty($getRecord)){
            ProjekAkhirAnggota::where('projek_akhir_id', $getRecord->id)->delete(); 
            $getRecord->delete();
            
            return redirect()->back()->with('success', 'Parent successfully deleted.');
        }else{
            abort(404);
        }
        
    }
    
}
