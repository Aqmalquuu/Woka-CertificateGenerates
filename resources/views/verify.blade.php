<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Certificate Verification | WokaCertif</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #f5f6f8;
            font-family: 'Inter', system-ui, sans-serif;
        }

        .verify-card {
            width: 500px;
            border-radius: 18px;
            border: none;
            box-shadow: 0 15px 40px rgba(0, 0, 0, .08);
        }

        .verify-icon {
            width: 90px;
            height: 90px;
            background: #e7f9f1;
            color: #16a34a;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 42px;
            margin: 0 auto;
        }

        .badge-verified {
            background: #16a34a;
            font-size: 12px;
            letter-spacing: .08em;
            padding: 6px 14px;
        }

        .brand {
            font-weight: 700;
            letter-spacing: .12em;
        }
    </style>
</head>

<body>
    <div class="container min-vh-100 d-flex align-items-center justify-content-center">

        <div class="card verify-card p-4 text-center">

            {{-- Brand --}}
            <div class="mb-3 brand text-uppercase text-muted">
                WokaCert Verification
            </div>

            {{-- Icon --}}
            <div class="verify-icon mb-3">
                <i class="bi bi-patch-check-fill"></i>
            </div>

            {{-- Status --}}
            <h4 class="fw-bold mb-1">Certificate Verified</h4>
            <span class="badge badge-verified mb-4 d-inline-block py-2 px-3">
                VALID & AUTHENTIC
            </span>

            <hr class="my-4">

            {{-- Certificate Info --}}
            <div class="text-start px-3">
                <div class="mb-3">
                    <small class="text-muted">Nama Peserta</small>
                    <div class="fw-semibold fs-5">
                        {{ $certificate->student->user->name }}
                    </div>
                </div>

                <div class="mb-3">
                    <small class="text-muted">Program</small>
                    <div class="fw-semibold">
                        {{ $certificate->program->nama_program }}
                    </div>
                </div>

                <div class="mb-3">
                    <small class="text-muted">Nomor Sertifikat</small>
                    <div class="fw-semibold">
                        {{ $certificate->certificate_code }}
                    </div>
                </div>

                <div class="mb-3">
                    <small class="text-muted">Tanggal Terbit</small>
                    <div class="fw-semibold">
                        {{ \Carbon\Carbon::parse($certificate->issued_date)->translatedFormat('d F Y') }}
                    </div>
                </div>

                <div>
                    <small class="text-muted">Status</small>
                    <div class="fw-semibold text-success text-uppercase">
                        <span class="badge bg-{{ $certificate->status == 'active' ? 'success' : 'danger' }} py-2 px-3">
                            {{ ucfirst($certificate->status) }}
                        </span>
                    </div>
                </div>
            </div>

            <hr class="my-4">

            {{-- Footer --}}
            <small class="text-muted">
                Sertifikat ini diverifikasi secara resmi melalui <br>
                <strong>Cv. Woka Project Mandiri</strong>
            </small>
        </div>

    </div>
</body>

</html>