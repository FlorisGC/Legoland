@extends('layouts.app')

@section('content')
<div class="edit-opening-hours">
    <h1>Edit Opening Hour</h1>
    <form method="POST" action="{{ route('opening-hours.update', $openingHour->id) }}">
        @csrf
        <div class="form-group">
            <label for="day">Day</label>
            <input type="text" name="day" value="{{ $openingHour->day }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="open">Opening Time</label>
            <input type="time" name="open" value="{{ $openingHour->open }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="close">Closing Time</label>
            <input type="time" name="close" value="{{ $openingHour->close }}" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>
@endsection