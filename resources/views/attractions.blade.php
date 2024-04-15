@extends('layouts.app')

@section('content')
<div class="attractions">
    @foreach ($attractions as $attraction)
        <div class="attraction">
            <img src="{{ $attraction->image }}" alt="{{ $attraction->title }}">
            <div class="attraction-text">
            <h1>{{ $attraction->title }}</h1>
            <p>{{ $attraction->description }}</p>
            </div>
        </div>
    @endforeach
</div>
@endsection