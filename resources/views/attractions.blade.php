@extends('layouts.app')

@section('content')
<div class="attractions">
    @if (Auth::check())
        <a href="{{ route('attractions.create') }}" class="btn btn-primary attraction-admin-button">Add Attraction</a>
    @endif
    @foreach ($attractions as $attraction)
        <div class="attraction">
            <!-- Clickable container for image and title -->
            <div onclick="openModal('{{ $attraction->id }}')">
                <img src="{{ htmlspecialchars($attraction->image, ENT_QUOTES, 'UTF-8') }}"
                    alt="{{ htmlspecialchars($attraction->title, ENT_QUOTES, 'UTF-8') }}">
            </div>

            <!-- Description and other content -->
            <div class="attraction-text">
                <h1 onclick="openModal('{{ $attraction->id }}')">{{ $attraction->title }}</h1>
                <p>{{ $attraction->description }}</p>

                @if (Auth::check())
                    <br>
                    <a href="{{ route('attractions.edit', $attraction->id) }}" class="btn btn-secondary attraction-admin-button">Edit</a>
                    <br> <br>
                    <h3>
                        <form action="{{ route('attractions.destroy', $attraction->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger attraction-admin-button"
                                onclick="return confirm('Are you sure you want to delete this attraction?')">Delete</button>
                        </form>
                    </h3>
                @endif

            </div>
        </div>

        <!-- Modal for this attraction -->
        <div class="modal" id="modal_{{ $attraction->id }}" data-id="{{ $attraction->id }}">
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

@section('scripts')
<script>
// Function to open modal
function openModal(id) {
    // Ensure id is not undefined
    if (typeof id === 'undefined') {
        console.error('ID parameter is undefined');
        return;
    }

    // Get the modal element based on the id
    var modal = document.getElementById("modal_" + id);

    // Check if the modal element exists
    if (!modal) {
        console.error('Modal element not found with id: ' + id);
        return;
    }

    // Display the modal
    modal.style.display = "block";
}

// Function to close modal
function closeModal(element) {
    var modal = element.closest('.modal');
    if (modal) {
        modal.style.display = "none";
    }
}

// Close modal when clicking outside of the modal content
window.onclick = function(event) {
    var modals = document.getElementsByClassName('modal');
    for (var i = 0; i < modals.length; i++) {
        var modal = modals[i];
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
}
</script>
@endsection
