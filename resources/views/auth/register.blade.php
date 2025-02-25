@vite(['resources/css/register.css']);

@extends('layout')

@section('page_name')
    Thank you!
@endsection

@section('content')

    <form class="register-form" method="POST" action="{{ route('register') }}">
        @csrf

        <h2>Register</h2>

        <div class="input-group">
            <input type="text" id="name" name="name" placeholder="Full Name" value="{{ old('name') }}" required autofocus>
        </div>

        <div class="input-group">
            <input type="email" id="email" name="email" placeholder="Email Address" value="{{ old('email') }}" required>
        </div>

        <div class="input-group">
            <input type="password" id="password" name="password" placeholder="Password" required>
        </div>

        <div class="input-group">
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required>
        </div>

        <div class="register-actions">
            <a class="login-link" href="{{ route('login') }}">Already registered?</a>
            <button type="submit" class="register-button">Register</button>
        </div>
    </form>


@endsection
