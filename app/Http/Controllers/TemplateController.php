<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class TemplateController extends Controller
{
    public function dupakTemplate(){
    	$pdf = PDF::loadView('admin.laporan.dupak.index');
    	return $pdf->stream('dupak.pdf');
    	/*return view('admin.laporan.dupak.index');*/
    }


    public function dupakUser($user_id){
    	$person = DB::table('users');
    }
}
