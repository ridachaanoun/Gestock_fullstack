<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function index()
    {
        if (! Gate::allows('viewAny', User::class)) {
            abort(403);
        }
        return User::all();
    }

    public function store(Request $request)
    {
        if (! Gate::allows('create', User::class)) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string|in:admin,user',
        ]);

        $validated['password'] = bcrypt($validated['password']);

        return User::create($validated);
    }

    public function show(User $user)
    {
        if (! Gate::allows('view', $user)) {
            abort(403);
        }
        return $user;
    }

    public function update(Request $request, User $user)
    {
        if (! Gate::allows('update', $user)) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'role' => 'sometimes|string|in:admin,user',
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        }

        $user->update($validated);
        return $user;
    }

    public function destroy(User $user)
    {
        if (! Gate::allows('delete', $user)) {
            abort(403);
        }
        $user->delete();
        return response()->noContent();
    }
}
