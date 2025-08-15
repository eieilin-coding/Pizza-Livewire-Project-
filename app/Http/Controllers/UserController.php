<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\UserExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;

class UserController extends Controller
{
    public function excel(){
        $filename = now()->format('d-m-Y_H.i.s');
        return Excel::download(new UserExport, 'DataUser_'.$filename.'.xlsx');
    }

    public function pdf() {
       $filename = now()->format('d-m-Y_H.i.s');

       $data = array(
        'user' => User::get(),
        'date' => now()->format('d-m-Y_H.i.s'),
       );
       
       $pdf = Pdf::loadView('superadmin/user/pdf', $data);
    return $pdf->setPaper('a4', 'landscape')
    ->stream('DataUser_'.$filename.'.pdf');
       
    }
}
