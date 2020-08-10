<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;
use Redirect,Response;


class RoleController extends Controller
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
        $roles = Role::all();
        $permissions = Permission::all();
        return view('admin.role.index')->with(['roles'=> $roles, 'permissions'=>$permissions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->route('roles.index');
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
            'name'=>'required|unique:roles|max:40',
            'permissions' =>'required',
            ]
        );

        $name = $request['name'];
        $role = new Role();
        $role->name = $name;

        $permissions = $request['permissions'];

        $role->save();
        
        foreach ($permissions as $permission) {
            $p = Permission::where('id', '=', $permission)->firstOrFail(); 
         //Fetch the newly created role and assign permission
            $role = Role::where('name', '=', $name)->first(); 
            $role->givePermissionTo($p);
        }
        return 'Role : '. $role->name . ' created!';


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->route('roles.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $role = Role::find($id);
        $permissions = $role->permissions;
        return $role;
        return $permissions;
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
        $role = Role::findOrFail($id);//Get role with the given id
    //Validate name and permission fields
        $this->validate($request, [
            'name'=>'required|max:40|unique:roles,name,'.$id,
            'permissions' =>'required',
        ]);

        $input = $request->except(['permissions']);
        $permissions = $request['permissions'];
        $role->fill($input)->save();

        $p_all = Permission::all();//Get all permissions

        foreach ($p_all as $p) {
            $role->revokePermissionTo($p); //Remove all permissions associated with role
        }

        foreach ($permissions as $permission) {
            $p = Permission::where('id', '=', $permission)->firstOrFail(); //Get corresponding form //permission in db
            $role->givePermissionTo($p);  //Assign permission to role
        }

        return 'Role updated!';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Role::destroy($id);
    }

    public function getData(){
        //$roles = Role::all();
        //DB::statement(DB::raw('set @rownum=0'));
        $roles = Role::all();
        
        return Datatables::of($roles)
                ->addIndexColumn()
                ->editColumn('created_at', function ($role) {
                    return $role->created_at->format('d/m/Y H:i:s');
                })
                ->addColumn('details_url', function($role){
                    return route('api.role_single_details', $role->id);
                })
                ->addColumn('action', function($role){
                    return '<a href="javascript:void(0);" onclick="editForm('. $role->id .')" class="btn btn-outline-primary btn-sm">'. __("Edit") .' </a> '.
                        '<a href="javascript:void(0);" onclick="deleteData('. $role->id .')" class="btn btn-outline-danger btn-sm">'. __("Delete") .'</a>';                        
                })->make(true); 
    }

    public function getMasterDetailsData()
    {
        $role = Role::select();
        return Datatables::of($role)
            ->addColumn('details_url', function($role) {
                return route('api.role_single_details', $role->id);
            })->make(true);
    }

    public function getMasterDetailsSingleData($id)
    {
        $permission = Role::findOrFail($id)->permissions;
        return Datatables::of($permission)->make(true);
    }
}
