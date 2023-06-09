<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class UserController extends Controller
{
    public function profile($name)
    {
        $user = User::where('name', '=', $name)->firstOrFail();
        return view('users.profile', compact('user'));
    }

    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }
    public function promote($id)
    {
        $user = User::findOrFail($id);
        $user->is_admin = true;
        $user->save();

        return redirect()->back()->with('status', 'User promoted to admin');
    }

    public function depromote($id)
    {
        $user = User::findOrFail($id);
        $user->is_admin = false;
        $user->save();

        return redirect()->back()->with('status', 'User demoted from admin');
    }
}
