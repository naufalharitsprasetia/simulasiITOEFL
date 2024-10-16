@include('layout.head')
<div class="min-h-svh bg-third">
    <div class="px-16 font-poppins text-center py-20 max-w-7xl mx-auto">
        <div class="card-wrapper flex justify-center items-center gap-8">
            <div class="card bg-white px-28 py-12 rounded-xl shadow-lg flex gap-8">
                <img src="/img/examination.png" class="" alt="">
                <div class="content-center">
                    <!-- Tempat tombol yang akan berubah tergantung ada atau tidaknya remainingTime -->
                    <div id="examAction"></div>
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

    // Periksa apakah ada remainingTime di localStorage
    var remainingTime = localStorage.getItem('remainingTime');
    var examActionDiv = document.getElementById('examAction');

    if (remainingTime) {
        // Jika ada remainingTime, tampilkan waktu tersisa dan dua tombol (Lanjutkan, Ambil Ulang)
        examActionDiv.innerHTML = `
            <p class="text-lg mb-4">Waktu Tersisa: <strong>${formatTime(remainingTime)}</strong></p>
            <button onclick="continueExam()" class="text-white bg-primary inline-block hover:opacity-85 rounded-xl text-xs px-6 py-3 mr-4">LANJUTKAN</button>
            <button onclick="resetExam()" class="text-white bg-red-500 inline-block hover:opacity-85 rounded-xl text-xs px-6 py-3">AMBIL ULANG</button>
        `;
    } else {
        // Jika tidak ada remainingTime, tampilkan tombol START EXAM
        examActionDiv.innerHTML = `
            <button onclick="startExam()" class="text-white bg-primary inline-block hover:opacity-85 rounded-xl text-xs px-6 py-3">START EXAM</button>
        `;
    }

    // Fungsi untuk memulai ujian (reset waktu)
    function startExam() {
        localStorage.removeItem('remainingTime'); // Hapus waktu yang tersimpan
        window.location.href = "/beginner/exam"; // Arahkan ke halaman exam
    }

    // Fungsi untuk melanjutkan ujian tanpa reset
    function continueExam() {
        window.location.href = "/beginner/exam"; // Arahkan ke halaman exam
    }

    // Fungsi untuk memulai ulang ujian (menghapus waktu tersimpan)
    function resetExam() {
        localStorage.removeItem('remainingTime'); // Hapus waktu yang tersimpan
        window.location.href = "/beginner/exam"; // Arahkan ke halaman exam dari awal
    }
</script>

@include('layout.footer')
