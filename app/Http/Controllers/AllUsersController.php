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
        $validatedData = $request->validate([
            'email' => 'nullable|email|unique:users,email,' . $user->id,
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'password' => ['nullable', Password::defaults()],
            'birth_date' => 'nullable|date',
            'city' => 'nullable|string|max:255',
            'country_code' => 'nullable|exists:countries,country_code',
            'school' => 'nullable|string|max:255',
        ]);

        $user->fill($validatedData);
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
