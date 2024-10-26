@extends('layout.main')

@section('content')
    <div class="min-h-[90svh] bg-third">
        <div class="px-16 font-poppins text-center pt-24 max-w-7xl mx-auto">
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
            <h1 class="text-3xl font-semibold">PILIH JENIS UJIAN </h1>
            <br><br>
            <div class="card-wrapper flex justify-center items-center gap-8">
                @foreach ($exams as $exam)
                    <div class="card bg-primary px-4 py-2 text-white rounded-lg shadow-lg">
                        <h3 class="text-lg font-semibold">{{ $exam->title }}</h3>
                        <br>
                        <a href="/exam/{{ $exam->id }}"
                            class="bg-white text-primary hover:opacity-85 rounded-lg text-xs px-3 py-2 block">Attempt
                            now</a>
                    </div>
                @endforeach
                <div class="card bg-primary px-4 py-2 text-white rounded-lg shadow-lg">
                    <h3 class="text-lg font-semibold">Other Examination</h3>
                    <span class="text-xs text-gray-200">(not already exist)</span>
                    <a class="bg-white text-primary opacity-85 rounded-lg text-xs px-1 py-2 block mt-2">Attempt
                        now</a>
                </div>
            </div>
        </div>
    </div>
@endsection
