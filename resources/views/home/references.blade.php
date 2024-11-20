@extends('layout.main')

@section('content')
    <div class="min-h-[90svh] bg-third">
        <div class="px-16 font-poppins text-center py-16 max-w-7xl mx-auto">
            @if (session()->has('success'))
                <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                    <div class="alert alert-success col-lg-12 mt-4" role="alert">
                        {{ session('success') }}
                    </div>
                </div>
            @endif
            @if ($errors->any())
                <div class="mx-auto max-w-7xl">
                    <div class="alert alert-error col-lg-12 mt-4" role="alert">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                </div>
            @endif
            <div class="references-wrapper text-center">
                <h1 class="font-bold text-4xl mb-8 text-center">REFERENCES</h1>
                <div class="referensi-practice-1">
                    {{-- <h4 class="font-semibold text-lg">Practice 1 :</h4> --}}
                    <ul class="">
                        <li class="">- Cmedia. (2020). Practice Test TOEFL. Penerbit Cmedia.
                            https://www.penerbitcmedia.com</li>
                        <li class="">- Educational Testing Service. (2020). TOEFL ITP Practice Tests. Princeton, NJ:
                            Educational
                            Testing Service.</li>
                        <li class="">- Kaplan Test Prep. (2021). TOEFL ITP Preparation Guide. Kaplan.
                            https://www.kaptest.com/toefl-itp-prep</li>
                        <li class="">- Phillips, D. (2016). Longman Preparation Course for the TOEFL ITP Test. Pearson
                            Education.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
