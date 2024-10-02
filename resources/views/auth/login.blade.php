@include('auth.layouts.header')

<section class="login flex flex-col-reverse lg:flex-row h-screen bg-white dark:bg-ireng">
    <!-- Left Side: Login Form -->
    <div class="login-left w-full lg:w-1/2 flex flex-col justify-center items-center p-6 lg:p-12 relative ">
        <div class="max-w-md w-full mx-auto">
            <!-- Logo Section -->
            <div class="mb-6 items-center">
                <div class="title flex  mb-2 items-center">
                    <a class="flex items-center justify-center w-8 h-8 mr-4 bg-accent text-black dark:text-white rounded-full" href="/">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                    <h1 class="text-xl lg:text-3xl font-semibold pr-3 text-black dark:text-white">Masuk ke Agriconnect</h1>
                </div>
                <p class="text-gray-500">Masuk ke AGRICONNECT dan dapatkan fitur-fitur menarik di sini.</p>
            </div>

            <form action="/login" method="POST" class="space-y-6">
                @csrf
            
                <!-- Email/Username Input -->
                <div class="relative">
                    <label for="email"
                        class="block text-sm lg:text-base font-medium text-gray-700 dark:text-gray-300 mb-2">Email/Username</label>
                    <input type="text" name="username_or_email" value="{{ old('username_or_email') }}" required
                        placeholder="Masukkan email atau username"
                        class="w-full px-4 py-3 rounded-lg dark:bg-ireng border dark:border-zinc-600 text-black dark:text-white @error('username_or_email') bg-red-100 border-red-500 @enderror focus:border-black focus:outline-none focus:ring-2 focus:ring-accent transition-all duration-200 ease-in-out">
                    @error('username_or_email')
                        <p class="text-red-500 dark:text-red-400 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>
            
                <!-- Password Input -->
                <div class="relative">
                    <label for="password"
                        class="block text-sm lg:text-base font-medium text-gray-700 dark:text-gray-300 mb-2">Kata Sandi</label>
                    <input type="password" name="password" required placeholder="Masukkan kata sandi"
                        class="w-full px-4 py-3 rounded-lg bg-white border dark:border-zinc-600 dark:bg-ireng text-black dark:text-white @error('password') border-red-500 @enderror focus:border-black focus:outline-none focus:ring-2 focus:ring-accent transition-all duration-200 ease-in-out">
                    @error('password')
                        <p class="text-red-500 dark:text-red-400 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>
            
                <!-- Show/Hide Password Checkbox -->
                <div class="flex items-center">
                    <input type="checkbox" id="togglePasswordVisibility" onclick="togglePassword()" class="mr-2">
                    <label for="togglePasswordVisibility"
                        class="text-sm lg:text-base text-gray-700 dark:text-gray-300">Tampilkan kata sandi</label>
                </div>

                {{-- sudah punya akun --}}
                <div class="text-sm text-center lg:text-base text-gray-700 dark:text-gray-300">
                    <a class="hover:text-accent transition-colors" href="{{ route('auth.addUser') }}">Belum punya akun?</a>
                </div>
            
                <!-- Login Button -->
                <div>
                    <button type="submit"
                        class="w-full bg-accent text-black dark:text-white py-3 px-4 rounded-lg font-semibold hover:bg-accent/90">
                        Masuk
                    </button>
                </div>
            </form>
            
        </div>
    </div>

    <!-- Right Side: Image Section -->
    <div class="login-right w-full lg:w-1/2 h-full bg-cover bg-center lg:pe-4 lg:py-4">
        <img src="{{ asset('img/auth/bg-auth.webp') }}"
            class="w-full h-full object-cover rounded-xl" alt="Gambar">
    </div>
</section>

<script>
    function togglePassword() {
        const passwordField = document.querySelector('input[name="password"]');
        const checkbox = document.getElementById('togglePasswordVisibility');
        passwordField.type = checkbox.checked ? 'text' : 'password';
    }
</script>

@include('auth.layouts.footer')
