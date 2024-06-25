document.addEventListener('DOMContentLoaded', function() {
    loadOverview();
    loadLatestQueueStatus();
});

function loadOverview() {
    fetch('backend/dashboard_data.php')
    .then(response => response.json())
    .then(data => {
        const overviewCards = document.getElementById('overviewCards');
        overviewCards.innerHTML = `
            <div class="card">
                <h3>Total Queue</h3>
                <p>${data.totalQueue}</p>
            </div>
            <div class="card">
                <h3>Your Queue Number</h3>
                <p>${data.userQueueNumber !== null ? data.userQueueNumber : 'Not queued'}</p>
            </div>
        `;
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function loadLatestQueueStatus() {
    fetch('backend/latest_queue.php')
    .then(response => response.json())
    .then(data => {
        const queueList = document.getElementById('queueList');
        queueList.innerHTML = '';
        data.forEach(queue => {
            queueList.innerHTML += `
                <div class="queue">
                    <h3>${queue.fullname}</h3>
                    <p>Queue Number: ${queue.queue_number}</p>
                    <p>Status: ${queue.status}</p>
                </div>
            `;
        });
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
