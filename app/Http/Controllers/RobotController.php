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
            'technologies'=> $technologies
        ]);
    }

    /**
     * Update the user's robot information.
     */
    public function update(RobotUpdateRequest $request, $id): RedirectResponse
    {
        $robot = Robot::findOrFail($id);
        Log::info("Robot {$robot}");
        $robot->fill($request->validated());
        $robot->save();

        return Redirect::route('robots.edit')->with('status', 'robot-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
