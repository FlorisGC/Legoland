@extends('layouts.app')

@section('content')
<div class="accommodations">
    @if (session('message'))
    <div class="alert">
        <h3>{{ session('message') }}</h3>
    </div>
    @endif
    @foreach($accommodations as $accommodation)
    <div class="accommodation-item" data-id="{{ $accommodation->id }}">
        <img src="{{ $accommodation->image }}" alt="{{ $accommodation->type }}">
        <h2>{{ $accommodation->type }}</h2>
        <p>Price per night: €{{ $accommodation->price_per_night }}</p>
        @if ($isAuthenticated)
        <button class="edit-accommodation-button btn btn-secondary attraction-admin-button">Edit</button>
        <button class="delete-accommodation-button btn btn-secondary attraction-admin-button">Delete</button>
        @endif
        <form action="{{ route('placeAccommodationOrder') }}" method="POST">
            @csrf
            <input type="hidden" name="accommodation_id" value="{{ $accommodation->id }}">
            <input type="email" name="email" placeholder="Your email" required>
            <input type="number" name="number_of_nights" min="1" placeholder="Number of nights" required>
            <button type="submit">Order</button>
        </form>
    </div>
    @endforeach
    @if ($isAuthenticated)
    <div id="new-accommodation" style="display: none;">
        <h3>Add New Accommodation</h3>
        <input type="text" id="new-accommodation-type" placeholder="Type">
        <input type="number" id="new-accommodation-price" placeholder="Price per night">
        <input type="text" id="new-accommodation-image" placeholder="Image URL">
        <button id="add-accommodation-button">Add</button>
    </div>
    <button id="show-new-accommodation" class="btn btn-primary attraction-admin-button">Add New Accommodation</button>
    @endif
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    @if ($isAuthenticated)
    // Show/hide new accommodation form
    document.getElementById('show-new-accommodation').addEventListener('click', function () {
        document.getElementById('new-accommodation').style.display = 'block';
    });

    // Add new accommodation
    document.getElementById('add-accommodation-button').addEventListener('click', function () {
        var type = document.getElementById('new-accommodation-type').value;
        var price = document.getElementById('new-accommodation-price').value;
        var image = document.getElementById('new-accommodation-image').value;
        if (type && price && image) {
            fetch("/accommodations", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    type: type,
                    price_per_night: price,
                    image: image
                })
            }).then(response => {
                if (response.ok) {
                    return response.json();
                }
                throw new Error('Network response was not ok.');
            }).then(data => {
                window.location.reload();
            }).catch(error => {
                console.error('There was a problem with your fetch operation:', error);
            });
        }
    });

    function attachAccommodationEventListeners() {
        // Edit accommodation
        document.querySelectorAll('.edit-accommodation-button').forEach(function (button) {
            button.addEventListener('click', function () {
                var accommodation = button.closest('.accommodation-item');
                var id = accommodation.getAttribute('data-id');
                var type = accommodation.querySelector('h2').textContent;
                var price = accommodation.querySelector('p').textContent.replace('Price per night: €', '');
                var image = accommodation.querySelector('img').src;
                var newType = prompt('Edit Type:', type);
                var newPrice = prompt('Edit Price per night:', price);
                var newImage = prompt('Edit Image URL:', image);
                if (newType && newPrice && newImage) {
                    fetch(`/accommodations/${id}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            type: newType,
                            price_per_night: newPrice,
                            image: newImage
                        })
                    }).then(response => {
                        if (response.ok) {
                            return response.json();
                        }
                        throw new Error('Network response was not ok.');
                    }).then(data => {
                        if (data.success) {
                            window.location.reload();
                        } else {
                            alert(data.message);
                        }
                    }).catch(error => {
                        console.error('There was a problem with your fetch operation:', error);
                    });
                }
            });
        });

        // Delete accommodation
        document.querySelectorAll('.delete-accommodation-button').forEach(function (button) {
            button.addEventListener('click', function () {
                if (confirm('Are you sure you want to delete this accommodation?')) {
                    var accommodation = button.closest('.accommodation-item');
                    var id = accommodation.getAttribute('data-id');
                    fetch(`/accommodations/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    }).then(response => {
                        if (response.ok) {
                            window.location.reload();
                        } else {
                            throw new Error('Network response was not ok.');
                        }
                    }).catch(error => {
                        console.error('There was a problem with your fetch operation:', error);
                    });
                }
            });
        });
    }

    attachAccommodationEventListeners();
    @endif
});
</script>
@endpush
