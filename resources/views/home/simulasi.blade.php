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
            <h2 class="text-xl italic font-medium">"BEGINNER / ADVANCED"</h2>
            <br><br>
            <div class="card-wrapper flex justify-center items-center gap-8">
                <div class="card bg-primary px-4 py-2 text-white rounded-lg shadow-lg">
                    <h3 class="text-lg font-semibold">Beginner EXAM</h3>
                    <br>
                    <a href="/beginner"
                        class="bg-white text-primary hover:opacity-85 rounded-lg text-xs px-1 py-2 block">Attempt now</a>
                </div>
                <div class="card bg-primary px-4 py-2 text-white rounded-lg shadow-lg">
                    <h3 class="text-lg font-semibold">Advanced EXAM</h3>
                    <br>
                    <a href="/advance"
                        class="bg-white text-primary hover:opacity-85 rounded-lg text-xs px-1 py-2 block">Attempt now</a>
                </div>
            </div>
        </div>
    </div>
@endsection
