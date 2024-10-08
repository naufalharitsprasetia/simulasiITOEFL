@extends('layout.main')

@section('content')
    <section class="signup flex flex-col lg:flex-row h-screen bg-white dark:bg-black">
        <!-- Left Side: Registration Form -->
        <div class="signup-left w-full lg:w-1/2 flex flex-col justify-center items-center p-6 lg:p-12 relative">
            <div class="max-w-md w-full mx-auto">
                <!-- Logo Section -->
                <div class="mb-6 items-center">
                    <div class="title flex  mb-2 items-center">
                        <a class="flex items-center justify-center w-8 h-8 mr-4 bg-primary text-dark rounded-full"
                            href="/">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                        <h1 class="text-xl lg:text-3xl font-semibold pr-3 text-black dark:text-white">Daftar ke SIMULASI
                            TOEFL
                        </h1>
                    </div>
                    <p class="text-gray-500">Masuk ke SIMULASI TOEFL Unida Gontor dan dapatkan fitur-fitur menarik di sini.
                    </p>
                </div>

                <form action="/sign-up" method="POST" class="space-y-6">
                    @csrf

                    <!-- Grid for Input Fields -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Full Name -->
                        <div class="relative">
                            <label for="name"
                                class="block text-sm lg:text-base font-medium text-gray-700 dark:text-gray-300 mb-2">Nama
                                Lengkap</label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                placeholder="Masukkan nama lengkap"
                                class="w-full px-4 py-3 rounded-lg bg-white dark:bg-black border dark:border-zinc-600 dark:text-white @error('name') bgwhite dark:bg-red-300 @enderror focus:border-black focus:outline-none focus:ring-2 focus:ring-primary transition-all duration-200 ease-in-out">
                            @error('name')
                                <p class="texprimary dark:text-red-400 text-sm mt-2">Nama lengkap tidak valid.</p>
                            @enderror
                        </div>

                        <!-- Username -->
                        <div class="relative">
                            <label for="username"
                                class="block text-sm lg:text-base font-medium text-gray-700 dark:text-gray-300 mb-2">Nama
                                Pengguna</label>
                            <input type="text" name="username" value="{{ old('username') }}" required
                                placeholder="Masukkan nama pengguna"
                                class="w-full px-4 py-3 rounded-lg bg-white dark:bg-black border dark:border-zinc-600 dark:text-white @error('username') bgwhite dark:bg-red-300 @enderror focus:border-black focus:outline-none focus:ring-2 focus:ring-primary transition-all duration-200 ease-in-out">
                            @error('username')
                                <p class="texprimary dark:text-red-400 text-sm mt-2">Nama pengguna tidak valid.</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Email: full width input -->
                    <div class="relative">
                        <label for="email"
                            class="block text-sm lg:text-base font-medium text-gray-700 dark:text-gray-300 mb-2">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            placeholder="Masukkan email"
                            class="w-full px-4 py-3 rounded-lg bg-white dark:bg-black border dark:border-zinc-600 dark:text-white @error('email') bgwhite dark:bg-red-300 @enderror focus:border-black focus:outline-none focus:ring-2 focus:ring-primary transition-all duration-200 ease-in-out">
                        @error('email')
                            <p class="texprimary dark:text-red-400 text-sm mt-2">Email tidak valid.</p>
                        @enderror
                    </div>

                    <!-- Grid for Password Fields -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Password -->
                        <div class="relative">
                            <label for="password"
                                class="block text-sm lg:text-base font-medium text-gray-700 dark:text-gray-300 mb-2">Kata
                                Sandi</label>
                            <input type="password" id="password" name="password" required placeholder="Masukkan kata sandi"
                                class="w-full px-4 py-3 rounded-lg bg-white dark:bg-black border dark:border-zinc-600 dark:text-white @error('password') bgwhite dark:bg-red-300 @enderror focus:border-black focus:outline-none focus:ring-2 focus:ring-primary transition-all duration-200 ease-in-out">
                            @error('password')
                                <p class="texprimary dark:text-red-400 text-sm mt-2">Kata sandi tidak valid.</p>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="relative">
                            <label for="password_confirmation"
                                class="block text-sm lg:text-base font-medium text-gray-700 dark:text-gray-300 mb-2">Konfirmasi
                                Kata Sandi</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" required
                                placeholder="Konfirmasi kata sandi"
                                class="w-full px-4 py-3 rounded-lg bg-white dark:bg-black border dark:border-zinc-600 dark:text-white @error('password_confirmation') bgwhite dark:bg-red-300 @enderror focus:border-black focus:outline-none focus:ring-2 focus:ring-primary transition-all duration-200 ease-in-out">
                            @error('password_confirmation')
                                <p class="texprimary dark:text-red-400 text-sm mt-2">Kata sandi tidak cocok.</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Show/Hide Password Checkbox -->
                    <div class="flex items-center">
                        <input type="checkbox" id="togglePasswordVisibility" onclick="togglePasswordFields()"
                            class="mr-2">
                        <label for="togglePasswordVisibility"
                            class="text-sm lg:text-base text-gray-700 dark:text-gray-300">Tampilkan kata sandi</label>
                    </div>

                    <!-- Already have an account -->
                    <div class="text-center mt-6">
                        <span class="text-black dark:text-gray-300">Sudah punya akun?</span>
                        <a href="/login" class="ml-2 text-black dark:text-white font-bold hover:underline">
                            Masuk
                        </a>
                    </div>

                    <!-- Register Button -->
                    <div>
                        <button type="submit"
                            class="w-full bg-primary text-third py-3 px-4 rounded-lg font-semibold hover:bg-primary/90">
                            Daftar
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Right Side: Image Section -->
        <div class="signup-right w-full lg:w-1/2 h-full bg-cover bg-center lg:pe-4 lg:py-4">
            <img src="{{ asset('img/bg-ielts.png') }}" class="w-full h-full object-cover rounded-xl" alt="Gambar">
        </div>
    </section>

    <script>
        function togglePasswordFields() {
            const passwordField = document.getElementById('password');
            const confirmPasswordField = document.getElementById('password_confirmation');
            const checkbox = document.getElementById('togglePasswordVisibility');

            // Toggle between password and text input type
            if (checkbox.checked) {
                passwordField.type = 'text';
                confirmPasswordField.type = 'text';
            } else {
                passwordField.type = 'password';
                confirmPasswordField.type = 'password';
            }
        }
    </script>
@endsection
