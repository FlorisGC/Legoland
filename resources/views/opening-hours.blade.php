@extends('layouts.app')

@section('content')
<div class="opening-hours">
    <h1>Opening Hours</h1>
    <table>
        <tr>
            <th>Day</th>
            <th>Opening Time</th>
            <th>Closing Time</th>
            @if (Auth::check())
                <th>Edit</th>
            @endif
        </tr>
        @foreach ($openingHours as $openingHour)
            <tr>
                <td>{{ $openingHour->day }}</td>
                <td>{{ substr($openingHour->open, 0, -3) }}</td>
                <td>{{ substr($openingHour->close, 0, -3) }}</td>
                @if (Auth::check())
                    <td>
                        <button onclick="window.location='{{ route('opening-hours.edit', $openingHour->id) }}'"
                            class="edit-button">Edit</button>
                    </td>
                @endif
            </tr>
        @endforeach
</div>
@endsection