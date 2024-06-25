// js/login.js

document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Menghentikan submit form

    // Kirim form menggunakan fetch API
    fetch('backend/login.php', {
        method: 'POST',
        body: new FormData(document.getElementById('loginForm'))
    })
    .then(response => response.json()) // Mengubah response menjadi JSON
    .then(data => {
        console.log(data); // Tambahkan ini untuk melihat respons dari PHP di konsol

        if (data.success) {
            // Jika login berhasil, redirect ke dashboard
            window.location.href = 'dashboard.html';
        } else {
            // Jika login gagal, tampilkan pesan error
            alert(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});
