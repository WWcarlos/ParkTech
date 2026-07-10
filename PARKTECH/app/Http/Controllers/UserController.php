<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password; // Se encripta automáticamente gracias al cast 'hashed'
        $user->role = $request->role;
        $user->is_active = $request->has('is_active');
        $user->save();
        return redirect()->route('users.index');
    }

    public function edit(string $id)
    {
        $user = User::find($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = $request->password;
        }
        $user->role = $request->role;
        $user->is_active = $request->is_active;
        $user->save();
        return redirect()->route('users.index');
    }

    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('users.index');
    }
}