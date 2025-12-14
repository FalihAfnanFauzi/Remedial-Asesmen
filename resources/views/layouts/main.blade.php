<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SmartFlood Command Center</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        body {
            background-color: #f4f6f9;
        }

        .navbar-custom {
            background: linear-gradient(90deg, #8B0000, #2c3e50);
        }

        /* Warna Merah Tua ke Biru Gelap */
        .card-custom {
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-smart {
            background-color: #8B0000;
            color: white;
        }

        .btn-smart:hover {
            background-color: #a00000;
            color: white;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

    @include('partials.navbar')

    <div class="container mt-4 mb-5 flex-grow-1">
        @yield('content')
    </div>

    <footer class="text-center py-3 text-muted mt-auto border-top bg-white">
        <small>© 2025 Smart City Kabupaten Bandung - Sistem Peringatan Dini</small>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>

</html>
