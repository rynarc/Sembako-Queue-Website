document.addEventListener('DOMContentLoaded', function() {
    const queueForm = document.getElementById('queueForm');
    const queueInfo = document.getElementById('queue-info');

    queueForm.addEventListener('submit', function(event) {
        event.preventDefault();
        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;
        getQueueNumber(username, password);
    });

    function getQueueNumber(username, password) {
        fetch('backend/queue.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ username: username, password: password }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                queueInfo.innerHTML = `
                    <p>Your Queue Number: ${data.queueNumber}</p>
                    <p>Status: ${data.status}</p>
                `;
                setTimeout(() => {
                    window.location.href = 'dashboard.html';
                }, 2000);
            } else {
                queueInfo.innerHTML = `<p>${data.message}</p>`;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            queueInfo.innerHTML = '<p>Failed to get queue number. Please try again later.</p>';
        });
    }
});
