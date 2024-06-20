@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add Attraction</h1>
    <form action="{{ route('attractions.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" id="title" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" id="description" required></textarea>
        </div>
        <div class="form-group">
            <label for="image">Image URL</label>
            <input type="url" name="image" class="form-control" id="image" required>
        </div>
        <div class="form-group">
            <label for="description_short">Short Description</label>
            <textarea name="description_short" class="form-control" id="description_short" required></textarea>
        </div>
        <div class="form-group">
            <label for="minimum_age">Minimum Age</label>
            <input type="number" name="minimum_age" class="form-control" id="minimum_age" required>
        </div>
        <div class="form-group">
            <label for="minimum_height">Minimum Height (meters)</label>
            <input type="number" step="0.01" name="minimum_height" class="form-control" id="minimum_height" required>
        </div>
        <div class="form-group">
            <label for="maximum_weight">Maximum Weight (kg)</label>
            <input type="number" name="maximum_weight" class="form-control" id="maximum_weight" required>
        </div>
        <div class="form-group">
            <label for="wait_time">Wait Time (minutes)</label>
            <input type="number" name="wait_time" class="form-control" id="wait_time" required>
        </div>
        <div class="form-group">
            <label for="restrictions">Restrictions</label>
            <textarea name="restrictions" class="form-control" id="restrictions" required></textarea>
        </div>
        <div class="form-group">
            <label for="inauguration_date">Inauguration Date</label>
            <input type="date" name="inauguration_date" class="form-control" id="inauguration_date" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
