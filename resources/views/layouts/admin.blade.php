<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - E-Library</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-[#FBF7F0] antialiased">
    <div class="flex h-screen overflow-hidden">
        
        
        <aside class="w-64 bg-[#8FA89B] text-white flex flex-col shadow-sm h-screen sticky top-0 flex-shrink-0 justify-between">
            <div>
                
                <div class="flex items-center gap-3 px-6 py-5 bg-black/10">
                    <div class="bg-white/20 p-2 rounded-lg text-white">
                        <i class="fa-solid fa-book-open text-xl"></i>
                    </div>
                    <span class="text-xl font-bold tracking-wide text-gray-900">Library</span>
                </div>

                
                <nav class="px-4 py-6 space-y-2 overflow-y-auto">
                    <a href="/dashboard" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-800 font-medium hover:bg-white/30 transition {{ request()->is('dashboard') ? 'bg-white/40 font-semibold shadow-sm' : '' }}">
                        <i class="fa-solid fa-book-bookmark w-5 text-gray-700"></i> Katalog & Pinjam
                    </a>


                    @auth
                    <a href="{{ route('borrowings.history') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-800 font-medium hover:bg-white/30 transition {{ request()->is('borrowings*') || request()->is('my-borrowings*') ? 'bg-white/40 font-semibold shadow-sm' : '' }}">
                        <i class="fa-solid fa-clock-rotate-left w-5 text-gray-700"></i> Riwayat Pinjam
                    </a>

                    <a href="{{ route('wishlist.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-800 font-medium hover:bg-white/30 transition {{ request()->is('wishlist*') ? 'bg-white/40 font-semibold shadow-sm' : '' }}">
                        <i class="fa-solid fa-heart w-5 text-gray-700"></i> Wishlist Saya
                    </a>
                    @endauth

                    @auth
                        @if(Auth::user()->email == 'admin1@gmail.com' || (isset(Auth::user()->role) && Auth::user()->role == 'admin'))
                            <div class="pt-4 pb-2 px-4 text-[10px] uppercase tracking-wider text-gray-700 font-bold">Menu Admin</div>

                            <a href="/books" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-800 font-medium hover:bg-white/30 transition {{ request()->is('books*') ? 'bg-white/40 font-semibold shadow-sm' : '' }}">
                                <i class="fa-solid fa-book w-5 text-gray-700"></i> Kelola Buku
                            </a>
                            <a href="/sirkulasi" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-800 font-medium hover:bg-white/30 transition {{ request()->is('sirkulasi*') ? 'bg-white/40 font-semibold shadow-sm' : '' }}">
                                <i class="fa-solid fa-right-left w-5 text-gray-700"></i> Sirkulasi Pinjam
                            </a>
                            <a href="/members" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-800 font-medium hover:bg-white/30 transition {{ request()->is('members*') ? 'bg-white/40 font-semibold shadow-sm' : '' }}">
                                <i class="fa-solid fa-users w-5 text-gray-700"></i> Anggota
                            </a>
                            <a href="/reports" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-800 font-medium hover:bg-white/30 transition {{ request()->is('reports*') ? 'bg-white/40 font-semibold shadow-sm' : '' }}">
                                <i class="fa-solid fa-file-lines w-5 text-gray-700"></i> Laporan
                            </a>
                        @endif
                    @endauth
                </nav>
            </div>

        
            <div class="p-3 m-3 bg-black/15 backdrop-blur-md rounded-xl border border-white/10 flex items-center justify-between shadow-sm">
                @auth
                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-2.5 overflow-hidden group flex-1 mr-2">
                        <div class="h-9 w-9 rounded-full bg-emerald-600 flex items-center justify-center font-bold text-white text-sm shrink-0">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div class="overflow-hidden">
                            <p class="text-xs font-bold text-white truncate group-hover:text-emerald-300 transition">{{ Auth::user()->name }}</p>
                            <p class="text-[10px] text-emerald-300 font-medium flex items-center gap-1">
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-400 animate-pulse"></span> Online
                            </p>
                        </div>
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-white/70 hover:text-red-400 transition p-1 shrink-0" title="Logout">
                            <i class="fa-solid fa-right-from-bracket"></i>
                        </button>
                    </form>
                @else
                    <div class="flex items-center gap-2.5 overflow-hidden flex-1 mr-2">
                        <div class="h-9 w-9 rounded-full bg-white/25 flex items-center justify-center font-bold text-white text-sm shrink-0">
                            G
                        </div>
                        <div class="overflow-hidden">
                            <p class="text-xs font-bold text-white truncate">Guest</p>
                            <p class="text-[10px] text-white/70 font-medium">Tamu Perpustakaan</p>
                        </div>
                    </div>

                    <a href="{{ route('login') }}" class="text-emerald-300 hover:text-white transition p-1 text-xs font-semibold shrink-0" title="Login">
                        <i class="fa-solid fa-right-to-bracket"></i> Login
                    </a>
                @endauth
            </div>
        </aside>
        
        
        <div class="flex-1 flex flex-col overflow-hidden bg-[#FBF7F0]">
            <header class="h-16 bg-white/70 backdrop-blur-md border-b border-[#EBE3D5] flex items-center justify-between px-8 shadow-sm sticky top-0 z-20">
                <h1 class="text-xl font-bold text-gray-800">@yield('header-title')</h1>
                <span class="bg-emerald-50 text-emerald-700 px-3 py-1 rounded-full font-medium border border-emerald-200 text-sm">
                    Sistem Informasi Perpustakaan
                </span>
            </header>

            <main class="flex-1 overflow-y-auto p-8">
                @yield('content')
            </main>
        </div>

    </div>
</body>
</html>