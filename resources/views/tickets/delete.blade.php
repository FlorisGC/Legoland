@extends('layouts.app')

@section('content')
    <div class="delete-ticket">
        <h1>Delete Ticket</h1>
        <p>Are you sure you want to delete this ticket?</p>
        <form method="POST" action="{{ route('ticket-prices.destroy', $ticket->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit">Confirm Delete</button>
        </form>
    </div>
@endsection
