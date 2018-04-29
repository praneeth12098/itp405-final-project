<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;

class SignupController extends Controller
{
    public function index()  {
    	return view ('signup');
    }

    public function signup() {
    	$user = new User();
    	$user->name = request('name');
    	$user->email = request('email');
    	$user->password = Hash::make(request('password')); // bcrypt hashing
    	$user->save();

    	return redirect('/login');
    }
}
