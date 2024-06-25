document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const cancelBtn = document.querySelector('.cancel-btn');

    form.addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(form);

        fetch('backend/update_profile.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                window.location.href = 'profile.html'; // Redirect to profile.html on success
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to update profile. Please try again later.');
        });
    });

    cancelBtn.addEventListener('click', function(event) {
        event.preventDefault();
        window.location.href = 'profile.html'; // Redirect to profile.html on cancel
    });
});
