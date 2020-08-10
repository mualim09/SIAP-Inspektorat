<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\models\Resiko;
use Carbon\Carbon;
use Config;
use DB, PDF;

class ResikoController extends Controller
{
    public function index()
    {
    	return view('admin.resiko.index');
    }

    public function insertResiko(Request $request)
    {
    	// $data = $request['opd'];
    	// if ($data == null) {
    	// 	return 'data kosong boy, please try again';
    	// }else{
    	// 	return 'data ada isinya'.$data;	
    	// }
    	$this->validate($request, [
            'opd'=>'required|string',
            'nama_kegiatan'=>'required|string|max:255|min:5',
            'tujuan_kegiatan'=>'required|string|max:255|min:5',
            'sasaran_pd'=>'required|string|max:255|min:5',
            'tujuan_pd'=>'required|string|max:255|min:5',
            'capaian'=>'required|string|max:255|min:5',
            'tujuan'=>'required|string|max:255|min:5'
            ]);
        
        $dataResiko = [
            'opd' => $request['opd'],
            'nama_kegiatan' => $request['nama_kegiatan'],
            'tujuan_kegiatan' => $request['tujuan_kegiatan'],
            'sasaran_pd' => $request['sasaran_pd'],
            'tujuan_pd' => $request['tujuan_pd'],
            'capaian' => $request['capaian'],
            'tujuan' => $request['tujuan']
        ];

        $data = Resiko::create($dataResiko);
        return $data.'success';
    }

    public function getDataResiko()
    {
    	$cols = Resiko::all();
        $data = Datatables::of($cols)
                ->addIndexColumn()
                // return data to view
                ->addColumn('resiko', function($col){
                    return route('resikoindex', $col->id);
                })
                
                // ->addColumn('nama_skpd', function($col){
                //     return $col->relasi_tbl_skpd->nama_skpd;
                // })
                // ->addColumn('sasaran_kegiatan', function($col){
                //     return $col->relasi_tbl_kegiatan->sasaran_kegiatan;
                // })
                // ->addColumn('nama_kegiatan', function($col){
                //     return $col->nama_kegiatan;
                // })
                ->addColumn('action', function($col){
                    return '<a href="'.route('resikoPDF',$col->id).'" class="btn btn-outline-warning btn-sm">'. __("View") .'</a>'.'<a href="'.route('deleteDataResiko',$col->id).'" class="btn btn-outline-danger btn-sm">'. __("Hapus Data") .'</a>';
                    
                })->make(true);
        return $data;
    }

    public function deleteResiko($id)
    {
    	$data = Resiko::findOrFail($id);
    	return destroy($data);
    }

    public function resikoPdf($id)
    {
    	return 'pdf berjalan';
    }

}
