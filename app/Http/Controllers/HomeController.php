<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        return view('users.profile', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('users.editProfile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // Valider les données du formulaire de mise à jour du profil
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'birthday' => ['required', 'date'],
            'about_me' => ['nullable', 'string'],

        ]);

        // Mettre à jour les champs du profil de l'utilisateur
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->birthday = $validatedData['birthday'];
        $user->about_me = $validatedData['about_me']; // Mettre à jour le champ "about_me" si présent

        $user->save();

        return redirect()
            ->route('profile.index')
            ->with('status', 'Profile updated successfully.');
    }
}
