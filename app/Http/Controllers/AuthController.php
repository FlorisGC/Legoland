<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        // show login form
        return view('login');
    }

    public function login(Request $request)
    {
        // validate the form data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');

        // attempt to log the user in
        if (Auth::attempt($credentials)) {
            // Login success
            return redirect()->intended('/dashboard');
        }

        // login failed
        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function showRegistrationForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $messages = [
            'password.min' => 'Password must be at least 8 chars long',
            'password.confirmed' => 'Password confirmation does not match',
        ];

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ], $messages);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $request->session()->flash('success', 'User created');

        return redirect('/dashboard');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if (Auth::check()) {
            $user->delete();
            return redirect('/dashboard');
        } else {
            return response()->json(['success' => false, 'message' => 'You must be logged in to delete users.'], 403);
        }

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);

        $user = User::findOrFail($id);

        if (Auth::check()) {
            $user->update($request->all());
            $request->session()->flash('status', 'User updated successfully');
            return redirect('/dashboard');
        } else {
            return response()->json(['success' => false, 'message' => 'You must be logged in to update users.'], 403);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
