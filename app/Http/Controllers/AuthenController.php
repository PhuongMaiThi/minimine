<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Role;

class AuthenController extends Controller
{
    public function register_auth(){
        return view('admin.custom_auth.register');
    }
}
