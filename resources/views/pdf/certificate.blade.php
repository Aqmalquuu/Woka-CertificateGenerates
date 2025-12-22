<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <style>
        @page {
            margin: 0;
        }

        body {
            margin: 0;
            font-family: DejaVu Sans, sans-serif;
        }

        .page {
            position: relative;
            width: 100%;
            height: 100%;
        }

        .bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .field {
            position: absolute;
            text-align: center;
            color: #111;
        }
    </style>
</head>

<body>
    <div class="page">

        {{-- BACKGROUND --}}
        <img src="{{ $backgroundPath }}" class="bg">

        {{-- NAMA SISWA --}}
        <div class="field" style="
        top: {{ $layout['student_name']['top'] ?? '50%' }};
        left: {{ $layout['student_name']['left'] ?? '50%' }};
        transform: translate(-50%, -50%);
        font-size: {{ $layout['student_name']['font_size'] ?? '36px' }};
        font-weight: bold;
    ">
            {{ $certificate->student->user->name }}
        </div>

        {{-- PROGRAM --}}
        <div class="field" style="
        top: {{ $layout['program']['top'] ?? '58%' }};
        left: {{ $layout['program']['left'] ?? '50%' }};
        transform: translate(-50%, -50%);
        font-size: {{ $layout['program']['font_size'] ?? '18px' }};
    ">
            {{ $certificate->program->nama_program }}
        </div>

        {{-- NOMOR SERTIFIKAT --}}
        <div class="field" style="
        bottom: {{ $layout['certificate_number']['bottom'] ?? '130px' }};
        right: {{ $layout['certificate_number']['right'] ?? '100px' }};
        font-size: {{ $layout['certificate_number']['font_size'] ?? '14px' }};
    ">
            {{ $certificate->certificate_code }}
        </div>

        {{-- TANGGAL TERBIT (ISSUED DATE) --}}
        <div class="field" style="
        bottom: {{ $layout['date']['bottom'] ?? '90px' }};
        right: {{ $layout['date']['right'] ?? '100px' }};
        font-size: {{ $layout['date']['font_size'] ?? '14px' }};
    ">
            {{ \Carbon\Carbon::parse($certificate->issued_date)->translatedFormat('d F Y') }}
        </div>

        {{-- QR CODE --}}
        <img src="{{ $qrPath }}" style="
        position: absolute;
        bottom: {{ $layout['qr']['bottom'] ?? '90px' }};
        left: {{ $layout['qr']['left'] ?? '100px' }};
        width: {{ $layout['qr']['size'] ?? '90px' }};
    ">

    </div>
</body>

</html>