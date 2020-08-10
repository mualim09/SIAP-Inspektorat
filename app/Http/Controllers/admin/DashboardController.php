<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\models\Spt, App\User, App\models\DetailSpt;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;
use App\Common;
use Config;
use DB, PDF;

class DashboardController extends Controller
{
    private $spt = [];
    public function __construct() {
        $this->middleware(['auth', 'permission:Access admin page']); 
    }
    public function index(){    	
    	/*$spt['approved'] = Spt::where('approval_status','=','approved')->get();
    	$spt['unsigned'] = Spt::where('approval_status','=','processing')->get();
    	$spt['rejected'] = Spt::where('approval_status','=','rejected')->get();*/
        $spt = Spt::whereNull('nomor');

    	return view('admin.index',['spt'=>$spt,'user'=> User::all()]);
    }
}
