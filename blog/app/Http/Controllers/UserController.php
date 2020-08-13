<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;


class UserController extends Controller
{


	public function __construct()
    {
        $this->middleware('auth');
    }
    public function show()
    {
    	$users = User::paginate(5);
    return view('admin/show',compact('users'));


    }


    

}
