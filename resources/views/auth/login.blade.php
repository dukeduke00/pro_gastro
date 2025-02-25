@vite(['resources/css/login.css']);

@extends('layout')

@section('page_name')
    Login
@endsection

@section('content')


    <form class="login-form" method="POST" action="{{ route('login') }}">
        @csrf

        <h2>Login</h2>

        <div class="input-group">
            <input type="email" id="email" name="email" placeholder="Enter email" required>
        </div>

        <div class="input-group">
            <input type="password" id="password" name="password" placeholder="Enter password" required>
        </div>

        <div class="remember-me">
            <input id="remember_me" type="checkbox" name="remember">
            <label for="remember_me">Remember me</label>
        </div>

        <div class="login-actions">
            @if (Route::has('password.request'))
                <a class="forgot-password" href="{{ route('password.request') }}">Forgot your password?</a>
            @endif

            <button type="submit" class="login-button">Log in</button>
        </div>
    </form>


@endsection
