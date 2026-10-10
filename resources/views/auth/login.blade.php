<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Library</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-[#FBF7F0] antialiased flex items-center justify-center h-screen">

    <div class="w-full max-w-md p-8 bg-white/80 backdrop-blur-md rounded-2xl shadow-md border border-[#EBE3D5]">
        
        <div class="text-center mb-6">
            <div class="inline-flex bg-[#8FA89B] text-white p-3 rounded-2xl shadow-sm mb-3">
                <i class="fa-solid fa-book-open text-2xl"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Library</h2>
            <p class="text-sm text-gray-500">Silakan masuk ke akun Anda</p>
        </div>

        @if (session('status'))
            <div class="mb-4 text-sm font-medium text-emerald-600 text-center">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <label class="block text-xs font-bold uppercase tracking-wider text-gray-600 mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" 
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-xl text-gray-900 focus:outline-none focus:border-[#8FA89B] focus:ring-1 focus:ring-[#8FA89B] transition text-sm">
                @error('email')
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-xs font-bold uppercase tracking-wider text-gray-600 mb-2">Password</label>
                <input type="password" name="password" required autocomplete="current-password" 
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-xl text-gray-900 focus:outline-none focus:border-[#8FA89B] focus:ring-1 focus:ring-[#8FA89B] transition text-sm">
                @error('password')
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex items-center justify-between mb-6 text-sm">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="remember" class="rounded border-gray-300 text-[#8FA89B] focus:ring-[#8FA89B]">
                    <span class="text-gray-600">Ingat saya</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-emerald-700 hover:underline font-medium text-xs">
                        Lupa password?
                    </a>
                @endif
            </div>

            <button type="submit" class="w-full py-3 bg-[#8FA89B] hover:bg-[#7e978a] text-white font-bold rounded-xl shadow-sm transition duration-200">
                MASUK
            </button>

            @if (Route::has('register'))
                <p class="text-center text-sm text-gray-600 mt-6">
                    Belum punya akun? 
                    <a href="{{ route('register') }}" class="text-emerald-700 font-bold hover:underline">Daftar sekarang</a>
                </p>
            @endif
        </form>

    </div>

</body>
</html>