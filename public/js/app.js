// import './bootstrap';

// app.js

// Function to open modal
function openModal(title) {
    // Ensure title is not undefined
    if (typeof title === 'undefined') {
        console.error('Title parameter is undefined');
        return;
    }

    // Get the modal element based on the title
    var modal = document.getElementById("modal_" + title);

    // Check if the modal element exists
    if (!modal) {
        console.error('Modal element not found with title: ' + title);
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

document.addEventListener('DOMContentLoaded', function () {
    // Tickets system code
    var showNewTicketButton = document.getElementById('show-new-ticket');
    if (showNewTicketButton) {
        showNewTicketButton.addEventListener('click', function () {
            document.getElementById('new-ticket').style.display = 'block';
        });
    }

    var addTicketButton = document.getElementById('add-ticket-button');
    if (addTicketButton) {
        addTicketButton.addEventListener('click', function () {
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
                    window.location.reload();
                }).catch(error => {
                    console.error('There was a problem with your fetch operation:', error);
                });
            }
        });
    }

    function attachTicketEventListeners() {
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

    attachTicketEventListeners(); // Attach event listeners on initial load

    // Accommodations system code
    var showNewAccommodationButton = document.getElementById('show-new-accommodation');
    if (showNewAccommodationButton) {
        showNewAccommodationButton.addEventListener('click', function () {
            document.getElementById('new-accommodation').style.display = 'block';
        });
    }

    var addAccommodationButton = document.getElementById('add-accommodation-button');
    if (addAccommodationButton) {
        addAccommodationButton.addEventListener('click', function () {
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
    }

    function attachAccommodationEventListeners() {
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

    attachAccommodationEventListeners(); // Attach event listeners on initial load
});
