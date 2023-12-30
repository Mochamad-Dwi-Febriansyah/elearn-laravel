<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MaterialModel;

class JurnalController extends Controller
{ 
    public function MyJurnal(){
        $data['getRecord'] = MaterialModel::getRecord();
        $data['header_title'] = "Material List";
        return view('admin.material.list', $data);
    }
}
