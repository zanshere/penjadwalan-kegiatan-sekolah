// Show success message from URL parameter
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const success = urlParams.get('success');
    
    if (success) {
        // Create a temporary alert
        const alertDiv = document.createElement('div');
        alertDiv.className = 'alert alert-success fixed top-4 right-4 w-auto z-50 shadow-lg';
        alertDiv.innerHTML = `
            <div class="flex-1">
                <i class="bi bi-check-circle-fill"></i>
                <label>${decodeURIComponent(success)}</label>
            </div>
        `;
        document.body.appendChild(alertDiv);
        
        // Remove after 3 seconds
        setTimeout(() => {
            alertDiv.remove();
        }, 3000);
    }
});