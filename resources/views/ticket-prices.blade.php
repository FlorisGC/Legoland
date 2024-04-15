@extends('layouts.app')

@section('content')
<div class="tickets">
<div class="ticket-prices">
    <h1>Ticket Prices</h1>
    @foreach ($tickets as $ticket)
        <div>
            <h3>{{ $ticket->type }}</h3>
            <p>Price: €{{ $ticket->price }}</p>
        </div>
    @endforeach
</div>
<div class="order">
    <h1>Order</h1>
    <form method="POST" action="{{ route('placeOrder') }}">
    @csrf
    <div class="email-order-container">
    <label>Email:</label>
    <input type="email" name="email" required>
    </div>
    @foreach ($tickets as $ticket)
    <div class="ticket-order-container">
    <label>{{ $ticket->type }}:</label>
    <input type="number" name="tickets[{{ $ticket->type }}]" min="0" required>
    </div>
    @endforeach
    <button type="submit">Order</button>
    </form>
    @if (session('message'))
    <div class="alert">
        {{ session('message') }}
    </div>
    @endif
</div>
</div>
@endsection