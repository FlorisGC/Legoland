@extends('layouts.app')

@section('content')
<div class="welcome">
    <div class="content-text-container">
        <h1>Welcome to LegoLand Doetinchem</h1>
        <p>LegoLand Doetinchem is a theme park dedicated to the world of Lego. It offers a wide range of
            attractions,
            rides,
            and shows for visitors of all ages. Whether you are a Lego enthusiast or just looking for a fun day out
            with
            your family, LegoLand Doetinchem has something for everyone.</p>
    </div>
    <img src="{{ asset('assets/lego-building-blocks-bricks.webp') }}" alt="LegoLand Parks Pic">
</div>
@endsection