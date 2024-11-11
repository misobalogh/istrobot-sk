<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\Password;

class AllUsersController extends Controller
{
    //
    public function list()
    {
        $countries = Country::all();
        $users = User::all();

        return view("all-users.list", [
            "users" => $users,
            "countries" => $countries
        ]);
    }

    public function edit(User $user)
    {
        return response()->json($user);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'email' => 'nullable|email|unique:users,email,' . $user->id,
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'password' => ['nullable', Password::defaults()],
            'birth_date' => 'nullable|date',
            'city' => 'nullable|string|max:255',
            'country_code' => 'nullable|exists:countries,country_code',
            'school' => 'nullable|string|max:255',
        ]);

        if ($request->filled('email')) {
            $user->email = $request->input('email');
        }

        if ($request->filled('first_name')) {
            $user->first_name = $request->input('first_name');
        }

        if ($request->filled('last_name')) {
            $user->last_name = $request->input('last_name');
        }

        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        if ($request->filled('birth_date')) {
            $user->birth_date = $request->input('birth_date');
        }

        if ($request->filled('city')) {
            $user->city = $request->input('city');
        }

        if ($request->filled('country_code')) {
            $user->country_code = $request->input('country_code');
        }

        if ($request->filled('school')) {
            $user->school = $request->input('school');
        }

        $user->save();

        return response()->json(['success' => true]);
    }

    public function destroy(User $user)
    {
        if ($user->isAdmin()) {
            return response()->json(['success' => false]);
        }

        $user->delete();

        return response()->json(['success' => true]);
    }
}
