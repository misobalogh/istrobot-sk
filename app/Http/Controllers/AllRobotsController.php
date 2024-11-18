<?php

namespace App\Http\Controllers;

use App\Models\Technology;
use Illuminate\Http\Request;
use App\Models\Robot;

class AllRobotsController extends Controller
{
    //
    public function list(Request $request)
    {
        $sort = $request->input('sort', 'name'); // Sort by name by default
        $direction = $request->input('direction', 'asc');

        $robots = Robot::orderBy($sort, $direction)->get();

        return view("all-robots.list", [
            "robots" => $robots,
            "technologies" => Technology::all(),
            "sort" => $sort,
            "direction" => $direction
        ]);
    }

    public function edit(Robot $robot)
    {
        return response()->json($robot);
    }

    public function update(Request $request, Robot $robot)
    {
        $validatedData = $request->validate([
            'name' => 'string|max:255',
            'author_first_name' => 'string|max:255',
            'author_last_name' => 'string|max:255',
            'coauthors' => 'nullable|string|max:255',
            'processor' => 'string|max:255',
            'memory_size' => 'nullable|string|max:255',
            'frequency' => 'string|max:255',
            'sensors' => 'nullable|string|max:255',
            'drive' => 'nullable|string|max:255',
            'power_supply' => 'nullable|string|max:255',
            'programming_language' => 'string|max:30',
            'interesting_facts' => 'nullable|string|max:255',
            'website' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'technology_id' => 'integer|exists:technologies,id',
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
