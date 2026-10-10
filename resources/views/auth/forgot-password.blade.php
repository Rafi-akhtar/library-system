<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password Library</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-[#FBF7F0] antialiased flex items-center justify-center h-screen">

    <div class="w-full max-w-md p-8 bg-white/80 backdrop-blur-md rounded-2xl shadow-md border border-[#EBE3D5]">
        
        <div class="text-center mb-6">
            <div class="inline-flex bg-[#8FA89B] text-white p-3 rounded-2xl shadow-sm mb-3">
                <i class="fa-solid fa-key text-2xl"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Lupa Password</h2>
            <p class="text-xs text-gray-500 mt-2 px-2">
                Masukkan email Anda, dan kami akan mengirimkan tautan reset password untuk masuk kembali ke akun Anda.
            </p>
        </div>

        @if (session('status'))
            <div class="mb-4 text-sm font-medium text-emerald-600 text-center bg-emerald-50 p-3 rounded-xl border border-emerald-200">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-6">
                <label class="block text-xs font-bold uppercase tracking-wider text-gray-600 mb-2">Masukkan Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus 
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-xl text-gray-900 focus:outline-none focus:border-[#8FA89B] focus:ring-1 focus:ring-[#8FA89B] transition text-sm">
                @error('email')
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="w-full py-3 bg-[#8FA89B] hover:bg-[#7e978a] text-white font-bold rounded-xl shadow-sm transition duration-200 text-sm">
                RESET PASSWORD
            </button>

            <p class="text-center text-sm text-gray-600 mt-6">
                Back? 
                <a href="{{ route('login') }}" class="text-emerald-700 font-bold hover:underline">Masuk di sini</a>
            </p>
        </form>

    </div>

</body>
</html>