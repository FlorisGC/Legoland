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
