<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller

{
    // implementing middleware ,we must change basecontroller for laravel 12.
    public function __construct()
    {
        $this->middleware('permission:view roles')->only('index');
        $this->middleware('permission:edit roles')->only('edit', 'update');
        $this->middleware('permission:create roles')->only('create', 'store');
        $this->middleware('permission:delete roles')->only('destroy');
    }

    public function index()
    {

        $roles = Role::orderBy('name', 'ASC')->paginate(10);

        return view('roles.list', compact('roles'));

    }

    public function create()
    {


        $permissions = Permission::orderBy('name', 'ASC')->get();
        return view('roles.create', compact('permissions'));
    }




    public function store(Request $request)
    {



        $validator = Validator::make($request->all(), [

            'name' => 'required|unique:roles|min:3'
        ]);

        if ($validator->passes()) {
            $role = Role::create([

                "name" => $request->name,


            ]);

            //if will check permission are assigned to role or not ? 
            //either it givepermissionTo role or permisions =null

            if (!empty($request->permission)) {

                foreach ($request->permission as $name) {

                    $role->givePermissionTo($name);
                }
            }

            return redirect()->route('roles.index')->with('success', 'Role added successfully');
        } else {
            return redirect()->route('roles.create')->withInput()->withErrors($validator);
        }
    }

    public function edit($id)
    {

        $role = Role::findorFail($id);

        $haspermissions = $role->permissions->pluck('name');  //assigned permission name to a role
        $permissions = Permission::orderBy('name', 'ASC')->get(); // Those permissions list already created


        return view('roles.edit', compact('role', 'permissions', 'haspermissions'));
    }

    public function update($id, Request $request)
    {

        $role = Role::findorFail($id);
        $validator = Validator::make($request->all(), [

            'name' => 'required|unique:roles,name,' . $id,
        ]);

        if ($validator->passes()) {

            $role->name = $request->name;
            $role->save();


            if (!empty($request->permission)) {

                $role->syncPermissions($request->permission);
            } else {

                $role->syncPermissions([]);
            }

            return redirect()->route('roles.index')->with('success', 'Role updated successfully');
        } else {
            return redirect()->route('roles.edit', $id)->withInput()->withErrors($validator);
        }
    }

    public function destroy(Request $request)
    {

        $id=$request->id;
        $role = Role::find($id);


        if ($role == null) {
            session()->flash('error', 'Role not found');
            return response()->json([
                                            //used ajax 
                'status' => false
            ]);
        }

        $role->delete();

        session()->flash('success', 'Role deleted');
        return response()->json([

            'status' => true
        ]);
    }
}
