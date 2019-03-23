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
use Hash;
use Session;

class ViewController extends Controller
{
   public function getUsers($id)
   {
   	
   	$rolex = User_roles::find($id);
      $urole = Users::where('role',$id)->with('user_departments')->with('user_roles')->get();
   	$roles = User_roles::all();
   	$deps = Departments::all();
      $users = Users::find(Auth::user()->id);

      if(Auth::user()->user_role()->first()->name == 'Superadmin'){
   	  return view('superadmin.showusers')->with('rolex',$rolex)->with('deps',$deps)->with('roles',$roles)->with('urole' ,$urole)->with('users',$users);
      }
      elseif(Auth::user()->user_role()->firat()->name == 'Admin'){
         return view('admin.showusers')->with('rolex',$rolex)->with('deps',$deps)->with('roles',$roles)->with('urole' ,$urole)->with('users',$users);
      }
   }

    public function getDeps($id)
   {
   	
   	$depsx = Departments::find($id);
   	$roles = User_roles::all();
   	$deps = Departments::all();
      $users = Users::find(Auth::user()->id);

   	return view('superadmin.showdeps')->with('depsx',$depsx)->with('deps',$deps)->with('roles',$roles)->with('users',$users);
   }
}
