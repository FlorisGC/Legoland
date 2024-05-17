@extends('layouts.app')

@section('content')
    <div class="attractions">
        @foreach ($attractions as $attraction)
            <div class="attraction">
                <!-- Clickable container for image and title -->
                <div onclick="openModal('{{ $attraction->title }}')">
                    <img src="{{ htmlspecialchars($attraction->image, ENT_QUOTES, 'UTF-8') }}"
                        alt="{{ htmlspecialchars($attraction->title, ENT_QUOTES, 'UTF-8') }}">
                </div>

                <!-- Description and other content -->
                <div class="attraction-text">
                    <h1 onclick="openModal('{{ $attraction->title }}')">{{ $attraction->title }}</h1>
                    <p>{{ $attraction->description }}</p>
                </div>
            </div>

            <!-- Modal for this attraction -->
            <div class="modal" id="modal_{{ $attraction->title }}" data-title="{{ $attraction->title }}">
                <span class="close" onclick="closeModal(this)">&times;</span>
                <img class="modal-content" src="{{ htmlspecialchars($attraction->image, ENT_QUOTES, 'UTF-8') }}"
                    alt="{{ htmlspecialchars($attraction->title, ENT_QUOTES, 'UTF-8') }}">
                <div class="caption">{{ $attraction->title }}</div>

                <!-- Additional information -->
                <div class="attraction-info-container">
                    <div class="attraction-info">
                        <h2>Additional Information</h2>
                        <p><strong>Description:</strong> {{ $attraction->description_short }}</p>
                        <p><strong>Minimum Age:</strong> {{ $attraction->minimum_age }}</p>
                        <p><strong>Minimum Height:</strong> {{ $attraction->minimum_height }} meters</p>
                        <p><strong>Maximum Weight:</strong> {{ $attraction->maximum_weight }} kg</p>
                        <p><strong>Wait Time:</strong> {{ $attraction->wait_time }} minutes</p>
                        <p><strong>Restrictions:</strong> {{ $attraction->restrictions }}</p>
                        <p><strong>Inauguration Date:</strong> {{ $attraction->inauguration_date }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
