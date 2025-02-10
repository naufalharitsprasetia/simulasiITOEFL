@include('layout.head')
<section class="login flex flex-col-reverse lg:flex-row h-screen bg-white">
    <!-- Left Side: Login Form -->
    <div class="login-left w-full lg:w-1/2 flex flex-col justify-center items-center p-6 lg:p-12 relative ">
        <div class="max-w-md w-full mx-auto">
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
            <!-- Logo Section -->
            <div class="mb-6 items-center">
                <div class="title flex  mb-2 items-center">
                    <a class="flex items-center justify-center w-8 h-8 mr-4 bg-primary text-white rounded-full"
                        href="/">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                    <h1 class="text-xl lg:text-3xl font-semibold pr-3 text-black">Login
                    </h1>
                </div>
                <p class="text-gray-500">Enter the Free Practice for English Test and explore exciting features waiting
                    for you! </p>
            </div>

            <form action="/login" method="POST" class="space-y-6">
                @csrf

                <!-- username_or_email Input -->
                <div class="relative">
                    <label for="username_or_email"
                        class="block text-sm lg:text-base font-medium text-gray-700 mb-2">Username
                        or
                        Email</label>
                    <input type="text" name="username_or_email" value="{{ old('username_or_email') }}" required
                        placeholder="Masukkan Username atau email"
                        class="w-full px-4 py-3 rounded-lg border text-black @error('username_or_email') bg-red-100 border-red-500 @enderror focus:border-black focus:outline-none focus:ring-2 focus:ring-primary transition-all duration-200 ease-in-out">
                    @error('username_or_email')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Input -->
                <div class="relative">
                    <label for="password"
                        class="block text-sm lg:text-base font-medium text-gray-700 mb-2">Password</label>
                    <input type="password" name="password" required placeholder="Masukkan kata sandi"
                        class="w-full px-4 py-3 rounded-lg bg-white border text-black  @error('password') border-red-500 @enderror focus:border-black focus:outline-none focus:ring-2 focus:ring-primary transition-all duration-200 ease-in-out">
                    @error('password')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Show/Hide Password Checkbox -->
                <div class="flex items-center">
                    <input type="checkbox" id="togglePasswordVisibility" onclick="togglePassword()" class="mr-2">
                    <label for="togglePasswordVisibility" class="text-sm lg:text-base text-gray-700">show
                        password</label>
                </div>

                {{-- sudah punya akun --}}
                <div class="text-sm text-center lg:text-base text-gray-700">
                    <a class="hover:text-accent transition-colors" href="{{ route('auth.addUser') }}">Don't have an
                        account?</a>
                </div>


                <!-- Login Button -->
                <div>
                    <button type="submit"
                        class="w-full bg-primary text-white py-3 px-4 rounded-lg font-semibold hover:bg-primary/90">
                        Login
                    </button>
                </div>
            </form>

        </div>
    </div>

    <!-- Right Side: Image Section -->
    <div class="login-right w-full lg:w-1/2 h-full bg-cover bg-center lg:pe-4 lg:py-4">
        <img src="{{ asset('img/exambg.jpg') }}" class="w-full h-full object-cover rounded-xl" alt="Gambar">
    </div>
</section>s

<script>
    function togglePassword() {
        const passwordField = document.querySelector('input[name="password"]');
        const checkbox = document.getElementById('togglePasswordVisibility');
        passwordField.type = checkbox.checked ? 'text' : 'password';
    }
</script>
@include('layout.footer')
