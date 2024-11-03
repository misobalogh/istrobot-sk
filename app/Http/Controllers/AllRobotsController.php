<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Robot;

class AllRobotsController extends Controller
{
    //
    public function list(){

        $robots = Robot::all();

        return view("all-robots.list", ["robots"=> $robots]);
    }
}
