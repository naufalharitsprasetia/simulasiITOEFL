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
                <div class="content-center">
                    <h2 class="font-semibold text-2xl">Your Answer :</h2>
                    <br>
                    <div class="flex gap-4">
                        <div class="section2 bg-gray-100 rounded-lg p-2">
                            <h2 class="text-xl font-semibold">Section 2</h2>
                            <ul>
                                @foreach ($section2AnswersArray as $jawaban)
                                    <li class="{{ $jawaban['is_correct'] ? 'text-green-600' : 'text-red-600' }}">
                                        Jawaban No.{{ $loop->iteration }}: {{ $jawaban['answer'] }}
                                        ({{ $jawaban['is_correct'] ? 'benar' : 'salah' }})
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="section3 bg-gray-100 rounded-lg p-2">
                            <h2 class="text-xl font-semibold">Section 3</h2>
                            <ul>
                                @foreach ($section3AnswersArray as $jawaban)
                                    <li class="{{ $jawaban['is_correct'] ? 'text-green-600' : 'text-red-600' }}">
                                        Jawaban No.{{ $loop->iteration }}: {{ $jawaban['answer'] }}
                                        ({{ $jawaban['is_correct'] ? 'benar' : 'salah' }})
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <br>
                    <a href="/show-grade" class="bg-primary text-third px-2 py-2 rounded-md hover:opacity-85">Lihat
                        Nilai</a>

                </div>
            </div>
        </div>
    </div>
</div>

@include('layout.footer')
