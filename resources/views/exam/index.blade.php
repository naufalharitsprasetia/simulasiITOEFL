@include('layout.head')
<div class="min-h-svh bg-third">
    <div class="px-16 font-poppins text-center py-20 max-w-7xl mx-auto">
        <div class="card-wrapper flex justify-center items-center gap-8">
            <div class="card bg-white px-28 py-12 rounded-xl shadow-lg flex gap-8">
                @if (session()->has('error'))
                    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                        <div class="alert alert-error col-lg-12 mt-4" role="alert">
                            {{ session('error') }}
                        </div>
                    </div>
                @endif
                <img src="/img/examination.png" class="" alt="">
                <div class="content-center">
                    <!-- Tempat tombol yang akan berubah tergantung ada atau tidaknya remainingTime -->
                    @if ($masihBisa)
                        {{-- <p class="text-lg mb-4">Waktu Tersisa: <strong>${formatTime(remainingTime)}</strong></p> --}}
                        <a href="/continue-exam"
                            class="text-white bg-primary inline-block hover:opacity-85 rounded-xl text-xs px-6 py-3 mr-4">LANJUTKAN</a>
                        <a href="/reset-exam"
                            class="text-white bg-red-500 inline-block hover:opacity-85 rounded-xl text-xs px-6 py-3">AMBIL
                            ULANG</a>
                    @else
                        <a href="/exam-start/{{ $exam->id }}"
                            class="text-white bg-primary inline-block hover:opacity-85 rounded-xl text-xs px-6 py-3">START
                            EXAM</a>
                    @endif
                    {{-- <div id="examAction"></div> --}}
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Fungsi untuk memformat waktu ke dalam format hh:mm:ss
    function formatTime(seconds) {
        var hours = Math.floor(seconds / 3600);
        var minutes = Math.floor((seconds % 3600) / 60);
        var secs = seconds % 60;

        hours = hours < 10 ? '0' + hours : hours;
        minutes = minutes < 10 ? '0' + minutes : minutes;
        secs = secs < 10 ? '0' + secs : secs;

        return hours + ':' + minutes + ':' + secs;
    }
</script>

@include('layout.footer')
