<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->latest()->paginate(10);
        $roles = Role::all();
        return view('users.index', compact('users', 'roles'));
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|exists:roles,name'
        ]);

        // Mencegah admin menghapus role admin dirinya sendiri secara tidak sengaja
        if ($user->id === auth()->id() && $request->role !== 'administrator') {
            return redirect()->route('users.index')->with('error', 'Anda tidak dapat mengubah hak akses Administrator Anda sendiri.');
        }

        $user->syncRoles([$request->role]);

        // Sync role_id column
        $role = Role::where('name', $request->role)->first();
        if ($role) {
            $user->update(['role_id' => $role->id]);
        }

        return redirect()->route('users.index')->with('success', 'Hak akses pengguna berhasil diperbarui!');
    }
}
