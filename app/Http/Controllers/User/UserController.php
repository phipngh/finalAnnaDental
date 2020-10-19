<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //Front Side
    public function index(){
        return view('User.index');
    }

    public function aboutus(){
        return view('User.about');
    }

    public function contactus(){
        return view('User.contact');
    }

    public function blog(){
        return view('User.blog');
    }
}
