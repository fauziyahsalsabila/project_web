<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @stack('title')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/sailor/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --sp-primary: #005b96;
            --sp-primary-dark: #003f6b;
            --sp-secondary: #00a8c6;
            --sp-accent: #65d8e6;
        }

        /* Page Layout */
        html, body { min-height: 100%; }
        html { overflow-x: hidden; }
        body { display: flex; flex-direction: column; margin: 0; overflow-x: hidden; }
        main { flex: 1 0 auto; padding: 0; }

        /* ---- Navbar gaya JakOcean (fixed, tetap terlihat saat scroll) ---- */
        .sp-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            width: 100%;
            z-index: 1030;
            min-height: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            background-color: var(--sp-primary-dark);
            background-image: linear-gradient(90deg, #002d4e 0%, #004674 45%, #005b96 100%);
            box-shadow: 0 4px 16px rgba(0, 20, 40, 0.18);
        }

        /* Jarak konten di bawah navbar fixed, diisi otomatis lewat JS berdasarkan tinggi navbar asli */
        main {
            padding-top: 44px;
        }

        @media (max-width: 991.98px) {
            main { padding-top: 42px; }
        }

        /* Ukuran font pakai px (bukan rem) supaya tidak ikut membesar
           kalau ada aturan font-size global lain di style.css project.
           Teks dibuat normal/terbaca — yang dipepetin cuma padding kotaknya. */
        .sp-navbar {
            width: 100%;
            height: 44px;
            padding: 0;
            display: flex;
            align-items: center;
        }

        .sp-navbar .container {
            height: 44px;
            display: flex;
            align-items: center;
        }

        .sp-navbar .navbar-brand {
            color: #fff !important;
            font-weight: 700;
            font-size: 13px;
            letter-spacing: 0.2px;
            display: flex;
            align-items: center;
            gap: 6px;
            line-height: 1;
            margin: 0;
        }

        .sp-navbar .navbar-brand i {
            color: var(--sp-accent);
            font-size: 12px;
        }

        .sp-navbar .navbar-collapse {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            flex: 1;
            height: 44px;
            margin-left: auto;
        }

        .sp-navbar .navbar-nav {
            display: flex;
            align-items: center;
            margin: 0;
            flex-wrap: nowrap;
        }

        .sp-navbar .nav-item {
            display: flex;
            align-items: center;
            height: 44px;
        }

        .sp-navbar .nav-link {
            color: rgba(255, 255, 255, 0.88) !important;
            font-weight: 500;
            font-size: 12px !important;
            padding: 0 8px !important;
            line-height: 1.1 !important;
            display: flex;
            align-items: center;
            height: 44px;
            transition: color 0.2s ease, transform 0.2s ease;
        }

        .sp-navbar .nav-link:hover {
            color: #fff !important;
            transform: translateY(-1px);
        }

        .sp-navbar .nav-link.active {
            color: #fff !important;
            font-weight: 700;
            border-bottom: 2px solid var(--sp-accent);
        }

        .sp-navbar .btn-masuk {
            background-color: #fff;
            color: var(--sp-primary-dark) !important;
            border: none;
            border-radius: 50px;
            padding: 3px 10px;
            font-weight: 700;
            font-size: 11px;
            line-height: 1.1;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.12);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .sp-navbar .btn-masuk:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 24px rgba(0, 0, 0, 0.24);
            color: var(--sp-primary-dark) !important;
        }

        .sp-navbar .navbar-toggler {
            border-color: rgba(255, 255, 255, 0.4);
        }

        .sp-navbar .navbar-toggler-icon {
            filter: invert(1);
        }

        @media (max-width: 991.98px) {
            .sp-header {
                height: auto;
                min-height: 44px;
                align-items: stretch;
            }

            .sp-navbar {
                height: auto;
                min-height: 44px;
                flex-wrap: wrap;
            }

            .sp-navbar .container {
                height: auto;
                min-height: 44px;
                flex-wrap: wrap;
                margin: 0 auto !important;
            }

            .sp-navbar .navbar-brand {
                max-width: calc(100% - 52px);
                font-size: 12px;
            }

            .sp-navbar .navbar-toggler {
                margin-left: auto;
                padding: 4px 8px;
            }

            .sp-navbar .navbar-collapse {
                display: none;
                flex: 0 0 100%;
                flex-direction: column;
                align-items: stretch;
                width: 100%;
                height: auto;
                margin: 0;
                padding: 8px 0 12px;
            }

            .sp-navbar .navbar-collapse.show {
                display: flex;
            }

            .sp-navbar .navbar-nav {
                width: 100%;
                flex-direction: column;
                align-items: stretch;
                margin: 0 !important;
            }

            .sp-navbar .navbar-collapse > .navbar-nav + .navbar-nav {
                margin-top: 6px !important;
                padding-top: 6px;
                border-top: 1px solid rgba(255, 255, 255, 0.18);
            }

            .sp-navbar .nav-item {
                display: block;
                height: auto;
            }

            .sp-navbar .nav-link {
                width: 100%;
                min-height: 42px;
                height: auto;
                padding: 10px 12px !important;
                transform: none;
            }
        }

        /* Footer */
        footer {
            background-color: var(--sp-primary-dark);
            background-image: linear-gradient(90deg, #002d4e 0%, #005b96 100%);
            color: #fff;
            text-align: center;
            padding: 12px 0;
            margin-top: 0;
            font-size: 0.9rem;
            flex-shrink: 0;
        }
    </style>

    {{-- Tempat keluar untuk @push('css') di setiap halaman turunan --}}
    @stack('css')
</head>

<body>
<header class="sp-header">
    <nav class="navbar navbar-expand-lg sp-navbar">
        <div class="container">
            <a class="navbar-brand" href="{{ route('sailor.home.dashboard') }}">
                <i class="fas fa-ship"></i> SMART PELAUT JAKARTA
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarContent" aria-controls="navbarContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a href="/" class="nav-link">
                            <i class="fas fa-arrow-left me-1"></i> Kembali ke Jackocean
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('sailor.home.dashboard') }}"
                           class="nav-link {{ Route::is('sailor.home.dashboard') ? 'active' : '' }}">
                           Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('sailor.home.compliance') }}"
                           class="nav-link {{ Route::is('sailor.home.compliance') ? 'active' : '' }}">
                           Kepatuhan & Pelanggaran
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('sailor.home.regulation') }}"
                           class="nav-link {{ Route::is('sailor.home.regulation') ? 'active' : '' }}">
                           Peraturan
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav ms-3">
                    @guest
                        <li class="nav-item">
                            <a class="btn btn-masuk btn-sm" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt"></i> Masuk
                            </a>
                        </li>
                    @endguest

                    @auth
                        <li class="nav-item">
                            @if(in_array(Auth::user()->role, ['admin', 'sailor'], true))
                                <a class="btn btn-masuk btn-sm" href="{{ route('sailor.dashboard') }}">
                                    <i class="fas fa-tachometer-alt"></i> Dashboard
                                </a>
                            @endif
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
</header>

<!-- Main Content -->
<main class="main-content">
    @yield('content')
</main>

<!-- Footer -->
<footer class="footer">
    <p>&copy; 2025 SMART PELAUT JAKARTA. All rights reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    (function () {
        function syncHeaderOffset() {
            var header = document.querySelector('.sp-header');
            var main = document.querySelector('main.main-content');
            if (header && main) {
                main.style.paddingTop = header.offsetHeight + 'px';
            }
        }
        window.addEventListener('load', syncHeaderOffset);
        window.addEventListener('resize', syncHeaderOffset);
        document.addEventListener('shown.bs.collapse', syncHeaderOffset);
        document.addEventListener('hidden.bs.collapse', syncHeaderOffset);
    })();
</script>

{{-- Tempat keluar untuk @push('scripts') di setiap halaman turunan --}}
@stack('scripts')
</body>
</html>