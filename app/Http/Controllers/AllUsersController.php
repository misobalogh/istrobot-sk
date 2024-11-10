<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\Password;

class AllUsersController extends Controller
{
    //
    public function list()
    {

        $users = User::all();

        return view("all-users.list", ["users" => $users]);
    }

    public function update(Request $request, User $user)
    {
        Log::info("Updating user email: " . $request);

        $request->validate([
            'email' => 'nullable|email|unique:users,email,' . $user->id,
            'password' => ['nullable', Password::defaults()]
        ]);

        if ($request->filled(key: 'email')) {
            $user->email = $request->input('email');
        }

        if ($request->filled(key: 'password')) {
            $user->password = $request->input('password');
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
