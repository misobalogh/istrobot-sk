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

    public function edit(Robot $robot)
    {
        return response()->json($robot);
    }

    public function update(Request $request, Robot $robot)
    {
        $validatedData = $request->validate([
            'name' => 'nullable|string|max:255',
            'author_first_name' => 'nullable|string|max:255',
            'author_last_name' => 'nullable|string|max:255',
        ]);

        $robot->fill($validatedData);
        $robot->save();

        return response()->json(['success' => true]);
    }

    public function destroy(Robot $robot)
    {
        $robot->delete();
        return response()->json(['success' => true]);
    }
}
