<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Auth;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    //

    public function index(){
        return view('auth.login');
    }
    public function logout()
    {
        
        Auth::logout();
        return redirect('/');

    }
    public function postLogin(Request $request){

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $credentials = $request->only(['email', 'password']);

        if (Auth::attempt($credentials)) {
            // Authentication successful
            $user = Auth::user();
            $rolePermissions = $user->role->permissions;
    
            // You can customize the data you want to return to Vue.js
            $responseData = [
                'user' => $user,
                'role' => $user->role,
                'permissions' => $rolePermissions,
              
            ];
    
            // Return a JSON response
            return new JsonResponse($responseData);
            

        }
    
        // Authentication failed
        $errorResponse = [
            'message' => 'Invalid credentials',
            'errors' => ['email' => 'Invalid credentials'],
        ];
    
        return new JsonResponse($errorResponse, 422);
    }

    
    public function user_role(){
        return view ('auth.userrole');

    }

    public function store_role(Request $request){

        $request->validate([
          
            'user_role'       => 'required',
            'selectedPermissions'       => 'required',
          
        ]);

        $role  = new Role;
        $role->name = $request->user_role;
        $role->permission_id = $request->selectedPermissions;
        $role->status = "Active";
        $role->save();
        //$role->permissions()->sync($request->selectedPermissions);
        return response()->json(['status' => 'User Role Successfully Saved!'], 200);




    }
    public function update_role(Request $request,$id){

        $request->validate([
          
            'user_role'       => 'required',
            'selectedPermissions'       => 'required',
          
        ]);

        $role  =  Role::find($id);
        $role->name = $request->user_role;
        $role->permission_id = $request->selectedPermissions;
        $role->save();
        return response()->json(['status' => 'User Role Successfully Saved!'], 200);




    }
    public function get_User(Request $request){
        
		$columns = ['name', 'created','status'];
		$length = $request->input('length');
		$column = $request->input('column');
		$dir = $request->input('dir');
		$searchValue = $request->input('search');
		$data = Role::with('permissions')->orderBy($columns[$column], $dir);

		if($searchValue){
			$data->where(function($data) use ($searchValue) {
				$data->where('name', 'like', '%' . $searchValue . '%');
				
			});

		}
		$data = $data->paginate($length);
		return ['data' => $data, 'draw' => $request->input('draw')];

}

    public function get_permission(){
        
        $permission = Permission::get();
        return response()->json(['message' => $permission]);
    }

    public function getRoleDisplay(Request $request){
        $permissionIds = $request->input('ids');
        $permissions = Permission::whereIn('id', $permissionIds)->get();

        return response()->json(['permissions' => $permissions]);


        }


    

}
