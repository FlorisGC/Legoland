@extends('layouts.app')

@section('content')
<div class="contact">
    <h1>Contact</h1>
    <p>Address: Catarinalaan 20</p>
    <p>Phone: 0612345678</p>

    <form action="/contact" method="post">
        @csrf
        <h2>Send us a message</h2>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <label for="message">Message:</label>
        <input id="message" name="message" required></input>
        <button type="submit">Send</button>
    </form>
</div>
@endsection