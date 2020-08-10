<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use App\Http\Controllers\Controller;
use App\User;
use App\models\Sertifikat;
use App\models\Profile;
use Yajra\DataTables\DataTables;
use jeremykenedy\LaravelLogger\App\Http\Traits\ActivityLogger;
use jeremykenedy\LaravelLogger\App\Http\Traits\IpAddressDetails;
use jeremykenedy\LaravelLogger\App\Http\Traits\UserAgentDetails;
use jeremykenedy\LaravelLogger\App\Models\Activity;

class ProfileController extends Controller
{
    
    public function __construct() {
        $this->middleware('auth'); 
    }

    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {        
        $profile = User::findOrFail(auth()->user()->id)->profile;
        
        
        return view('profile.edit')->with('profile',$profile);
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {
        auth()->user()->update($request->only('firs_name','last_name', 'email','phone'));
        $data = [
    		'user_id' => $request['user_id'],
    		'address' => $request['address'],
    		'country' => $request['country'],
    		'city' => $request['city'],
    		'zipcode' => $request['zipcode'],
    		'about' => $request['about']
    	];
        $profile = Profile::findOrFail($request['id']);
        if (isset($request['pic'])) {
	        $profile->addMediaFromRequest('pic')->toMediaCollection('pic');
	        return 'Profile picture updated!';
	    }
        if ($profile->fill($data)->save()){
            return $this->getData();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfileRequest $request){
    	$data = [
    		'user_id' => $request['user_id'],
    		'address' => $request['address'],
    		'country' => $request['country'],
    		'city' => $request['city'],
    		'zipcode' => $request['zipcode'],
    		'about' => $request['about']
    	];

    	return ( Profile::create($data) ) ? $this->getData() : 'Error processing your request.';
    }

    public function getData(){
    	$profile = User::findOrFail(auth()->user()->id)->profile;
    	return $profile;
    }

    public function profilePicUpdate(ProfileRequest $request){   	
    	
    	$this->validate($request, [            
            'pic' => 'nullable|image|mimes:jpeg,png,jpg|max:1048',
            ]
        );
    	
    	$profile = Profile::findOrFail($request['profile_id']);
    	if (isset($request['pic'])) {
	        if($profile->getFirstMediaUrl('pic') !== ''){
	        	//delete old profile pic
	        	$profile->clearMediaCollection('pic');
	        }
	       $profile->addMediaFromRequest('pic')->toMediaCollection('pic');
	        $data = [
	        	'real' => $profile->getFirstMediaUrl('pic'),
	        	'thumb' => $profile->getFirstMediaUrl('pic','thumb'),
	        ];

	        return (!empty($data)) ? $data :  redirect()->route('myprofile');	       
	    }

    }

    /*public function Activity()
    {
        $log = Activity::all();
        // return view('admin.logger.index',['log'=>$log]);
        return Datatables::of($log)
                ->addIndexColumn()
                ->addColumn('laravel_logger_activity', function($log){
                    return route('useract', $log->name);
                })->make(true);
    }*/

    public function UserActivity()
    {
        $a = Auth::user('id');
        $log = Activity::all();
        // {{dd($log);}}
        // return view('admin.logger.index',['log'=>$log]);
        return Datatables::of($log)
                ->addIndexColumn()
                ->addColumn('laravel_logger_activity', function($logs){
                    return route('useract', $logs->name);
                })->make(true);
    }

    public function viewActivity(){
        return view('admin.activity.bindex');
    }

    public function getSertifikatUsers()
    {
        $sertifikat = Sertifikat::where('user_id',auth()->user()->id)->get();
        // dd($sertifikat);

        $data = Datatables::of($sertifikat)
                ->addIndexColumn()
                ->addColumn('nama_sertifikat', function($data){
                    return $data->nama_sertifikat;
                })
                ->addColumn('created_at', function($data){
                    return $data->created_at->format('d-M-Y');
                })
                ->addColumn('action', function($data){
                    return '<a href="#" onclick="showModalLihatSertifikatbyUser('.$data->id.')" data-toggle="tooltip" title="Lihat Sertifikat" class="btn btn-succes"><i class="ni ni-paper-diploma"></i></a>';
                })
                ->make(true);
        return $data;
    }

    public function dataSertifikat($id)
    {
        $dataSertifikat = Sertifikat::where('id', $id)->get();
        // dd($dataSertifikat);
        return $dataSertifikat;
    }


}
