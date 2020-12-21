<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Event, App\models\Spt, App\models\DetailSpt, App\models\DetailKuota;
use Redirect, Response, DB, App\Common;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) 
        {
 
         $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');         
         $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');
 
         $data = Event::whereDate('start', '>=', $start)->whereDate('end',   '<=', $end)->get(['id','title','start', 'end', 'info']);
         return Response::json($data);
        }
        return view('admin.calendar.index');
    }

    public function getHoliday(){
        if(request()->ajax()) 
        {
 
         $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
         $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');
 
         $data = Event::whereDate('start', '>=', $start)->whereDate('end',   '<=', $end)->where('info',null)->get(['id','title','start', 'end', 'info']);
         return Response::json($data);
        }
        
    }

    public function getSptAuditor(Request $request){
        $user_id = ($request->user_id) ? $request->user_id : auth()->user()->id;        
        //processed only on ajax request
        if(request()->ajax()) 
        {
         $user = auth()->user()->id;

         $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
         $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');
         //$user_id = ($user->hasRole(['Super Admin', 'Administrasi Umum'])) ? auth()->user()->id; 
         
        $data = DB::table('spt')
            ->join('jenis_spt', 'spt.jenis_spt_id' , '=', 'jenis_spt.id')
            ->join('detail_spt', 'spt.id', '=', 'detail_spt.spt_id')
            ->select('jenis_spt.sebutan as title', 'jenis_spt.name as deskripsi', 'jenis_spt.kategori as kategori','spt.tgl_mulai as start', 'spt.tgl_akhir as end', 'detail_spt.dupak as dupak')
            ->where('detail_spt.user_id', '=', $user_id)
            ->where('spt.nomor','!=', NULL)
            ->get();       
         
         return Response::json($data);
        }
        //return view('admin.calendar.user.index');
    }

    public function getLembur(Request $request){
        //get data from kuota kalender
        $user_id = ($request->user_id) ? $request->user_id : auth()->user()->id;        
        //processed only on ajax request
        if(request()->ajax()) 
        {

         $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
         $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');
         
        $details = DetailKuota::whereJsonContains('detail_kuota', ['user_id' => $user_id])->get();
        $data = [];
        foreach($details as $detail){
            $detail_kuota = json_decode($detail->detail_kuota, true);
            if(!is_null($detail_kuota)){
                $users = array_column($detail_kuota,'user_id');
                $key = array_search($user_id, $users);
                //array_search('100', array_column($userdb, 'uid'));
                if(False !== $key && $detail_kuota[$key]['jumlah_spt'] >=2){
                    //$jumlah_spt = array_column($detail_kuota,'jumlah_spt');
                    array_push($data, [
                        'title' => 'lembur',
                        'start' => $detail->tanggal,
                        //'end' => $detail->tanggal,
                        'kategori' => 'lembur',
                        'jumlah_spt'=> $detail_kuota[$key]['jumlah_spt']
                    ]);
                }
            }            
        }
        //$data = json_encode($data);
        
         return Response::json($data);
        }
    }

    public function getLemburPengawasan(){
        if(request()->ajax()) 
        {
 
         $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
         $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');
         $user_id = auth()->user()->id;          
         
         return Response::json($data);
        }
    }

    public function calendarPdf(){
        if(request()->ajax()) 
        {
 
         $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
         $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');
 
         $data = Event::whereDate('start', '>=', $start)->whereDate('end',   '<=', $end)->get(['id','title','start', 'end', 'info']);
         return Response::json($data);
        }
        $pdf =PDF::loadView('admin.calendar.index')->setPaper([0,0,583.65354,877.03937],'portrait'); //setpaper = ukuran kertas custom sesuai dokumen word dari mbak ita
        return $pdf->stream('calendar.pdf',array('Attachment'=>1));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //dd($request);
        $info = [];
        $user = auth()->user();
        if($user->hasAnyRole(['Super Admin', 'TU Perencanaan'])){
            $info['user_id'] = $user->id;
            $info['type'] = 'user_event';
            $info['jenis'] = $request->jenis;
        }
        $this->validate($request,[
            'title' => 'required|string|max:255|min:1',
            'start' => 'required|date',
            'end' => 'required|date|after_or_equal:start'
        ]);  
        $insertArr = [ 'title' => Common::cleanInput($request->title),
                       'start' => $request->start,
                       'end' => $request->end,
                       'info' => null //set to null to add holiday (libur hari besar)
                    ];
        $event = Event::create($insertArr);   
        return Response::json($event);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request)
    {
        $where = array('id' => $request->id);
        $updateArr = ['title' => $request->title,'start' => $request->start, 'end' => $request->end];
        $event  = Event::where($where)->update($updateArr);
 
        return Response::json($event);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $event = Event::where('id',$request->id)->delete();
   
        return Response::json($event);
    }

    public function userEventChange($id){
        $event = Event::findOrFail($id);
        //check if this user authed to update current event
        $user_id = auth()->user()->id;
        if($event->event_type === 'user_event'  && $event->event_user_id === $user_id){
            $event['start'] = date('d-m-Y', strtotime($event->start));
            $event['end'] = date('d-m-Y', strtotime($event->end));
            return $event;
        }
        return 'not allowed';
    }

    public function updateUserEvent(Request $request){
        $this->validate($request, [
            'event_id' => 'required|integer',
            'title' => 'required|string|min:5',
            'start'=>'required|date_format:"d-m-Y"',
            'end' =>'required|date_format:"d-m-Y"|after_or_equal:start',
            'jenis' => 'required'
            ]
        );
        $info = [];
        $user = auth()->user();
        $info['user_id'] = $user->id;
        $info['type'] = 'user_event';
        $info['jenis'] = $request->jenis;

        $event = Event::findOrFail($request->event_id);
        $event->title = Common::cleanInput($request->title);
        $event->start = date('Y-m-d H:i:s',strtotime($request['start']));
        $event->end = date('Y-m-d H:i:s',strtotime($request['end']));
        $event->info = $info;
        
        return ( $event->save() ) ? $event : 'update error';
    }

    public function deleteUserEvent($id){
        $event = Event::findOrFail($id);
        if($event->event_user_id == auth()->user()->id) {
            Event::destroy($id);
            return 'Event deleted';
        }else{
            return 'Not authorized to perform this action.';
        }        
    }

    public function getUserEvent(){
        $user = auth()->user();
    }
}
