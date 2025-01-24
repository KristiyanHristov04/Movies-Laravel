<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $usersPerPage = 5;
        $users = User::orderby('id', 'desc')->paginate($usersPerPage);

        return view('admin.users', [
            'users' => $users,
            'counter' => 0
        ]);
    }

    public function promote($id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('admin.users.index')->with('error', 'Не съществува такъв ресурс!');
        }

        $user->is_admin = true;
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Потребителят беше успешно направен администратор!');
    }

    public function demote($id) {
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('admin.users.index')->with('error', 'Не съществува такъв ресурс!');
        }

        $user->is_admin = false;
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Потребителят беше успешно направен потребител!');
    }
}
