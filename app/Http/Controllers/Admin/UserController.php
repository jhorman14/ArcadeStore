<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function changeRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:user,admin',
        ]);

        $user->update(['role' => $request->role]);

        return redirect()->route('admin.users.index')
            ->with('success', 'Rol del usuario actualizado exitosamente.');
    }
    public function activate(User $user)
    {
        $user->update(['is_active' => true]);
        return redirect()->route('admin.users.index')
            ->with('success', 'Usuario activado exitosamente.');
    }

}
