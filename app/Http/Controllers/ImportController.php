<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImportController extends Controller
{
    public function importUser(Request $req)
    {
        (new App\Imports\UsersImport)->import('Idno.xlsx', 'local', \Maatwebsite\Excel\Excel::XLSX);
    }
}
