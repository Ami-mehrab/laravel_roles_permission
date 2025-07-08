<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
     public function __construct()
    {
        $this->middleware('permission:view users')->only('index');
        $this->middleware('permission:edit users')->only('edit', 'update');
        $this->middleware('permission:create users')->only('create', 'store');
        $this->middleware('permission:delete users')->only('delete');
    }

    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest()->paginate(5);
        return view('users.list', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validator = Validator::make($request->all(), [
           'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        if ($validator->passes()) {

            
            User::create([

                "name"=>$request->name ,    
                "email"=>$request->email, 
                "password"=>$request->password ,     

            ]);
           
            return redirect()->route('users.index')->with('success', 'An user created');
        } else {
            return redirect()->route('users.create')->withInput()->withErrors($validator);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::with('roles')->findOrFail($id); // eager load roles
        $roles = Role::orderBy('name', 'ASC')->get();

        $hasroles = $user->roles->pluck('id'); // this won't be null
        return view('users.edit', compact('user', 'roles', 'hasroles'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $user = User::findorFail($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        if ($validator->fails()) {

            return redirect()->route('users.edit', $id)->withInput()->withErrors($validator);
        }
        $user->name = $request->name;
        $user->email = $request->email;

        $user->save();

        $user->syncRoles($request->role);

        return redirect()->route('users.index')->with('success', 'user updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
          $id=$request->id;

   $user= User::find($id);


   if($user==null){
    session()->flash('error','user not found');
    return response()->json([
                                            //used ajax 
        'status'=>false   
    ]);

   }

   $user->delete();

   session()->flash('success','user deleted');
   return response()->json([
                                        
       'status'=>true  
   ]);

    }
}
