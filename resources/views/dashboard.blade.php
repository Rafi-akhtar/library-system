@extends('layouts.admin')

@section('title', 'Katalog & Peminjaman Buku')
@section('header-title', 'Katalog & Peminjaman Buku')

@section('content')
<div class="space-y-8 bg-[#FBF7F0] min-h-screen -m-8 p-8">


    <div class="flex justify-between items-center relative py-2">
        <div class="max-w-xl">
            @auth
                <h3 class="text-3xl font-extrabold mb-2 text-[#2D3732]">Halo, {{ Auth::user()->name }}! 👋</h3>
                <p class="text-gray-600 text-sm leading-relaxed">Selamat datang di perpustakaan digital kami. Pilih buku favoritmu dan kelola peminjamanmu di sini.</p>
            @else
                <h3 class="text-3xl font-extrabold mb-2 text-[#2D3732]">Halo, Selamat Datang! 👋</h3>
                <p class="text-gray-600 text-sm leading-relaxed">Silakan jelajahi katalog buku perpustakaan digital kami. Login terlebih dahulu untuk mulai meminjam.</p>
            @endauth
        </div>
        

        <div class="hidden lg:block text-[#8FA89B]">
            <div class="bg-white/60 backdrop-blur-sm p-4 rounded-3xl border border-[#EBE3D5] shadow-sm flex items-center gap-4">
                <div class="bg-[#8FA89B] text-white p-3 rounded-2xl">
                    <i class="fa-solid fa-book-bookmark text-2xl"></i>
                </div>
                <div>
                    <span class="block text-xs font-bold text-gray-500 uppercase tracking-wider">Koleksi Buku</span>
                    <span class="text-sm font-extrabold text-[#2D3732]">Beranda</span>
                </div>
            </div>
        </div>
    </div>

    
    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-2xl text-sm font-medium flex items-center gap-2">
            <i class="fa-solid fa-circle-check text-emerald-600"></i> {{ session('success') }}
        </div>
    @endif

    
    <form action="{{ route('dashboard') }}" method="GET" class="flex items-center gap-3">
        <div class="relative flex-1">
            <span class="absolute inset-y-0 left-0 flex items-center pl-5 pointer-events-none text-gray-400">
                <i class="fa-solid fa-magnifying-glass"></i>
            </span>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul buku atau penulis..." class="w-full pl-12 pr-4 py-3.5 bg-white border border-[#EBE3D5] rounded-full text-sm text-gray-700 focus:outline-none focus:border-[#8FA89B] shadow-sm transition">
        </div>
        <button type="submit" class="bg-[#8FA89B] hover:bg-[#7D9688] text-white px-8 py-3.5 rounded-full text-sm font-semibold transition shadow-sm">
            Cari
        </button>
        @if(request('search'))
            <a href="{{ route('dashboard') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-3.5 rounded-full text-sm font-semibold transition">
                Reset
            </a>
        @endif
    </form>

  
    <div class="space-y-4 pt-2">
        <div class="flex justify-between items-center">
            <h4 class="text-lg font-bold text-[#2D3732]">Daftar Buku Tersedia</h4>
            <span class="text-xs text-gray-400">Silakan pilih buku yang ingin dipinjam</span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($books as $book)
            <div class="bg-white rounded-3xl shadow-sm border border-[#EBE3D5] overflow-hidden flex flex-col justify-between hover:shadow-md transition group pb-4">
                <div>
                 
                    <div class="h-64 w-full bg-slate-100 relative overflow-hidden flex items-center justify-center">
                        @if(!empty($book->cover))
                            <img src="{{ asset($book->cover) }}" alt="{{ $book->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        @else
                            <div class="flex flex-col items-center justify-center text-[#8FA89B]">
                                <i class="fa-solid fa-book-open text-4xl mb-2"></i>
                                <span class="text-xs text-gray-400">Tidak ada cover</span>
                            </div>
                        @endif
                

                        <span class="absolute top-3 right-3 bg-black/60 backdrop-blur-md text-white text-[10px] font-bold px-2.5 py-1 rounded-full shadow-sm">
                            Stok: {{ $book->stok }}
                        </span>
                    </div>


                    <div class="p-4 text-center">
                        <h5 class="font-bold text-gray-800 text-sm mb-1 truncate">{{ $book->judul }}</h5>
                        <p class="text-xs text-gray-400">Penulis: <span class="text-gray-600 font-medium">{{ $book->penulis ?? 'Tidak diketahui' }}</span></p>
                    </div>
                </div>

                
                <div class="px-4 flex items-center gap-2"> 
                    @auth
                        <a href="{{ url('/borrowings/create?book_id=' . $book->id) }}" class="flex-1 text-center bg-[#8FA89B] hover:bg-[#7D9688] text-white py-2 rounded-full font-medium text-xs shadow-sm transition">
                            Pinjam
                        </a>

                        @php
                            $isWishlisted = \App\Models\Wishlist::where('user_id', Auth::id())->where('book_id', $book->id)->exists();
                        @endphp

                        <button onclick="toggleWishlist(this, {{ $book->id }})" 
                            class="h-[34px] w-[34px] flex items-center justify-center rounded-full transition shadow-sm border {{ $isWishlisted ? 'bg-rose-500 text-white border-rose-500' : 'bg-gray-100 text-gray-500 border-gray-200 hover:bg-rose-50 hover:text-rose-500' }}"
                            title="Wishlist">
                            <i class="fa-solid fa-heart text-xs"></i>
                        </button>
                    @else
                        <a href="{{ route('login') }}" class="w-full text-center bg-[#8FA89B] hover:bg-[#7D9688] text-white py-2 rounded-full font-medium text-xs shadow-sm transition">
                            Login
                        </a>
                    @endauth
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12 bg-white rounded-3xl border border-[#EBE3D5] text-gray-400">
                <i class="fa-solid fa-books text-4xl mb-3 text-gray-300"></i>
                <p>Buku yang kamu cari tidak ditemukan.</p>
            </div>
            @endforelse
        </div>
    </div>

</div>
@endsection
<script>
function toggleWishlist(btn, bookId) {
    fetch(`/wishlist/toggle/${bookId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'added') {
            btn.classList.remove('bg-gray-100', 'text-gray-500', 'border-gray-200', 'hover:bg-rose-50', 'hover:text-rose-500');
            btn.classList.add('bg-rose-500', 'text-white', 'border-rose-500');
        } else {
            btn.classList.remove('bg-rose-500', 'text-white', 'border-rose-500');
            btn.classList.add('bg-gray-100', 'text-gray-500', 'border-gray-200', 'hover:bg-rose-50', 'hover:text-rose-500');
        }
    });
}
</script>