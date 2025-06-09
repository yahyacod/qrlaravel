<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit QR Code</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
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
            max-width: 550px;
            width: 100%;
            margin: 30px;
            animation: fadeIn 0.5s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        h2 {
            color: #2d3436;
            margin-bottom: 30px;
            font-size: 30px;
            text-align: center;
            font-weight: 700;
            letter-spacing: 0.5px;
        }
        .breadcrumb {
            text-align: center;
            margin-bottom: 20px;
            font-size: 14px;
        }
        .breadcrumb a {
            color: #0984e3;
            text-decoration: none;
            font-weight: 500;
        }
        .breadcrumb a:hover {
            text-decoration: underline;
        }
        .form-container {
            width: 100%;
            margin-bottom: 25px;
        }
        .form-container label {
            display: block;
            margin-bottom: 10px;
            font-weight: 500;
            color: #2d3436;
            font-size: 15px;
        }
        .form-container input[type="text"] {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 15px;
            border: 2px solid #dfe6e9;
            border-radius: 8px;
            font-size: 15px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        .form-container input[type="text"]:focus {
            border-color: #0984e3;
            box-shadow: 0 0 8px rgba(9, 132, 227, 0.2);
            outline: none;
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
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
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
        .button-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-top: 25px;
        }
        .loading {
            text-align: center;
            margin-top: 15px;
            color: #0984e3;
            display: none;
            font-weight: 500;
        }
        @media (max-width: 480px) {
            .container {
                padding: 20px;
                max-width: 90%;
                margin: 20px;
            }
            .form-container input[type="text"] {
                font-size: 14px;
                padding: 10px;
            }
            .button-grid {
                grid-template-columns: 1fr;
                gap: 10px;
            }
            .btn {
                font-size: 14px;
                padding: 10px;
            }
            h2 {
                font-size: 24px;
            }
            .breadcrumb {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="breadcrumb">
            <a href="{{ route('qr.generate') }}">Generator</a> > <a href="{{ route('qr.index') }}">Daftar</a> > Edit QR Code
        </div>
        <h2>Edit QR Code</h2>

        <div class="form-container">
            <form method="POST" action="{{ route('qr.update', $qrCode->id) }}">
                @csrf
                @method('PUT')
                <label for="url">Masukkan Kode atau Link:</label>
                <input type="text" name="url" id="url" value="{{ $qrCode->url }}" required aria-label="Input URL atau Kode">
                <button type="submit" class="btn btn-primary" aria-label="Update QR Code"><i class="fas fa-save"></i> Update QR Code</button>
            </form>
        </div>

        <div class="button-grid">
            <a href="{{ route('qr.index') }}" class="btn btn-primary" aria-label="Kembali ke Daftar"><i class="fas fa-arrow-left"></i> Kembali ke Daftar</a>
        </div>

        <div class="loading" id="loading">Memperbarui...</div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelector('form').addEventListener('submit', function() {
            document.getElementById('loading').style.display = 'block';
        });

        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                timer: 2000,
                showConfirmButton: false
            });
        @endif
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('error') }}',
                timer: 2000,
                showConfirmButton: false
            });
        @endif
    </script>
</body>
</html>