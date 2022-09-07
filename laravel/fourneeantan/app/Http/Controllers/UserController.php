<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
    //    $users = User::orderBy('name', 'ASC')->get();
        $users = User::client()->latest()->get();
        
        return view ('auth.admin.users.index',[
            'users' => $users
    ]);
    }
}
