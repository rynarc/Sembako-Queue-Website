document.addEventListener('DOMContentLoaded', function() {
    loadOverview();
    loadLatestQueue();

    function loadOverview() {
        fetch('backend/dashboard_data.php')
            .then(response => response.json())
            .then(data => {
                if (data) {
                    document.getElementById('totalQueues').textContent = data.totalQueues || 0;
                    document.getElementById('yourQueue').textContent = data.yourQueue !== undefined ? data.yourQueue : '-';
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    function loadLatestQueue() {
        fetch('backend/latest_queue.php')
            .then(response => response.json())
            .then(data => {
                const queueList = document.getElementById('queueList');
                queueList.innerHTML = ''; // Clear the current list
                
                if (data.length > 0) {
                    data.forEach(queue => {
                        const queueItem = document.createElement('div');
                        queueItem.classList.add('queue');
                        queueItem.innerHTML = `
                            <h3>${queue.fullname}</h3>
                            <p>Queue Number: ${queue.queue_number}</p>
                            <p>Status: ${queue.status}</p>
                        `;
                        queueList.appendChild(queueItem);
                    });
                } else {
                    queueList.innerHTML = '<p>No recent queues available.</p>';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('queueList').innerHTML = '<p>Failed to load latest queue status. Please try again later.</p>';
            });
    }
});
