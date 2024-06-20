@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Attraction</h1>
    <form action="{{ route('attractions.update', $attraction->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" id="title" value="{{ $attraction->title }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" id="description" required>{{ $attraction->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="image">Image URL</label>
            <input type="url" name="image" class="form-control" id="image" value="{{ $attraction->image }}" required>
        </div>
        <div class="form-group">
            <label for="description_short">Short Description</label>
            <textarea name="description_short" class="form-control" id="description_short" required>{{ $attraction->description_short }}</textarea>
        </div>
        <div class="form-group">
            <label for="minimum_age">Minimum Age</label>
            <input type="number" name="minimum_age" class="form-control" id="minimum_age" value="{{ $attraction->minimum_age }}" required>
        </div>
        <div class="form-group">
            <label for="minimum_height">Minimum Height (meters)</label>
            <input type="number" step="0.01" name="minimum_height" class="form-control" id="minimum_height" value="{{ $attraction->minimum_height }}" required>
        </div>
        <div class="form-group">
            <label for="maximum_weight">Maximum Weight (kg)</label>
            <input type="number" name="maximum_weight" class="form-control" id="maximum_weight" value="{{ $attraction->maximum_weight }}" required>
        </div>
        <div class="form-group">
            <label for="wait_time">Wait Time (minutes)</label>
            <input type="number" name="wait_time" class="form-control" id="wait_time" value="{{ $attraction->wait_time }}" required>
        </div>
        <div class="form-group">
            <label for="restrictions">Restrictions</label>
            <textarea name="restrictions" class="form-control" id="restrictions" required>{{ $attraction->restrictions }}</textarea>
        </div>
        <div class="form-group">
            <label for="inauguration_date">Inauguration Date</label>
            <input type="date" name="inauguration_date" class="form-control" id="inauguration_date" value="{{ $attraction->inauguration_date }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
