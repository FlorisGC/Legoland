@extends('layouts.app')

@section('content')
<div class="dashboard-page">
    <div class="welcome">
        <h1>Welcome, {{ Auth::user()->name }}</h1>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>

    <div class="register-user">
        <h3>Register a new user</h3>
        <form method="POST" action="{{ route('dashboard.register') }}">
            @csrf

            <div>
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus>
            </div>

            <div>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required>
            </div>

            <div>
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
            </div>

            <div>
                <label for="password_confirmation">Confirm Password:</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required>
            </div>

            <button type="submit">Register</button>
        </form>
    </div>
</div>
@endsection