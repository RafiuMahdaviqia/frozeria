<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frozeria Stok</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        /* Sedikit custom styling agar mirip dengan mockup */
        .navbar-dark-custom { background-color: #1a1a1a; }
    </style>
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark navbar-dark-custom mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">Frozeria Stok</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') || request()->routeIs('barang.*') ? 'active' : '' }}" href="{{ url('/') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('kategori.*') ? 'active' : '' }}" href="{{ route('kategori.index') }}">Kategori</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('bantuan') ? 'active' : '' }}" href="{{ url('/bantuan') }}">Bantuan</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mb-5">
        @if (session()->has('success'))
            <div class="toast-container position-fixed bottom-0 end-0 p-3">
                <div id="successToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            {{ session('success') }}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @if (session()->has('success'))
        <script>
            const successToastEl = document.getElementById('successToast');

            if (successToastEl) {
                const successToast = new bootstrap.Toast(successToastEl);
                successToast.show();
            }
        </script>
    @endif
</body>
</html>