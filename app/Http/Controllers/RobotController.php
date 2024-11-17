<?php

namespace App\Http\Controllers;

use App\Http\Requests\RobotUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Robot;
use App\Models\Technology;

class RobotController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $robots = $request->user()->robots;
        $technologies = Technology::all();

        return view('robots.edit', [
            'robots' => $robots,
            'technologies' => Technology::all(),
        ]);
    }

    /**
     * Update the user's robot information.
     */
    public function update(RobotUpdateRequest $request, $id): RedirectResponse
    {
        $robot = Robot::findOrFail($id);
        $robot->fill($request->validated());
        $robot->save();

        return Redirect::route('robots.edit')->with('status', 'robot-updated');
    }

    /**
     * Store a newly created robot.
     */
    public function store(RobotUpdateRequest $request): RedirectResponse
    {
        $robot = new Robot($request->validated());
        $robot->user_id = $request->user()->id;
        $robot->save();

        return Redirect::route('robots.edit')->with('status', 'robot-created');
    }

    /**
     * Delete the robot account.
     * 
     * TODO: This method is not finished - customer did not decided yet how should it work.
     */
    public function destroy(Request $request , $id): RedirectResponse
    {
        return Redirect::to('/');
    }
}
