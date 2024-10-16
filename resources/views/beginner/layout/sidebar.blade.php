@php
    // Ambil nilai page dari query string atau set default ke 1
    $currentPage = request()->get('page', 1);
    // Kurangi nilai page sebesar 1, dan pastikan tidak kurang dari 1
    $previousPage = max($currentPage - 1, 1);
    // Buat URL dengan page yang sudah dikurangi
    $previousPageUrl = request()->url() . '?page=' . $previousPage;
    // Nilai untuk page berikutnya
    $nextPage = $currentPage + 1;
    $nextPageUrl = request()->url() . '?page=' . $nextPage;
@endphp
{{-- Sidebar Start --}}
<!-- Button untuk menampilkan sidebar -->
<button id="toggleSidebar" class="fixed top-5 left-0 bg-gray-800 text-white px-4 py-2 z-10">
    <i class="fa-solid fa-bars"></i>
</button>

<!-- Sidebar tersembunyi -->
<div id="sidebar"
    class="fixed top-0 left-0 h-full w-64 bg-gray-800 text-white transform -translate-x-full transition-transform duration-300 z-20">
    <div class="p-6">
        <h2 class="text-2xl font-bold mb-6">Sidebar Menu</h2>
        <ul class="space-y-4">
            <li><a href="#" class="hover:text-gray-300">Kembali Ke Beranda</a></li>
            <li><a href="#" class="hover:text-gray-300">Bantuan</a></li>
        </ul>
        {{-- Total Pages Mid --}}
        <br>
        <div id="pagesContainer" class="p-2 bg-gray-300 text-white flex gap-2 flex-wrap">
            @for ($i = 1; $i <= $fileCount; $i++)
                @php
                    // Generate URL untuk setiap halaman
                    $pageUrl = request()->url() . '?page=' . $i;
                @endphp
                <a href="{{ $pageUrl }}" class="block">
                    <div
                        class="p-2 
                @if ($i < $currentPage) bg-green-500 @endif
                @if ($i == $currentPage) bg-blue-500 @endif 
                @if ($i > $currentPage) bg-gray-400 @endif  
                text-white">
                        {{ $i }}
                    </div>
                </a>
            @endfor
        </div>

    </div>
</div>
{{-- Sidebar End --}}
