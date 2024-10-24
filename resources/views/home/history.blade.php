@extends('layout.main')

@section('content')
    <div class="min-h-svh bg-third">
        <div class="px-16 font-poppins text-center py-8 max-w-7xl mx-auto">
            <h2 class="font-semibold text-2xl mb-4">Riwayat Ujian</h2>
            <div class="card-wrapper flex justify-center items-center gap-8">
                <div class="card bg-white px-28 py-12 rounded-xl shadow-lg flex gap-8">
                    @if ($userExams->isEmpty())
                        <p class="text-gray-600">Belum ada ujian yang pernah diambil.</p>
                    @else
                        <table class="table-auto w-full text-left">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th class="px-4 py-2">Tanggal Ujian</th>
                                    <th class="px-4 py-2">Jam Ujian</th>
                                    <th class="px-4 py-2">Jenis Ujian</th>
                                    <th class="px-4 py-2">Percobaan Ke-</th>
                                    <th class="px-4 py-2">Skor</th>
                                    <th class="px-4 py-2">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($userExams as $exam)
                                    <tr class="border-b">
                                        <td class="px-4 py-2">{{ $exam->start_time->format('d M Y') }}</td>
                                        <td class="px-4 py-2">{{ $exam->start_time->format('H:i') }} -
                                            {{ $exam->end_time->format('H:i') }}</td>
                                        <td class="px-4 py-2">{{ $exam->exam->title }}</td>
                                        <td class="px-4 py-2">{{ $exam->attempt_number }}</td>
                                        <td class="px-4 py-2">{{ $exam->score ?? 'Belum Dinilai' }}</td>
                                        <td class="px-4 py-2">
                                            {{ $exam->end_time < now() ? 'Selesai' : 'Sedang Berlangsung' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
