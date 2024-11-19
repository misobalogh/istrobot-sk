<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class AllUsersController extends Controller
{
    //
    public function list(Request $request)
    {
        $countries = Country::all();
        $sort = $request->input('sort', 'last_name');
        $direction = $request->input('direction', 'asc');

        $users = User::orderBy($sort, $direction)->get();

        return view("all-users.list", [
            "users" => $users,
            "countries" => $countries,
            "sort" => $sort,
            "direction" => $direction
        ]);
    }

    public function edit(User $user)
    {
        return response()->json($user);
    }

    public function updatePasswordOrEmail(User $user, Request $request)
    {
        $validatedData = $request->validate([
            'email' => ['string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'password' => ['nullable', Password::defaults()],
        ]);

        // Remove password from validated data if its null
        if (array_key_exists('password', $validatedData) && is_null($validatedData['password'])) {
            unset($validatedData['password']);
        }

        $user->fill($validatedData);
        $user->save();

        return response()->json(['success' => true]);
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'email' => ['string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'first_name' => 'string|max:50',
            'last_name' => 'string|max:50',
            'birth_date' => 'date|before:today|after:1900-01-01|date_format:Y-m-d',
            'city' => 'string|max:255',
            'country_code' => 'exists:countries,country_code',
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
