<?php

namespace App\Imports;

use App\User;
use App\Department;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;

class UsersImport implements ToModel, WithHeadingRow
{
    use Importable;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        return new User([
            'uname'         => $row['employee_no'],
            'name'          => $row['name'],
            'qrcode'        => Hash::make('SPO'.$row['employee_no']),
            'role_id'       => '3',
            'department_id' => Department::where('name',$row['department'])->pluck('id')[0],
            'password'      => Hash::make('a123456'),
        ]);
    }

}
