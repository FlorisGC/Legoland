// import './bootstrap';

// app.js

// Function to open modal
function openModal(element) {
    var title = element.alt;
    var modal = document.querySelector('[data-title="' + title + '"]');
    
    if (modal) {
        modal.style.display = "block";
    } else {
        console.error("Modal element not found with title:", title);
    }
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
