<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', User::class);
        $users = User::orderBy('name')->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);
        $rolesConfig = config('admin.roles', []);
        $roles = collect($rolesConfig)->mapWithKeys(fn ($r, $key) => [$key => $r['label'] ?? $key])->all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);
        $roleKeys = array_keys(config('admin.roles', []));
        $request->validate([
            'role' => 'required|in:'.implode(',', $roleKeys),
            'name' => 'required|string|max:255',
        ]);
        $user->update($request->only('role', 'name'));
        return redirect()->route('admin.users.index')->with('success', 'Kullanıcı güncellendi.');
    }
}
