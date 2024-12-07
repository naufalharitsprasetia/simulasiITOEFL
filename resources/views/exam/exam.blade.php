@include('layout.head')
<div class="min-h-svh bg-third relative">
    @include('exam.layout.sidebar')
    <div id="mainContent" class="px-16 font-poppins max-w-7xl relative mx-auto transition-all duration-300">
        @if (session()->has('error'))
            <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                <div class="alert alert-error col-lg-12 mt-4" role="alert">
                    {{ session('error') }}
                </div>
            </div>
        @endif
        @php
            $currentPage = request()->get('page', 1);
            $previousPage = max($currentPage - 1, 1);
            $previousPageUrl = request()->url() . '?page=' . $previousPage;
            $nextPage = $currentPage + 1;
            $nextPageUrl = request()->url() . '?page=' . $nextPage;
        @endphp

        {{-- Time Left --}}
        <div class="absolute top-5 right-5 rounded-lg px-2 py-2 bg-primary text-white">Time Left: <span
                id="countdown"></span></div>
        {{-- Form Ujian --}}
        <form id="examForm" method="POST" action="{{ route('exam.submit') }}">
            @csrf
            <input type="hidden" name="pageNow" value="{{ $currentPage }}">
            <input type="hidden" name="user_exam_id" value="{{ $user_exam_id }}">
            <div id="content">
                @php
                    $halaman = 'exam.' . $idExam . '.page' . $currentPage;
                @endphp
                @include($halaman)
            </div>

            {{-- Tampilkan tombol Submit di halaman terakhir --}}
            <div class="flex justify-center mx-auto">
                @if ($currentPage == $fileCount)
                    <input type="hidden" name="finish" value="true" id="finishInput">
                    <button type="submit"
                        class="bg-primary text-white mb-5 rounded-lg px-12 py-2 shadow-md mt-4 inline-block">
                        Submit
                    </button>
                @else
                    {{-- Tampilkan tombol Next jika bukan halaman terakhir --}}
                    <input type="hidden" name="finish" value="false" id="finishInput">
                    <button type="submit"
                        class="bg-primary text-white mb-5 rounded-lg px-12 py-2 shadow-md mt-4 inline-block">
                        Next
                    </button>
                @endif
            </div>
        </form>
    </div>
</div>

{{-- Timer Script --}}
<script>
    var time = {{ $remainingTime }}; // Ambil waktu tersisa dari variabel yang dikirim dari controller

    function formatTime(seconds) {
        var hours = Math.floor(seconds / 3600);
        var minutes = Math.floor((seconds % 3600) / 60);
        var secs = seconds % 60;
        hours = hours < 10 ? '0' + hours : hours;
        minutes = minutes < 10 ? '0' + minutes : minutes;
        secs = secs < 10 ? '0' + secs : secs;
        return hours + ':' + minutes + ':' + secs;
    }

    var countdown = setInterval(function() {
        if (time <= 0) {
            clearInterval(countdown);
            document.getElementById('finishInput').value = 'true';
            document.getElementById('examForm').submit();
        }
        document.getElementById('countdown').innerHTML = formatTime(time);
        time--;
    }, 1000);
</script>
<script>
    // Sidebar Toggle Script
    const toggleSidebar = document.getElementById('toggleSidebar');
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent');
    const pagesContainer = document.getElementById('pagesContainer');

    function closeSidebar() {
        sidebar.classList.add('-translate-x-full');
        mainContent.classList.remove('pl-64'); // Reset kontainer saat sidebar disembunyikan
    }

    // Ketika tombol toggle diklik, tampilkan/ sembunyikan sidebar
    toggleSidebar.addEventListener('click', function(event) {
        sidebar.classList.toggle('-translate-x-full');
        mainContent.classList.toggle('pl-64'); // Pindahkan kontainer saat sidebar muncul
        event.stopPropagation(); // Hentikan event agar tidak tersebar ke elemen lain
    });

    // Event listener untuk menutup sidebar saat klik di luar elemen sidebar
    document.addEventListener('click', function(event) {
        if (!sidebar.contains(event.target) && !toggleSidebar.contains(event.target)) {
            closeSidebar();
        }
    });
</script>


@include('layout.footer')
