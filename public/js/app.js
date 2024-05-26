document.addEventListener('DOMContentLoaded', function () {
    // Show/hide new ticket form
    document.getElementById('show-new-ticket').addEventListener('click', function () {
        document.getElementById('new-ticket').style.display = 'block';
    });

    // Add new ticket
    document.getElementById('add-button').addEventListener('click', function () {
        var type = document.getElementById('new-type').value;
        var price = document.getElementById('new-price').value;
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
                // Refresh the page to update the ticket list
                window.location.reload();
            }).catch(error => {
                console.error('There was a problem with your fetch operation:', error);
            });
        }
    });

    function attachEventListeners() {
        // Edit ticket
        document.querySelectorAll('.edit-button').forEach(function (button) {
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
                            // Refresh the page to update the ticket list
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

        // Delete ticket
        document.querySelectorAll('.delete-button').forEach(function (button) {
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
                            // Refresh the page to update the ticket list
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

    attachEventListeners(); // Attach event listeners on initial load
});