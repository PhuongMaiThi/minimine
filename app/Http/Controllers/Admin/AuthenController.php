<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Role;

class AuthenController extends Controller
{
    public function register_auth(){
        return view('admin.custom_auth.register');
    }
}
