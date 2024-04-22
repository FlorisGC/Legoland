@extends('layouts.app')

@section('content')
<div class="accommodations">
@if (session('message'))
    <div class="alert">
        <h3>{{ session('message') }}</h3>
        @if(session('order'))
        <p>{{ session('order')['accommodation_type'] }} for {{ session('order')['number_of_nights'] }} night(s)</p>
        @endif
    </div>
@endif
@foreach($accommodations as $accommodation)
    <div class="accommodation-item">
        <img src="{{ $accommodation->image }}" alt="{{ $accommodation->name }}">
        <h2>{{ $accommodation->type }}</h2>
        <p>Price per night: €{{ $accommodation->price_per_night }}</p>

        <form action="{{ route('placeAccommodationOrder') }}" method="POST">
            @csrf
            <input type="hidden" name="accommodation_id" value="{{ $accommodation->id }}">
            <input type="email" name="email" placeholder="Your email" required>
            <input type="number" name="number_of_nights" min="1" placeholder="Number of nights" required>
            <button type="submit">Order</button>
        </form>
    </div>
@endforeach
</div>
@endsection