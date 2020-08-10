<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;
use Redirect,Response;

class PermissionController extends Controller
{
    public function __construct() {
        $this->middleware(['auth', 'isAdmin']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::all();
        return view('admin.permission.index')->with('permissions', $permissions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=>'required|max:40',
            ]
        );
        $data = [
            'name'=>$request['name'],
        ];

        $name = $request['name'];
        $permission = new Permission();
        $permission->name = $name;
        
        //$roles = $request['roles'];

        return $permission::create($data);        

        /*if (!empty($request['roles'])) { //If one or more role is selected
            foreach ($roles as $role) {
                $r = Role::where('id', '=', $role)->firstOrFail(); //Match input role to db record

                $permission = Permission::where('name', '=', $name)->first(); //Match input //permission to db record
                $r->givePermissionTo($permission);
            }
        }*/



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
        return Permission::findOrFail($id);
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
        $permission = Permission::findOrFail($id);
        $this->validate($request, [
            'name'=>'required|max:40',
        ]);
        $input = $request->all();
        if ($permission->fill($input)->save()){
            return 'Updated!';
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        if ($permission->name == "Administer roles & permissions"){
            //return "Primary roles : Cannot delete this roles!";
            $data[] = [
                'class' => 'alert-warning alert-dismissible fade show',
                'message' => 'Primary roles : Cannot delete this roles!',
            ];
            return $data;
        }else{
            Permission::destroy($id);
            $data[] = [
                'class' => 'alert-success alert-dismissible fade show',
                'message' => 'Permission deleted!',
            ];
            return $data;
        }
        
    }

    public function getData(){
        //dd('here iam');
        $role = Role::get();
        $permissions = Permission::all();

        //dd($permissions);
        return Datatables::of($permissions)
                ->addIndexColumn()
                ->editColumn('created_at', function ($permission) {
                    return $permission->created_at->format('d/m/Y H:i:s');
                })
                ->addColumn('action', function($permission){
                    return '<a href="javascript:void(0);" onclick="editForm('. $permission->id .')" class="btn btn-outline-primary btn-sm">'. __("Edit") .' </a> '.
                        '<a href="javascript:void(0);" onclick="deleteData('. $permission->id .')" class="btn btn-outline-danger btn-sm btn-delete">'. __("Delete") .'</a>'; 
                /*->addColumn('action', function($permission){
                    return '<a href="javascript:void(0);" onclick="editForm('. $permission->id .')" class="btn btn-outline-primary btn-sm">'. __("Edit") .' </a> '.
                        '<a href="javascript:void(0);" data-id="$permission->id" data-name="$permission->name" class="btn btn-outline-danger btn-sm btn-delete">'. __("Delete") .'</a>';   */                    
                })->make(true); 
    }
}
