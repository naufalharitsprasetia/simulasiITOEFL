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
            <h1 class="text-3xl font-semibold">Selamat Datang Di Website SIMULASI TOEFL </h1>
            <h2 class="text-xl italic font-medium">"Your Path to TOEFL Success Starts Here!"</h2>
            @guest
                <div class="mt-8">
                    <a href="/login" class="px-3 py-2 bg-primary text-white">Login</a>
                    <a href="/register" class="px-3 py-2 text-primary">Register</a>
                </div>
            @else
                <div class="mt-8">
                    <a href="/simulasi" class="px-3 py-2 bg-primary text-white">Go To Exam</a>
                </div>
            @endguest
        </div>
    </div>
@endsection
