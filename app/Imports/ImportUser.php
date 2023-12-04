<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash; 

class ImportUser implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'parent_id' => $row[1],
            'nis'    => $row[2],
            'name'    => $row[3],
            'last_name'   => $row[4],
            'email'    => $row[5],
            'email_verified_at'    => $row[6],
            'password'    => Hash::make($row[7]),
            'remember_token'    => $row[8],
            'admission_number'    => $row[9],
            'roll_number'    => $row[10],
            'class_id'    => $row[11],
            'gender'    => $row[12],
            'date_of_birth'    => $row[13],
            'caste'    => $row[14],
            'religion'    => $row[15],
            'mobile_number'    => $row[16],
            'admission_date'    => $row[17],
            'profile_pic'    => $row[18],
            'blood_group'    => $row[19],
            'height'    => $row[20],
            'weight'    => $row[21],
            'occupation'    => $row[22],
            'address'    => $row[23],
            'marital_status'    => $row[24],
            'permanent_address'    => $row[25],
            'qualification'    => $row[26],
            'work_experience'    => $row[27],
            'note'    => $row[28],
            'user_type'    => $row[29],
            'is_delete'    => $row[30],
            'status'    => $row[31], 
        ]);
    }
}
