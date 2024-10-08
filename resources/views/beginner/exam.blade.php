@include('layout.head')
<div class="min-h-svh bg-third">
    <div class="px-16 font-poppins max-w-7xl relative mx-auto">
        {{-- <h2>EXAMINATION</h2> --}}
        @if (session()->has('error'))
            <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                <div class="alert alert-error col-lg-12 mt-4" role="alert">
                    {{ session('error') }}
                </div>
            </div>
        @endif
        {{-- BUTOON --}}
        @php
            // Ambil nilai page dari query string atau set default ke 1
            $currentPage = request()->get('page', 1);
            // Kurangi nilai page sebesar 1, dan pastikan tidak kurang dari 1
            $previousPage = max($currentPage - 1, 1);
            // Buat URL dengan page yang sudah dikurangi
            $previousPageUrl = request()->url() . '?page=' . $previousPage;
        @endphp
        <a href="{{ $previousPageUrl }}" class="absolute top-5 left-5 rounded-lg px-2 py-2 bg-primary text-white">
            Back
        </a>
        {{-- TOTAL PAGES MID --}}
        <div class="absolute top-5 left-1/2 transform -translate-x-1/2 rounded-lg p-2 bg-primary text-white flex gap-2">
            @for ($i = 1; $i <= $fileCount; $i++)
                <div
                    class="p-2 
            @if ($i < $currentPage) bg-green-500 @endif
            @if ($i == $currentPage) bg-blue-500 @endif 
            @if ($i > $currentPage) bg-gray-400 @endif  
            text-white">
                    {{ $i }}
                </div>
            @endfor
        </div>
        {{-- END TOTAL PAGES MID --}}
        {{-- Times --}}
        <div class="absolute top-5 right-5 rounded-lg px-2 py-2 bg-primary text-white">Time Left : <span
                id="countdown"></span></div>
        {{-- NEXT PAGE --}}
        {{-- CORE --}}
        <form id="examForm" method="POST" action="{{ route('exam.submit') }}">
            @csrf
            <input type="hidden" name="pageNow" value="{{ $page }}">
            <div id="content">
                @php
                    $halaman = 'beginner.partials.page' . $page;
                @endphp
                @include($halaman)
            </div>
            <button type="submit" class="bg-primary text-white rounded-lg px-12 py-2 shadow-md mt-4 inline-block">
                Next
            </button>
        </form>

    </div>
</div>
{{-- AJAX --}}
<script></script>
{{-- Membersihkan Local Storage Yang Tersimpan setelah submit --}}
<script></script>

{{-- TIMER --}}
<script>
    var time = localStorage.getItem('remainingTime') || 7200; // 2 hours in seconds

    function formatTime(seconds) {
        var hours = Math.floor(seconds / 3600); // Hitung jam
        var minutes = Math.floor((seconds % 3600) / 60); // Hitung menit
        var secs = seconds % 60; // Hitung detik

        // Tambahkan leading zero jika kurang dari 10
        hours = hours < 10 ? '0' + hours : hours;
        minutes = minutes < 10 ? '0' + minutes : minutes;
        secs = secs < 10 ? '0' + secs : secs;

        return hours + ':' + minutes + ':' + secs; // Format waktu hh:mm:ss
    }

    var countdown = setInterval(function() {
        if (time <= 0) {
            clearInterval(countdown);
            document.getElementById('examForm').submit(); // Submit otomatis saat waktu habis
        }

        // Tampilkan waktu yang tersisa dalam format hh:mm:ss
        document.getElementById('countdown').innerHTML = formatTime(time);

        time--;
        localStorage.setItem('remainingTime', time); // Simpan waktu tersisa ke localStorage
    }, 1000);
</script>
@include('layout.footer')
