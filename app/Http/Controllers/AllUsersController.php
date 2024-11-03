<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AllUsersController extends Controller
{
    //
    public function list(){

        $users = User::all();
        
        return view("all-users.list", ["users"=> $users]);
    }
}
