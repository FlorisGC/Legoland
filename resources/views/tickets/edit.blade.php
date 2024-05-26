@extends('layouts.app')

@section('content')
    <div class="edit-ticket">
        <h1>Edit Ticket</h1>
        <form method="POST" action="{{ route('ticket-prices.update', $ticket->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="type">Type:</label>
                <input type="text" id="type" name="type" value="{{ $ticket->type }}" required>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" value="{{ $ticket->price }}" required>
            </div>
            <button type="submit">Update</button>
        </form>
    </div>
@endsection
