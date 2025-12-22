<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Woka Certificate Management</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/WokaCert.png') }}">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="min-h-screen bg-gray-100 flex items-center justify-center">
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Login Gagal',
                html: `
                <ul style="text-align:left;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            `,
                confirmButtonText: 'Coba Lagi'
            });
        </script>
    @endif


    <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-8">
        <!-- Logo / Brand -->
        <div class="text-center mb-8">
            <div class="flex justify-center mb-3">
                <img src="{{ asset('assets/images/WokaCert.png') }}" alt="WokaCert Logo"
                    class="w-12 h-12 object-contain">
            </div>

            <h1 class="text-2xl font-bold text-gray-800 tracking-wide">
                WokaCertif
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Silakan login ke dashboard
            </p>
        </div>


        <!-- Form Login -->
        <form method="POST" action="{{ route('login.store') }}" class="space-y-5">
            @csrf

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Password -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Remember & Forgot -->
            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="remember" class="rounded border-gray-300">
                    <span class="text-gray-600">Ingat saya</span>
                </label>
            </div>

            <!-- Button -->
            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded-lg font-medium hover:bg-blue-700 transition">
                Login
            </button>
        </form>

        <!-- Footer -->
        <p class="text-xs text-center text-gray-400 mt-6">
            © {{ date('Y') }} Muriq Creative . All rights reserved.
        </p>
    </div>

</body>

</html>