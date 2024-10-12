// Get DOM Elements
const modal = document.getElementById('loginModal');
const signInBtn = document.getElementById('signInBtn');
const closeBtn = document.getElementById('closeModal');

// Events
signInBtn.addEventListener('click', openModal);
closeBtn.addEventListener('click', closeModal);
window.addEventListener('click', outsideClick);

// Open Modal
function openModal(e) {
    e.preventDefault(); // Prevent default link behavior
    modal.style.display = 'block';
    document.getElementById('username').focus();
}

// Close Modal
function closeModal() {
    modal.style.display = 'none';
}

// Close Modal If Outside Click
function outsideClick(e) {
    if (e.target == modal) {
        modal.style.display = 'none';
    }
}

// Optional: Handle form submission
const loginForm = document.getElementById('loginForm');

loginForm.addEventListener('submit', function(e) {
    e.preventDefault();
    // Perform login action here
    // For now, we'll just close the modal
    alert('Logged in successfully!');
    modal.style.display = 'none';
});

// Close modal on Escape key press
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && modal.style.display === 'block') {
        closeModal();
    }
});
