// profile.js

document.addEventListener('DOMContentLoaded', function() {
    loadProfile();

    function loadProfile() {
        fetch('backend/profile_data.php')
            .then(response => response.json())
            .then(data => {
                if (data) {
                    const profileDetails = document.getElementById('profileDetails');
                    profileDetails.innerHTML = `
                        <p><strong>Full Name:</strong> ${data.fullname}</p>
                        <p><strong>Username:</strong> ${data.username}</p>
                        <p><strong>Phone Number:</strong> ${data.phonenumber}</p>
                        <p><strong>Password:</strong> ********</p>
                    `;
                } else {
                    profileDetails.innerHTML = '<p>Failed to load profile information. Please try again later.</p>';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('profileDetails').innerHTML = '<p>Failed to load profile information. Please try again later.</p>';
            });
    }
});
