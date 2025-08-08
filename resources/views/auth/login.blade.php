<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Login - SIMRS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-8">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-2">SIMRS - Login</h2>
        <p class="text-center text-gray-500 mb-6">Silakan masuk dengan akun Anda</p>

        {{-- Notifikasi Sukses / Error --}}
        @if(session('success'))
            <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 border border-red-300 text-red-800 px-4 py-2 rounded mb-4">
                {{ $errors->first() ?: 'Email atau kata sandi salah.' }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.submit') }}" class="space-y-4">
            @csrf
            {{-- Email --}}
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 border">
            </div>

            {{-- Password --}}
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Kata Sandi</label>
                <input id="password" name="password" type="password" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 border">
            </div>

            {{-- Ingat Saya --}}
            <div class="flex items-center">
                <input id="remember" name="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }}
                    class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                <label for="remember" class="ml-2 block text-sm text-gray-900">
                    Ingat saya
                </label>
            </div>

            {{-- Tombol Submit --}}
            <div>
                <button type="submit"
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Masuk
                </button>
            </div>
        </form>

        {{-- Footer / Optional link --}}
        <p class="mt-6 text-center text-sm text-gray-500">
            {{-- Tambahkan link forgot password jika ada --}}
        </p>
    </div>

</body>
</html>
