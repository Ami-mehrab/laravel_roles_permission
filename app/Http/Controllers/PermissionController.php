<?php

namespace App\Http\Controllers;

use Faker\Provider\ar_EG\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view permissions')->only('index');
        $this->middleware('permission:edit permissions')->only('edit', 'update');
        $this->middleware('permission:create permissions')->only('create', 'store');
        $this->middleware('permission:delete permissions')->only('destroy');
    }

    
    public function index(){


        $permissions=Permission::orderBy('created_at','DESC')->paginate(10);
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

//if we use ajax and retun json
public function destroy(Request $request){

    $id=$request->id;

   $permission= Permission::find($id);


   if($permission==null){
    session()->flash('error','permission not found');
    return response()->json([
                                            //used ajax 
        'status'=>false   
    ]);

   }

   $permission->delete();

   session()->flash('success','permission deleted');
   return response()->json([
                                        
       'status'=>true  
   ]);


}


}





