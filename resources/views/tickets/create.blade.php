@extends('layouts.app')

@section('content')
    <div class="add-ticket">
        <h1>Add New Ticket</h1>
        <form method="POST" action="{{ route('ticket-prices.store') }}">
            @csrf
            <div class="form-group">
                <label for="type">Type:</label>
                <input type="text" id="type" name="type" required>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" required>
            </div>
            <button type="submit">Add</button>
        </form>
    </div>
@endsection
