<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Lokasi;
use Yajra\DataTables\DataTables;
use App\Common;

class LokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.lokasi.list');    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $this->validate($req, [
            'lokasi' => 'required',
            'sebutan_pimpinan' => 'required',
            ]
        );

        $string = $req['lokasi'];
        $word  = "Desa";
        $paramaterStrings = array('Desa','Kelurahan','Kecamatan');

        $matches = array();
        $matchFound = preg_match_all(
                        "/\b(" . implode($paramaterStrings,"|") . ")\b/i", 
                        $string, 
                        $matches
                      );

        $lokasi = $req['lokasi'];
        $tambahan = 'Sekretariat Daerah';

        if($req['sebutan_pimpinan'] == 'Kepala Bagian'){
            $hasil = $tambahan." (".$lokasi.")";
        }elseif($matchFound && $req['sebutan_pimpinan'] == 'Kepala' || $req['sebutan_pimpinan'] == 'kepala' || $req['sebutan_pimpinan'] == 'Lurah' || $req['sebutan_pimpinan'] == 'Camat'){
            
            $words = array_unique($matches[0]);
              foreach($words as $word) {

                //show bad words found
                if(strpos($string, $word) !== false && $word == 'Desa'){
                    $hasil = "$string Kabupaten Sidoarjo";
                    // dd($hasil);
                }elseif(strpos($string, $word) !== false && $word == 'Kelurahan'){
                    $hasil = "$string Kabupaten Sidoarjo";
                }elseif (strpos($string, $word) !== false && $word == 'Kecamatan') {
                    $hasil = "$string Kabupaten Sidoarjo";
                }else{
                    $hasil = 'error';
                }
            }
        }else{
            $hasil = $req['lokasi'];
        }

        $data = new Lokasi;
        $data->nama_lokasi  = Common::cleanInput($hasil);
        $data->jenis_lokasi = Common::cleanInput($req['kateg_lokasi']);
        $data->sebutan_pimpinan = Common::cleanInput($req['sebutan_pimpinan']);
        $data->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getLokasiPemeriksaan()
    {
        $lokasi_data = Lokasi::all();
        $tb = Datatables::of($lokasi_data)
                ->addIndexColumn()
                ->addColumn('nama_lokasi', function($data){
                    return $data->nama_lokasi;
                })
                ->addColumn('jenis_lokasi', function($data){
                    return $data->jenis_lokasi;
                })
                ->addColumn('action', function($data){
                    //$return = '<a href="javascript:void(0);" onclick="editLokasi('. $data->id .')" outline type="primary" title="Edit Lokasi"><i class="ni ni-single-copy-04"></i></a>';
                    //return $return;
                    return;
                    // $return = $this->buildControl('viewAnggota',$col->id);
                    // $return .= $this->buildControl('cetakPdf',$col->id);
                    // if($col->approval_status == 'processing'){
                    //     $return .= $this->buildControl('editForm',$col->id);
                    //     $return .= $this->buildControl('deleteData',$col->id);
                    // }
                    // return $return;
                })
                ->escapeColumns([])
                ->make(true);
        return $tb;
    }
}
