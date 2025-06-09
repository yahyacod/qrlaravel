<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Generator</title>
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
            position: relative;
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
        .btn-success {
            background-color: #00b894;
            color: white;
        }
        .btn-success:hover {
            background-color: #009875;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 184, 148, 0.3);
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
        .upload-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #0984e3;
            font-size: 20px;
            transition: color 0.3s ease;
        }
        .upload-icon:hover {
            color: #0652dd;
        }
        .upload-input {
            display: none;
        }
        .qr-box {
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #dfe6e9;
            padding: 20px;
            background-color: #f7f9fc;
            border-radius: 12px;
            margin-top: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            animation: fadeIn 0.5s ease-in-out;
        }
        .qr-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border: 2px solid #dfe6e9;
            padding: 15px;
            background-color: #f7f9fc;
            border-radius: 12px;
            margin-bottom: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            animation: fadeIn 0.5s ease-in-out;
        }
        .logo {
            width: 100px;
            height: 100px;
            margin-right: 20px;
            border-radius: 8px;
            object-fit: contain;
        }
        .qr-code {
            width: 100px;
            height: 100px;
        }
        .text {
            text-align: center;
            margin-top: 10px;
            font-weight: 500;
            color: #0984e3;
            font-size: 14px;
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
        .button-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-top: 25px;
        }
        .button-grid-secondary {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-top: 15px;
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
        .upload-status {
            text-align: center;
            margin-top: 15px;
            padding: 12px;
            border-radius: 8px;
            display: none;
            animation: fadeIn 0.5s ease-in-out;
        }
        .loading {
            text-align: center;
            margin-top: 15px;
            color: #0984e3;
            display: none;
            font-weight: 500;
        }
        .qr-list {
            margin-top: 25px;
            max-height: 300px;
            overflow-y: auto;
        }
        .qr-list-header {
            font-weight: 600;
            color: #0984e3;
            margin-bottom: 15px;
            text-align: center;
            font-size: 16px;
        }
        .qr-item label {
            display: flex;
            align-items: center;
            font-size: 14px;
            color: #2d3436;
        }
        .qr-item input[type="checkbox"] {
            margin-right: 10px;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            background-color: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            text-align: center;
            max-width: 400px;
            width: 90%;
            animation: fadeIn 0.5s ease-in-out;
        }
        .modal-content h3 {
            margin-bottom: 20px;
            color: #2d3436;
            font-size: 20px;
            font-weight: 600;
        }
        .modal-content button {
            padding: 10px 20px;
            margin: 5px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 15px;
            font-weight: 500;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        .modal-content button:hover {
            transform: translateY(-2px);
        }
        .modal-content .btn-image {
            background-color: #00b894;
            color: white;
        }
        .modal-content .btn-image:hover {
            background-color: #009875;
        }
        .modal-content .btn-print {
            background-color: #e17055;
            color: white;
        }
        .modal-content .btn-print:hover {
            background-color: #d63031;
        }
        @media print {
            body {
                background: none;
                margin: 0;
                padding: 0;
            }
            .container, .modal {
                display: none;
            }
            .printable-qr-codes {
                display: block !important;
                page-break-inside: avoid;
            }
            .qr-box, .qr-item {
                display: flex;
                align-items: center;
                justify-content: center;
                border: 2px solid #000;
                padding: 15px;
                margin: 10px;
                width: 250px;
                height: 150px;
                box-shadow: none;
                break-inside: avoid;
            }
            .logo {
                width: 80px;
                height: 80px;
                margin-right: 15px;
            }
            .qr-code {
                width: 80px;
                height: 80px;
            }
            .text {
                font-size: 14px;
                color: #000;
                margin-top: 5px;
            }
            .qr-item label, .button-grid, .button-grid-secondary, .qr-list-header, .form-container, h2, .alert, .upload-status, .loading, .breadcrumb {
                display: none;
            }
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
            .qr-box, .qr-item {
                flex-direction: column;
                text-align: center;
                padding: 15px;
            }
            .logo {
                margin-right: 0;
                margin-bottom: 15px;
                width: 80px;
                height: 80px;
            }
            .qr-code {
                width: 80px;
                height: 80px;
            }
            .button-grid, .button-grid-secondary {
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
            <a href="{{ route('qr.generate') }}">Generator</a>
        </div>
        <h2>QR Code Generator</h2>
        <div class="form-container">
            <form method="POST" action="{{ route('qr.generate') }}" enctype="multipart/form-data" id="uploadForm" autocomplete="off" aria-label="Form Generate QR Code">
                @csrf
                <label for="url">Masukkan Kode atau Link:</label>
                <div style="position: relative;">
                    <input type="text" name="url" id="url" value="" aria-label="Input URL atau Kode">
                    <label for="upload-file" class="upload-icon">
                        <i class="fas fa-upload"></i>
                    </label>
                    <input type="file" id="upload-file" name="upload_file" class="upload-input" accept=".xml" onchange="checkUpload()" aria-label="Unggah File XML">
                </div>
                <button type="submit" class="btn btn-primary" aria-label="Generate QR Code" title="Generate QR Code"><i class="fas fa-qrcode"></i> Generate QR Code</button>
            </form>
            <div class="upload-status" id="uploadStatus"></div>
            <div class="loading" id="loading">Memproses...</div>
        </div>

        @if(!empty($url) || !empty($qrCodesFromXml))
        @if(!empty($url))
        <div class="qr-box">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo" loading="lazy">
            <div>
                {!! QrCodeFacade::size(100)->generate($url) !!}
                <div class="text">INVENTARIS MILIK</div>
            </div>
        </div>
        @endif

        @if(!empty($qrCodesFromXml))
        <div class="qr-list">
            <div class="qr-list-header">QR Codes dari File XML</div>
            <form method="POST" action="{{ route('qr.saveSelected') }}" id="saveForm" autocomplete="off" aria-label="Form Simpan QR Terpilih">
                @csrf
                @foreach($qrCodesFromXml as $index => $qr)
                <div class="qr-item">
                    <div style="display: flex; align-items: center;">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo" loading="lazy">
                        <div>
                            {!! QrCodeFacade::size(100)->generate($qr['url']) !!}
                            <div class="text">INVENTARIS MILIK</div>
                        </div>
                    </div>
                    <label>
                        <input type="checkbox" name="selected_urls[]" value="{{ $qr['url'] }}" checked aria-label="Pilih QR {{ $qr['item'] }} ({{ $qr['code'] }})">
                        {{ $qr['item'] }} ({{ $qr['code'] }})
                    </label>
                </div>
                @endforeach
            </form>
        </div>
        @endif

        <div class="button-grid">
            <button class="btn btn-success print-btn" onclick="openModal()" aria-label="Cetak QR Code" title="Cetak QR Code"><i class="fas fa-print"></i> Cetak</button>
            <a href="{{ route('qr.index') }}" class="btn btn-success back-btn" aria-label="Lihat Daftar QR" title="Lihat Daftar QR"><i class="fas fa-list"></i> Lihat Daftar QR</a>
        </div>
        <div class="button-grid-secondary">
            @if(!empty($url))
            <form method="POST" action="{{ route('qr.save') }}" style="display: inline;">
                @csrf
                <input type="hidden" name="url" value="{{ $url }}">
                <button type="submit" class="btn btn-primary save-btn" aria-label="Simpan ke Database" title="Simpan ke Database"><i class="fas fa-database"></i> Simpan ke Database</button>
            </form>
            @elseif(!empty($qrCodesFromXml))
            <button type="submit" form="saveForm" class="btn btn-primary save-btn" aria-label="Simpan ke Database" title="Simpan ke Database"><i class="fas fa-database"></i> Simpan ke Database</button>
            @endif
            <form method="POST" action="{{ route('qr.clean') }}" style="display: inline;" id="cleanForm">
                @csrf
                <button type="submit" class="btn btn-danger" aria-label="Bersihkan Data QR" title="Bersihkan Data QR"><i class="fas fa-broom"></i> Clean</button>
            </form>
        </div>
        @else
        <div class="no-qr">
            Tidak ada QR code. Masukkan link atau unggah file XML untuk memulai.
        </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif
    </div>

    <div id="exportModal" class="modal">
        <div class="modal-content">
            <h3>Pilih Opsi Cetak</h3>
            <button class="btn-image" onclick="exportToImage()" aria-label="Unduh sebagai Gambar">Unduh sebagai Gambar</button>
            <button class="btn-print" onclick="printDirect()" aria-label="Cetak Langsung">Cetak Langsung</button>
        </div>
    </div>

    <div class="printable-qr-codes" style="position: absolute; top: -9999px; left: -9999px;"></div>

    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function checkUpload() {
            const fileInput = document.getElementById('upload-file');
            const statusDiv = document.getElementById('uploadStatus');
            if (fileInput.files.length > 0) {
                statusDiv.style.display = 'block';
                statusDiv.textContent = 'File ' + fileInput.files[0].name + ' telah dipilih. Klik "Generate QR Code" untuk melanjutkan.';
                statusDiv.style.color = '#2d3436';
                statusDiv.style.backgroundColor = '#b2f2bb';
            } else {
                statusDiv.style.display = 'none';
            }
        }

        document.getElementById('uploadForm').addEventListener('submit', function(e) {
            const fileInput = document.getElementById('upload-file');
            const statusDiv = document.getElementById('uploadStatus');
            const loadingDiv = document.getElementById('loading');
            if (fileInput.files.length > 0) {
                statusDiv.style.display = 'block';
                statusDiv.textContent = 'Mengunggah file ' + fileInput.files[0].name + '...';
                statusDiv.style.color = '#2d3436';
                statusDiv.style.backgroundColor = '#dfe6e9';
            }
            loadingDiv.style.display = 'block';
            setTimeout(() => {
                document.getElementById('uploadForm').reset();
                document.getElementById('uploadStatus').style.display = 'none';
                loadingDiv.style.display = 'none';
            }, 100);
        });

        document.getElementById('cleanForm').addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Semua data QR akan dibersihkan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e17055',
                cancelButtonColor: '#636e72',
                confirmButtonText: 'Ya, bersihkan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });

        function prepareQrCodes() {
            const printableDiv = document.querySelector('.printable-qr-codes');
            printableDiv.innerHTML = '';

            @if(!empty($url))
                printableDiv.innerHTML += `
                    <div class="qr-box">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
                        <div>
                            {!! QrCodeFacade::size(100)->generate($url) !!}
                            <div class="text">INVENTARIS MILIK</div>
                        </div>
                    </div>
                `;
            @endif

            @if(!empty($qrCodesFromXml))
                const selectedUrls = Array.from(document.querySelectorAll('input[name="selected_urls[]"]:checked')).map(input => input.value);
                @foreach($qrCodesFromXml as $qr)
                    if (selectedUrls.includes("{{ $qr['url'] }}")) {
                        printableDiv.innerHTML += `
                            <div class="qr-item">
                                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
                                <div>
                                    {!! QrCodeFacade::size(100)->generate($qr['url']) !!}
                                    <div class="text">INVENTARIS MILIK</div>
                                </div>
                            </div>
                        `;
                    }
                @endforeach
            @endif

            return printableDiv.innerHTML !== '';
        }

        function openModal() {
            if (prepareQrCodes()) {
                document.getElementById('exportModal').style.display = 'flex';
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Tidak ada QR Code!',
                    text: 'Tidak ada QR code untuk diekspor.',
                    timer: 2000,
                    showConfirmButton: false
                });
            }
        }

        function exportToImage() {
            const printableDiv = document.querySelector('.printable-qr-codes');
            printableDiv.style.position = 'absolute';
            printableDiv.style.top = '0';
            printableDiv.style.left = '0';
            printableDiv.style.visibility = 'visible';

            html2canvas(printableDiv, { scale: 2, useCORS: true }).then(canvas => {
                const link = document.createElement('a');
                link.download = 'qr_codes.png';
                link.href = canvas.toDataURL('image/png');
                link.click();
                document.getElementById('exportModal').style.display = 'none';
                printableDiv.style.position = 'absolute';
                printableDiv.style.top = '-9999px';
                printableDiv.style.left = '-9999px';
                printableDiv.style.visibility = 'hidden';
            }).catch(err => {
                console.error('Gagal mengunduh gambar:', err);
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Gagal mengunduh gambar. Silakan coba lagi.',
                    timer: 2000,
                    showConfirmButton: false
                });
            });
        }

        function printDirect() {
            const printableDiv = document.querySelector('.printable-qr-codes');
            printableDiv.style.position = 'absolute';
            printableDiv.style.top = '0';
            printableDiv.style.left = '0';
            printableDiv.style.visibility = 'visible';

            document.getElementById('exportModal').style.display = 'none';
            window.print();

            printableDiv.style.position = 'absolute';
            printableDiv.style.top = '-9999px';
            printableDiv.style.left = '-9999px';
            printableDiv.style.visibility = 'hidden';
        }

        window.onclick = function(event) {
            const modal = document.getElementById('exportModal');
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        }

        window.onload = function() {
            document.getElementById('uploadForm').reset();
            document.getElementById('uploadStatus').style.display = 'none';
            document.getElementById('loading').style.display = 'none';
        };

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