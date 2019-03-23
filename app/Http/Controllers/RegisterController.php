<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Notifications\Notifiable;
use App\Notifications\MyNotifications;
use Auth;
use DB;
use App\Users;
use App\User_roles;
use App\Departments;
use App\Transfer_Requests;
use Notification;
use Hash;
use Session;

class RegisterController extends Controller 
{
    public function registernow(request $request)
    {
        $id = rand();

    	$user = new Users([
            'user_id' => $id,
    		'fname' => $request->input('fname'),
    		'lname' => $request->input('lname'),
    		'username' => $request->input('username'),
    		'password' => Hash::make($request->input('password')),
    		'contact' => $request->input('contact'),
    		'email' => $request->input('email'),
    		'role' => $request->input('roleid'),
    		'department' => $request->input('department')
    	]);


        $user->save();

        $users = Users::where('user_id',$id)->with('user_departments')->with('user_roles')->get();

        foreach($users as $usz)
        {
            
        }

        $allusers = Users::all();

        Notification::send($allusers, new MyNotifications($usz));

    	Session::flash('alert-class', 'success'); 
		flash('User Created', '')->overlay();

        $roles = User_roles::all();
        $deps = Departments::all();
        $rolex = User_roles::find($request->input('roleid'));
        $urole = Users::where('role',$request->input('roleid'))->with('user_departments')->with('user_roles')->get();
        $users = Users::find(Auth::user()->id);
        $transfer = Transfer_Requests::all();

        if(Auth::user()->user_role()->first()->name == 'Superadmin'){
            return view('superadmin.showusers')->with('roles',$roles)->with('deps',$deps)->with('rolex',$rolex)->with('urole' ,$urole)->with('users',$users)->with('transfer',$transfer);
        }
        else if (Auth::user()->user_role()->first()->name == 'Admin'){
            return view('admin.showusers')->with('roles',$roles)->with('deps',$deps)->with('rolex',$rolex)->with('urole' ,$urole)->with('users',$users)->with('transfer',$transfer);
        }
    }

    public function register_role(request $request)
    {
        

        $role = new User_roles([
            'name' => $request->input('rname'),
            'description' => $request->input('rdesc')
        ]);

        $role->save();

        Session::flash('alert-class', 'success'); 
		flash('Role Created', '')->overlay();

		$roles = User_roles::all();
        $deps = Departments::all();
        $users = Users::find(Auth::user()->id);
        $transfer = Transfer_Requests::all();

        if(Auth::user()->user_role()->first()->name == 'Superadmin'){
            return view('superadmin.chooseuser')->with('roles',$roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer);
        }
        else if(Auth::user()->user_role()->first()->name == 'Admin'){
            return view('admin.chooseuser')->with('roles',$roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer);
        }
    }

    public function register_dep(request $request)
    {


        $role = new Departments([
            'department_name' => $request->input('depname'),
            'description' => $request->input('depdesc')
        ]);

        $role->save();

        Session::flash('alert-class', 'success'); 
		flash('Department Created', '')->overlay();

		$roles = User_roles::all();
        $deps = Departments::all();
        $users = Users::find(Auth::user()->id);
        $transfer = Transfer_Requests::all();

      if(Auth::user()->user_role()->first()->name == 'Superadmin'){
        return view('superadmin.postcreatedep')->with('roles',$roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer);
      }
      elseif(Auth::user()->user_role()->first()->name == 'Admin'){
        return view('admin.postcreatedep')->with('roles',$roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer);
      }
    }

}
