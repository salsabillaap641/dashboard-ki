
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - KI Kalteng</title>

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            font-family: Arial, sans-serif;
            background: #f3f6fb;
            color: #26364d;
        }

        .login-banner {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 60px;
            color: white;
            background: linear-gradient(140deg, #102f55, #1d5685);
        }

        .login-banner h1 {
            max-width: 560px;
            font-size: 42px;
            line-height: 1.2;
        }

        .login-banner p {
            max-width: 470px;
            color: #d4e5f5;
            line-height: 1.8;
        }

        .login-panel {
            width: 460px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            background: white;
        }

        .login-form { width: 100%; max-width: 360px; }

        .login-form h2 {
            color: #173e67;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #78869a;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .field { margin-bottom: 20px; }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 13px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 13px;
            border: 1px solid #d7dfeb;
            border-radius: 8px;
            font-size: 14px;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 22px;
            font-size: 13px;
        }

        .remember label { margin: 0; font-weight: normal; }

        .login-button {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 8px;
            background: #173e67;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        .error {
            padding: 12px;
            margin-bottom: 18px;
            border-radius: 8px;
            background: #fee2e2;
            color: #991b1b;
            font-size: 13px;
        }

        @media (max-width: 800px) {
            .login-banner { display: none; }
            .login-panel { width: 100%; }
        }
    </style>
</head>
<body>
    <section class="login-banner">
        <strong>KI KALTENG</strong>
        <h1>Sistem Informasi Kekayaan Intelektual</h1>
        <p>
            Kantor Wilayah Kementerian Hukum Kalimantan Tengah.
            Kelola dan pantau data Kekayaan Intelektual dalam satu sistem.
        </p>
    </section>

    <main class="login-panel">
        <form class="login-form" method="POST" action="{{ route('login.process') }}">
            @csrf

            <h2>Selamat Datang</h2>
            <p class="subtitle">Login menggunakan username dan password akun kamu.</p>

            @if ($errors->any())
                <div class="error">{{ $errors->first() }}</div>
            @endif

            <div class="field">
                <label for="username">Username</label>
                <input
                    type="text"
                    id="username"
                    name="username"
                    value="{{ old('username') }}"
                    placeholder="Masukkan username"
                    autocomplete="username"
                    required
                    autofocus
                >
            </div>

            <div class="field">
                <label for="password">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Masukkan password"
                    autocomplete="current-password"
                    required
                >
            </div>

            <div class="remember">
                <input type="checkbox" id="remember" name="remember" value="1">
                <label for="remember">Ingat saya</label>
            </div>

            <button class="login-button" type="submit">Login</button>
        </form>
    </main>
</body>
</html>
