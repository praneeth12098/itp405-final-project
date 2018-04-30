@extends('main-layout')

@section('title', 'Login')

@section('content')
<h1 style="text-align: center">Login with Spotify</h1>
<!-- <form method="post">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" class="form-control">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" class="form-control">
    </div>
    <input type="submit" value="Login" class="btn btn-primary">
</form> -->
<div>
    <!-- <a href="/login/spotify">
        Login with Spotify
    </a> -->
    <form action="/login/spotify" style="text-align: center">
        <input type="image" src="https://cdn4.iconfinder.com/data/icons/various-icons-2/128/Spotify.png" alt="Submit">
    </form>
</div>
@endsection