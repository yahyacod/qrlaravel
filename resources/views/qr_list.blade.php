<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar QR Code</title>
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
        .qr-list {
            margin-top: 25px;
            max-height: 300px;
            overflow-y: auto;
        }
        .qr-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            background-color: #f7f9fc;
            border: 2px solid #dfe6e9;
            border-radius: 12px;
            margin-bottom: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            animation: fadeIn 0.5s ease-in-out;
        }
        .btn {
            padding: 10px;
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
        .btn-danger {
            background-color: #e17055;
            color: white;
        }
        .btn-danger:hover {
            background-color: #d63031;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(230, 74, 74, 0.3);
        }
        .btn:active {
            transform: translateY(0);
            box-shadow: none;
        }
        .alert {
            text-align: center;
            margin-top: 15px;
            padding: 12px;
            border-radius: 8px;
            font-weight: 500;
            animation: fadeIn 0.5s ease-in-out;
        }
        .alert-success {
            color: #2d3436;
            background-color: #b2f2bb;
        }
        .alert-error {
            color: #2d3436;
            background-color: #ffcccc;
        }
        .no-qr {
            text-align: center;
            color: #636e72;
            font-style: italic;
            padding: 20px;
            margin-top: 25px;
            border: 2px dashed #dfe6e9;
            border-radius: 12px;
            animation: fadeIn 0.5s ease-in-out;
        }
        .loading {
            text-align: center;
            margin-top: 15px;
            color: #0984e3;
            display: none;
            font-weight: 500;
        }
        .button-center {
            display: flex;
            justify-content: center;
            margin-top: 25px;
        }
        @media (max-width: 480px) {
            .container {
                padding: 20px;
                max-width: 90%;
                margin: 20px;
            }
            .qr-item {
                flex-direction: column;
                text-align: center;
                padding: 15px;
                gap: 10px;
            }
            .btn {
                font-size: 14px;
                padding: 8px;
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
            <a href="{{ route('qr.generate') }}">Generator</a> > Daftar QR Code
        </div>
        <h2>Daftar QR Code</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        <div class="qr-list">
            @forelse ($qrCodes as $qr)
                <div class="qr-item">
                    <span>{{ $qr->url }}</span>
                    <div style="display: flex; gap: 10px;">
                        <a href="{{ route('qr.edit', $qr->id) }}" class="btn btn-primary" aria-label="Edit QR Code"><i class="fas fa-edit"></i> Edit</a>
                        <form method="POST" action="{{ route('qr.destroy', $qr->id) }}" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" aria-label="Hapus QR Code"><i class="fas fa-trash"></i> Hapus</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="no-qr">Tidak ada QR code yang tersimpan.</div>
            @endforelse
        </div>

        <div class="button-center">
            <a href="{{ route('qr.generate') }}" class="btn btn-primary" aria-label="Kembali ke Generator"><i class="fas fa-arrow-left"></i> Kembali ke Generator</a>
        </div>

        <div class="loading" id="loading">Menghapus...</div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: 'QR Code ini akan dihapus secara permanen!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e17055',
                    cancelButtonColor: '#636e72',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('loading').style.display = 'block';
                        form.submit();
                    }
                });
            });
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