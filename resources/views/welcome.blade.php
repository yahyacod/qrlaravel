<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to QR Code Generator</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @endif
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #74ebd5 0%, #acb6e5 100%);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #2d3436;
        }
        .container {
            background-color: #ffffff;
            padding: 35px;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
            max-width: 800px;
            width: 100%;
            margin: 30px;
            text-align: center;
            animation: fadeIn 0.5s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        h1 {
            color: #2d3436;
            font-size: 32px;
            margin-bottom: 20px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }
        p {
            color: #636e72;
            font-size: 16px;
            margin-bottom: 25px;
        }
        .btn {
            padding: 12px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 15px;
            font-weight: 500;
            transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
            text-align: center;
            margin: 5px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-primary {
            background-color: #0984e3;
            color: white;
        }
        .btn-primary:hover {
            background-color: #0652dd;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(9, 132, 227, 0.3);
        }
        .btn:active {
            transform: translateY(0);
            box-shadow: none;
        }
        .links {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 25px;
            flex-wrap: wrap;
        }
        .links a {
            color: #0984e3;
            text-decoration: none;
            font-weight: 500;
            font-size: 15px;
            transition: color 0.3s ease;
        }
        .links a:hover {
            color: #0652dd;
            text-decoration: underline;
        }
        .logo {
            width: 150px;
            height: auto;
            margin-top: 25px;
            border-radius: 8px;
            object-fit: contain;
        }
        @media (max-width: 480px) {
            .container {
                padding: 20px;
                max-width: 90%;
                margin: 20px;
            }
            h1 {
                font-size: 24px;
            }
            p {
                font-size: 14px;
            }
            .btn {
                font-size: 14px;
                padding: 10px;
            }
            .links {
                flex-direction: column;
                gap: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        @if (Route::has('login'))
            <div class="links">
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-primary"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary"><i class="fas fa-sign-in-alt"></i> Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-primary"><i class="fas fa-user-plus"></i> Register</a>
                    @endif
                @endauth
            </div>
        @endif

        <h1>Let's get started</h1>
        <p>Laravel has an incredibly rich ecosystem. We suggest starting with the following.</p>

        <div class="links">
            <div>
                <a href="https://laravel.com/docs" target="_blank"><i class="fas fa-book"></i> Read the Documentation</a>
            </div>
            <div>
                <a href="https://laracasts.com" target="_blank"><i class="fas fa-video"></i> Watch video tutorials at Laracasts</a>
            </div>
            <div>
                <a href="{{ route('qr.generate') }}" class="btn btn-primary"><i class="fas fa-qrcode"></i> Generate QR Code Now</a>
            </div>
        </div>

        <img src="{{ asset('images/logo.png') }}" alt="Laravel Logo" class="logo" loading="lazy">
    </div>
</body>
</html>