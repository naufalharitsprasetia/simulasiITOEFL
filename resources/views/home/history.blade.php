@extends('layout.main')

@section('content')
    <div class="min-h-svh bg-third">
        <div class="px-16 font-poppins text-center py-8 max-w-7xl mx-auto">
            <h2 class="font-semibold text-2xl mb-4">Exam History</h2>
            <div class="card-wrapper flex justify-center items-center gap-8">
                <div class="card bg-white px-28 py-12 rounded-xl shadow-lg flex gap-8">
                    @if ($userExams->isEmpty())
                        <p class="text-gray-600">No exams have ever been taken.</p>
                    @else
                        <table class="table-auto w-full text-left">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th class="px-4 py-2">Exam Date</th>
                                    <th class="px-4 py-2">Exam Time</th>
                                    <th class="px-4 py-2">Types of Exams</th>
                                    <th class="px-4 py-2">Trial No.</th>
                                    <th class="px-4 py-2">Score</th>
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

                                        @if ($exam->is_finish)
                                            <td class="px-4 py-2 text-green-500">
                                                Finished
                                            </td>
                                        @else
                                            <td class="px-4 py-2">
                                                <div class="flex justify-center items-center">
                                                    <h3 class="text-yellow-500"> Ongoing</h3>
                                                    <a href="{{ route('exam.exam', ['user_exam_id' => $exam->id]) }}"
                                                        class="bg-blue-500 text-white p-2 hover:underline ml-2">Continue</a>
                                                </div>
                                            </td>
                                        @endif
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
