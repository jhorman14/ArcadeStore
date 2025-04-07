<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');
    $query = User::query(); // Start with a base query

    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('role', 'like', '%' . $search . '%')
                ->orWhere('is_active', 'like', '%' . $search . '%');
        });
    }

    $users = $query->paginate(10);
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
