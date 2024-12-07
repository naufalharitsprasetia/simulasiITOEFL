@extends('layout.main')

@section('content')
    <div class="min-h-svh bg-third">
        <div class="px-16 font-poppins text-center py-8 max-w-7xl mx-auto">
            <h2 class="font-semibold text-2xl mb-4">DAFTAR UJIAN (LOG)</h2>
            <div class="card-wrapper flex justify-center items-center gap-8">
                <div class="card bg-white px-28 py-12 rounded-xl shadow-lg flex gap-8">
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Name of User</th>
                                <th class="px-4 py-2">Types of Exams</th>
                                <th class="px-4 py-2">Waktu Mulai</th>
                                <th class="px-4 py-2">Waktu Selesai</th>
                                <th class="px-4 py-2">Attempt Number</th>
                                <th class="px-4 py-2">Score</th>
                                <th class="px-4 py-2">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($userExams as $exam)
                                <tr class="border-b">
                                    <td class="px-4 py-2">{{ $exam->user->name }}</td>
                                    <td class="px-4 py-2">{{ $exam->exam->title }}</td>
                                    <td class="px-4 py-2">
                                        {{ \Carbon\Carbon::parse($exam->start_time)->format('d M Y H:i') }}</td>
                                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($exam->end_time)->format('d M Y H:i') }}
                                    </td>
                                    <td class="px-4 py-2">{{ $exam->attempt_number }}</td>
                                    <td class="px-4 py-2">{{ $exam->score ?? 'Belum Dinilai' }}</td>
                                    <td class="px-4 py-2">{{ $exam->is_finish ? 'Selesai' : 'Sedang Berlangsung' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
