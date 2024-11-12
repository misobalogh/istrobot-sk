<?php

namespace App\Http\Controllers;

use App\Models\Technology;
use Illuminate\Http\Request;
use App\Models\Robot;

class AllRobotsController extends Controller
{
    //
    public function list()
    {

        $robots = Robot::all();

        return view("all-robots.list", [
            "robots" => $robots,
            "technologies" => Technology::all(),
            
        ]);
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
            'coauthors' => 'nullable|string|max:255',
            'processor' => 'nullable|string|max:255',
            'memory_size' => 'nullable|string|max:255',
            'frequency' => 'nullable|string|max:255', // corrected from 'frequnecy'
            'sensors' => 'nullable|string|max:255',   // corrected from 'snesors'
            'drive' => 'nullable|string|max:255',
            'power_supply' => 'nullable|string|max:255',
            'programming_language' => 'nullable|string|max:255',
            'interesting_facts' => 'nullable|string|max:255',
            'website' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'technology_id' => 'nullable|integer|exists:technologies,id',
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
