
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'KI Kalteng')</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6fa;
            color: #263449;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 240px;
            height: 100vh;
            overflow-y: auto;
            background: #173d68;
            color: white;
            padding: 24px 16px;
            transition: transform 0.25s ease;
            z-index: 1000;
        }

        .brand {
            padding: 0 10px 24px;
            border-bottom: 1px solid #ffffff30;
            margin-bottom: 22px;
        }

        .brand h2 {
            font-size: 21px;
            margin: 0 0 7px;
        }

        .brand p {
            font-size: 12px;
            line-height: 1.5;
            color: #cbd8e8;
            margin: 0;
        }

        .menu-label {
            font-size: 11px;
            color: #b9cbe0;
            padding: 0 10px;
            margin-bottom: 10px;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #e7eef8;
            text-decoration: none;
            padding: 12px;
            border-radius: 8px;
            font-size: 14px;
            margin-bottom: 6px;
        }

        .menu a:hover,
        .menu a.active {
            background: #ffffff20;
            color: white;
        }

        .main {
            margin-left: 240px;
            width: calc(100% - 240px);
            min-height: 100vh;
            transition: margin-left 0.25s ease, width 0.25s ease;
        }

        .topbar {
            height: 65px;
            background: white;
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 0 26px;
            border-bottom: 1px solid #e8edf3;
        }

        .menu-toggle {
            border: none;
            background: transparent;
            font-size: 25px;
            cursor: pointer;
            color: #173d68;
        }

        .topbar-title {
            font-weight: bold;
            font-size: 15px;
        }

        .content {
            padding: 26px;
        }

        .sidebar.closed {
            transform: translateX(-100%);
        }

        .main.expanded {
            margin-left: 0;
            width: 100%;
        }


        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.mobile-open {
                transform: translateX(0);
            }

            .main {
                margin-left: 0;
            }

            .content {
                padding: 16px;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

    <aside class="sidebar" id="sidebar">

        <div class="brand">
            <h2>KI KALTENG</h2>
            <p>Sistem Informasi<br>Kekayaan Intelektual</p>
        </div>

        <div class="menu-label">MENU UTAMA</div>

        
<nav class="menu">

    <a href="/">Dashboard</a>
    <a href="{{ route('potensi-ki.index') }}" class="{{ request()->routeIs('potensi-ki.*') ? 'active' : '' }}">Potensi KI</a>

    
    @auth
        @if(auth()->user()->role === 'master')
    <a href="{{ route('data-ki.index') }}">Data KI</a>
    <a href="{{ route('users.index') }}">Manajemen User</a>
    <a href="{{ route('penelaahan-ki.index') }}">
    Penelaahan Potensi KI
</a>

{{-- Menu Rekap KI khusus Master --}}
@if (auth()->check() && auth()->user()->role === 'master')
    <a href="{{ route('rekap-ki.index') }}"
       class="sidebar-link {{ request()->routeIs('rekap-ki.*') ? 'active' : '' }}">
        <i class="bi bi-bar-chart-line"></i>
        <span>Rekap KI</span>
    </a>
@endif

@endif
@if(auth()->user()->role === 'kabupaten')
    <a href="{{ route('pengajuan-saya') }}">Pengajuan KI</a>
@endif
        <a href="{{ route('data-ki.create') }}">Input Data KI</a>
        
    @endauth

    <a href="{{ route('perpustakaan-ki.index') }}">
        Perpustakaan KI
    </a>
    <a href="{{ route('sentra-ki.index') }}" class="{{ request()->routeIs('sentra-ki.*') ? 'active' : '' }}">Sentra KI</a>
    <a href="{{ route('galeri-ki.index') }}" class="{{ request()->routeIs('galeri-ki.*') ? 'active' : '' }}">Galeri Produk KI</a>

    <a href="{{ route('jenis-ki') }}">Jenis-Jenis KI</a>
    <a href="{{ route('kontak-person.index') }}" class="{{ request()->routeIs('kontak-person.*') ? 'active' : '' }}">Kontak Person Kanwil</a>
    

    @auth
        <form action="{{ route('logout') }}" method="POST"
              style="margin-top: 20px; padding: 0 12px;">
            @csrf
            <button type="submit"
                    style="width: 100%; padding: 11px; border: none;
                           border-radius: 8px; cursor: pointer;
                           background: #ffffff20; color: white;
                           text-align: left; font-size: 14px;">
                Logout
            </button>
        </form>
    @else
        <a href="{{ route('login') }}">Login</a>
    @endauth

</nav>


    </aside>

    <main class="main" id="main">

        <header class="topbar">
            <button class="menu-toggle"
                    id="menuToggle"
                    aria-label="Buka atau tutup menu">
                ☰
            </button>

            <div class="topbar-title">
                Kantor Wilayah Kementerian Hukum Kalimantan Tengah
            </div>
        </header>

        <section class="content">
            @yield('content')
        </section>

    </main>

    <script>
        const sidebar = document.getElementById('sidebar');
        const main = document.getElementById('main');
        const menuToggle = document.getElementById('menuToggle');

        menuToggle.addEventListener('click', function () {
            if (window.innerWidth <= 768) {
                sidebar.classList.toggle('mobile-open');
            } else {
                sidebar.classList.toggle('closed');
                main.classList.toggle('expanded');
            }
        });
    </script>

    @stack('scripts')

</body>
</html>
