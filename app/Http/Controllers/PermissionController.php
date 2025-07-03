<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{

    
    public function index(){


        $permissions=Permission::orderBy('created_at','DESC')->paginate(5);
        return view('permissions.list',compact('permissions'));
    }


     public function create(){


        return view('permissions.create');
        
    }
    
    public function store(Request $request)
    
    {
        $validator=Validator::make($request->all(),[

            'name'=>'required|unique:permissions|min:3'
        ]);
        
        if ($validator->passes())
        {
            Permission::create([

                "name"=>$request->name ,
                

            ]);
            
            return redirect()->route('permissions.index')->with('success','Permission added successfully');

            
        }
        
            else{
                return redirect()->route('permissions.create')->withInput()->withErrors($validator);
            }
     
        }

     public function edit($id) {


      $permission=Permission::findorFail($id);
       return view('permissions.edit',compact('permission'));
        
    }

   public function update($id, Request $request) {
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255|unique:permissions,name,' . $id,
    ]);

    if ($validator->passes()) {
        $permission = Permission::findOrFail($id);
        $permission->name = $request->name;
        $permission->save();

        return redirect()->route('permissions.index')->with('success', 'Permission updated successfully');
    } else {
        return redirect()->route('permissions.edit', $id)->withInput()->withErrors($validator);
    }
}


 public function delete(){


        
    }
}





