<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Inventaris</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: white;
        }
        .container {
            max-width: 1000px;
            margin: 20px auto;
            text-align: center;
        }
        .grid-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            margin-top: 20px;
        }
        .qr-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border: 1px solid black;
            padding: 10px;
            width: 180px;
            height: 120px;
            text-align: center;
            background: white;
        }
        .qr-row {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }
        .qr-logo img {
            width: 50px;
        }
        .qr-code img {
            width: 50px;
        }
        .inventaris-text {
            font-size: 10px;
            font-weight: bold;
            margin-top: 5px;
        }
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h3 class="mb-3 no-print">QR Inventaris</h3>

    <form action="{{ route('generate.qr') }}" method="POST" class="no-print">
        @csrf
        <input type="text" name="data" class="form-control mb-3" placeholder="Masukkan teks atau URL" required>
        <button type="submit" class="btn btn-primary w-100">Generate QR</button>
    </form>

    @if(session('qrList'))
    <div id="print-area" class="grid-container">
        @foreach(session('qrList') as $qr)
        <div class="qr-item">
            <div class="qr-row">
                <!-- Logo -->
                <div class="qr-logo">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo">
                </div>

                <!-- QR Code -->
                <div class="qr-code">
                    {!! $qr !!}
                </div>
            </div>
            <div class="inventaris-text">INVENTARIS MILIK</div>
        </div>
        @endforeach
    </div>

    <button onclick="printQRCode()" class="btn btn-success mt-3 w-100 no-print">Cetak QR</button>
    @endif
</div>

<script>
    function printQRCode() {
        window.print();
    }
</script>

</body>
</html>
