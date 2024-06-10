@extends('layouts.app')

@section('content')
<div class="tickets">
    <div class="ticket-prices">
        <h1>Ticket Prices</h1>
        @foreach ($tickets as $ticket)
        <div class="ticket" data-id="{{ $ticket->id }}">
            <h3>{{ $ticket->type }}</h3>
            <p class="price">Price: €{{ $ticket->price }}</p>
            @if ($isAuthenticated)
            <button class="edit-ticket-button">Edit</button>
            <button class="delete-ticket-button">Delete</button>
            @endif
        </div>
        @endforeach
        @if ($isAuthenticated)
        <div id="new-ticket" style="display: none;">
            <h3>Add New Ticket</h3>
            <input type="text" id="new-ticket-type" placeholder="Type">
            <input type="number" id="new-ticket-price" placeholder="Price">
            <button id="add-ticket-button">Add</button>
        </div>
        <button id="show-new-ticket">Add New Ticket</button>
        @endif
    </div>
    <div class="order">
        <h1>Order</h1>
        <form method="POST" action="{{ route('placeOrder') }}">
            @csrf
            <div class="email-order-container">
                <label>Email:</label>
                <input type="email" name="email" required>
            </div>
            @foreach ($tickets as $ticket)
            <div class="ticket-order-container">
                <label>{{ $ticket->type }}:</label>
                <input type="number" name="tickets[{{ $ticket->id }}]" min="0" required>
            </div>
            @endforeach
            <button type="submit">Order</button>
        </form>
        @if (session('message'))
        <div class="alert">
            {{ session('message') }}
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    @if ($isAuthenticated)
    // Show/hide new ticket form
    document.getElementById('show-new-ticket').addEventListener('click', function () {
        document.getElementById('new-ticket').style.display = 'block';
    });

    // Add new ticket
    document.getElementById('add-ticket-button').addEventListener('click', function () {
        var type = document.getElementById('new-ticket-type').value;
        var price = document.getElementById('new-ticket-price').value;
        if (type && price) {
            fetch("/ticket-prices", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    type: type,
                    price: price
                })
            }).then(response => {
                if (response.ok) {
                    return response.json();
                }
                throw new Error('Network response was not ok.');
            }).then(data => {
                // Add new ticket to DOM
                var newTicket = document.createElement('div');
                newTicket.className = 'ticket';
                newTicket.setAttribute('data-id', data.id);
                newTicket.innerHTML = `
                    <h3>${data.type}</h3>
                    <p class="price">Price: €${data.price}</p>
                    <button class="edit-ticket-button">Edit</button>
                    <button class="delete-ticket-button">Delete</button>
                `;
                document.querySelector('.ticket-prices').insertBefore(newTicket, document.getElementById('new-ticket'));
                // Clear form inputs
                document.getElementById('new-ticket-type').value = '';
                document.getElementById('new-ticket-price').value = '';
                // Hide new ticket form
                document.getElementById('new-ticket').style.display = 'none';
                // Re-attach event listeners for the new buttons
                attachEventListeners();
            }).catch(error => {
                console.error('There was a problem with your fetch operation:', error);
            });
        }
    });

    function attachEventListeners() {
        // Edit ticket
        document.querySelectorAll('.edit-ticket-button').forEach(function (button) {
            button.addEventListener('click', function () {
                var ticket = button.closest('.ticket');
                var id = ticket.getAttribute('data-id');
                var type = ticket.querySelector('h3').textContent;
                var price = ticket.querySelector('.price').textContent.replace('Price: €', '');
                var newType = prompt('Edit Type:', type);
                var newPrice = prompt('Edit Price:', price);
                if (newType && newPrice) {
                    fetch(`/ticket-prices/${id}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            type: newType,
                            price: newPrice
                        })
                    }).then(response => {
                        if (response.ok) {
                            return response.json();
                        }
                        throw new Error('Network response was not ok.');
                    }).then(data => {
                        if (data.success) {
                            ticket.querySelector('h3').textContent = newType;
                            ticket.querySelector('.price').textContent = `Price: €${newPrice}`;
                        } else {
                            alert(data.message);
                        }
                    }).catch(error => {
                        console.error('There was a problem with your fetch operation:', error);
                    });
                }
            });
        });

        // Delete ticket
        document.querySelectorAll('.delete-ticket-button').forEach(function (button) {
            button.addEventListener('click', function () {
                if (confirm('Are you sure you want to delete this ticket?')) {
                    var ticket = button.closest('.ticket');
                    var id = ticket.getAttribute('data-id');
                    fetch(`/ticket-prices/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    }).then(response => {
                        if (response.ok) {
                            ticket.remove();
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

    attachEventListeners(); // Attach event listeners on initial load
    @endif
});
</script>
@endpush
