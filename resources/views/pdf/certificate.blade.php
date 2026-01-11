<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <style>
        /* ================= PAGE SETUP ================= */
        @page {
            margin: 0;
            size: A4 landscape;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: DejaVu Sans, sans-serif;
        }

        .page {
            position: relative;
            width: 297mm;
            height: 210mm;
        }

        /* ================= BACKGROUND ================= */
        .bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 297mm;
            height: 210mm;
            z-index: 1;
        }

        /* ================= GLOBAL FIELD ================= */
        .field {
            position: absolute;
            z-index: 2;
            color: #1a1a1a;
        }

        /* ================= FONT SCRIPT ================= */
        @font-face {
            font-family: 'GreatVibes';
            src: url("{{ storage_path('fonts/GreatVibes-Regular.ttf') }}") format('truetype');
        }
    </style>
</head>

<body>
<div class="page">

    {{-- ================= BACKGROUND TEMPLATE ================= --}}
    <img src="{{ $backgroundPath }}" class="bg">

    {{-- ================= NAMA SISWA ================= --}}
    <div class="field" style="
        top: {{ $layout['student_name']['top'] }};
        left: {{ $layout['student_name']['left'] }};
        transform: translate(-50%, -50%);
        font-size: {{ $layout['student_name']['font_size'] }};
        font-family: '{{ $layout['student_name']['font_family'] ?? 'GreatVibes' }}';
        font-weight: {{ $layout['student_name']['font_weight'] ?? 'normal' }};
        text-align: left;
        width: 160mm;
    ">
        {{ $certificate->student->user->name }}
    </div>

    {{-- ================= DATA PROGRAM ================= --}}
    @php
        $program = $certificate->program;
        $programName = $program->nama_program;
        $type = $program->jenis ?? 'kursus';
    @endphp

    {{-- ================= TEKS PENDUKUNG ================= --}}
    <div class="field" style="
        top: {{ $layout['supporting_text']['top'] }};
        left: {{ $layout['supporting_text']['left'] }};
        transform: translate(-50%, -50%);
        width: {{ $layout['supporting_text']['width'] ?? '140mm' }};
        font-size: {{ $layout['supporting_text']['font_size'] }};
        line-height: {{ $layout['supporting_text']['line_height'] }};
        text-align: {{ $layout['supporting_text']['text_align'] }};
    ">
        @if ($type === 'pkl')
            Telah menyelesaikan Praktik Kerja Lapangan (PKL) pada bidang
            <strong>{{ $programName }}</strong> dengan penuh tanggung jawab,
            disiplin, serta menunjukkan kemampuan adaptasi yang baik di lingkungan kerja profesional.
        @else
            Telah menyelesaikan kursus
            <strong>{{ $programName }}</strong> dengan kompetensi yang memadai,
            serta mampu menerapkan pengetahuan dan keterampilan secara praktis
            dalam konteks profesional.
        @endif
    </div>

    {{-- ================= QR CODE ================= --}}
    <img src="{{ $qrPath }}" style="
        position: absolute;
        top: {{ $layout['qr']['top'] }};
        left: {{ $layout['qr']['left'] }};
        width: {{ $layout['qr']['size'] }};
        z-index: 2;
    ">

    {{-- ================= NOMOR SERTIFIKAT ================= --}}
    <div class="field" style="
        top: {{ $layout['certificate_number']['top'] }};
        left: {{ $layout['certificate_number']['left'] }};
        font-size: {{ $layout['certificate_number']['font_size'] }};
    ">
        {{ $certificate->certificate_code }}
    </div>

    {{-- ================= TANGGAL TERBIT ================= --}}
    <div class="field" style="
        top: {{ $layout['date']['top'] }};
        left: {{ $layout['date']['left'] }};
        font-size: {{ $layout['date']['font_size'] }};
    ">
        {{ \Carbon\Carbon::parse($certificate->issued_date)->translatedFormat('d F Y') }}
    </div>

</div>
</body>
</html>
