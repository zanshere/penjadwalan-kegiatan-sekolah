function openModal(modalId) {
    document.getElementById(modalId).classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
}

// Close modal when clicking outside of it
window.onclick = function(event) {
    if (event.target.classList.contains('fixed') && event.target.classList.contains('inset-0')) {
        const modals = document.querySelectorAll('.fixed.inset-0.z-50');
        modals.forEach(modal => {
            if (!modal.classList.contains('hidden')) {
                modal.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }
        });
    }
}