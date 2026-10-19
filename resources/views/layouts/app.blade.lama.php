
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
            min-height: 100vh;
            transition: margin-left 0.25s ease;
        }

        
.topbar {
    height: 65px;
    background: white;
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 0 26px;
    border-bottom: 1px solid #e8edf3;

    position: sticky;
    top: 0;
    z-index: 900;
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
        }


/* Area konten utama */
/* .main-content {
    width: calc(100% - 230px);
    margin-left: 230px;
    padding: 32px;
    box-sizing: border-box;
    transition: width 0.3s ease, margin-left 0.3s ease;
} */

/* Saat sidebar ditutup */
/* body.sidebar-collapsed .main-content {
    width: 100%;
    margin-left: 0;
} */

/* Konten dashboard tidak perlu dipaksa berada di tengah */
/* .dashboard-container {
    width: 100%;
    max-width: none;
    margin: 0;
    box-sizing: border-box;
} */

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.mobile-open {
                transform: translateX(0);
            }

            
.main {
    margin-left: 240px;
    width: calc(100% - 240px);
    min-height: 100vh;
    transition: margin-left 0.25s ease, width 0.25s ease;
}

.main.expanded {
    margin-left: 0;
    width: 100%;
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
            <a href="{{ url('/') }}"
               class="{{ request()->is('/') ? 'active' : '' }}">
                <span>▦</span> Dashboard
            </a>

            <a href="{{ url('/data-ki') }}"
               class="{{ request()->is('data-ki') ? 'active' : '' }}">
                <span>▤</span> Data KI
            </a>

            <a href="{{ url('/input-ki') }}"
               class="{{ request()->is('input-ki') ? 'active' : '' }}">
                <span>＋</span> Input Data KI
            </a>

            <a href="{{ url('/perpustakaan-ki') }}"
               class="{{ request()->is('perpustakaan-ki') ? 'active' : '' }}">
                <span>▣</span> Perpustakaan KI
            </a>
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
