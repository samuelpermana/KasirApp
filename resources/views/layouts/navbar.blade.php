<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir App</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Kasir App</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/kasir">Kasir</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/riwayat-transaksi">Riwayat Transaksi</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/kategori">Kategori</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/produk">Produk</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
    @if(Auth::check())
        <li class="nav-item">
            <!-- Use a form to trigger a POST request for logout -->
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-link nav-link">Logout</button>
            </form>
        </li>
    @else
        <li class="nav-item">
            <a class="nav-link" href="/login">Login</a>
        </li>
    @endif
</ul>
    </div>
</nav>

<div class="container mt-3">
    <!-- Konten halaman akan ditampilkan di sini -->
    @yield('content')
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
