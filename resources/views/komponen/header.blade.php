<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Shop</title>
    <!-- Link ke file style.css -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Tambahkan Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Header dengan Navbar -->
    <header>
        <nav class="navbar navbar-light navbar-bg">
            <div class="container">
                <!-- Logo atau Nama Coffee Shop -->
                <span class="navbar-title">Pompom's Coffee</span>

                <!-- Tombol Hamburger untuk layar kecil dan besar -->
                <button class="navbar-toggler" type="button" id="sidebarToggler" aria-label="Toggle sidebar">
                    <span class="navbar-toggler-icon"></span> <!-- Garis tiga untuk tombol hamburger -->
                </button>
            </div>
        </nav>
    </header>

    <!-- Sidebar -->
    <div id="sidebar" class="sidebar">
        <ul class="sidebar-nav">
            <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="/menu">Menu</a></li>
            <li class="nav-item"><a class="nav-link" href="/about">About</a></li>
            <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>
        </ul>
    </div>

    <!-- Pastikan untuk memuat file Bootstrap JS dan Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <script>
       // Ambil elemen sidebar, tombol hamburger, dan tombol menu
        const sidebar = document.querySelector('.sidebar');
        const navbarToggler = document.querySelector('.navbar-toggler');

        // Event listener untuk klik tombol hamburger (untuk membuka sidebar)
        navbarToggler.addEventListener('click', function(event) {
            sidebar.classList.toggle('show');  // Toggle visibility sidebar
            event.stopPropagation(); // Mencegah klik pada tombol hamburger mempengaruhi event lainnya
        });

        // Event listener untuk klik di luar sidebar (untuk menutup sidebar)
        document.addEventListener('click', function(event) {
            // Jika klik di luar sidebar dan tombol hamburger, tutup sidebar
            if (!sidebar.contains(event.target) && !navbarToggler.contains(event.target)) {
                sidebar.classList.remove('show'); // Menutup sidebar
            }
            if (!event.target.closest('.nav-item')) {
                sidebar.classList.remove('show'); // Menutup sidebar
            }
        });
        
        // Mencegah penutupan sidebar ketika tombol menu diklik
        const sidebarLinks = document.querySelectorAll('.sidebar-nav .nav-item');
        sidebarLinks.forEach(link => {
            link.addEventListener('click', function(event) {
                // Tidak menutup sidebar ketika mengklik tombol menu
                event.stopPropagation();
            });
        });

    </script>
</body>
</html>
