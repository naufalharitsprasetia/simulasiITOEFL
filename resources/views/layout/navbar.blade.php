<nav class="z-50 w-full fixed bg-primary ">
    <div class="mx-auto max-w-7xl px-2 lg:px-6 lg:px-8">
        <div class="relative flex h-16 items-center justify-between">
            <div class="flex flex-1 items-center justify-center lg:items-stretch lg:justify-start">
                <div class="flex flex-shrink-0 items-center ml-28">
                    <h2 class="mx-4 text-third font-poppins font-semibold text-lg">SIMULASI TOEFL</h2>
                </div>
                <div class="hidden lg:ml-6 lg:block">
                    <div class="ml-10 flex gap-6 items-center">
                        <a href="/"
                            class="rounded-md px-3 py-2 text-sm font-medium {{ $active == 'beranda' ? 'bg-third text-gray-900' : 'text-third hover:bg-third hover:text-gray-900' }} ">Beranda</a>
                        @auth
                            <a href="/simulasi"
                                class="rounded-md px-3 py-2 text-sm font-medium {{ $active == 'simulasi' ? 'bg-third text-gray-900' : 'text-third hover:bg-third hover:text-gray-900' }}">Simulasi</a>
                            <a href="/history"
                                class="rounded-md px-3 py-2 text-sm font-medium {{ $active == 'history' ? 'bg-third text-gray-900' : 'text-third hover:bg-third hover:text-gray-900' }}">Riwayat</a>
                            <form action="/logout" id="logout-form" method="post">
                                @csrf
                                <button type="button" onclick="confirmLogout()"
                                    class="rounded-md px-3 py-2 text-sm font-medium {{ $active == 'logout' ? 'bg-third text-gray-900' : 'text-third hover:bg-third hover:text-gray-900' }}">Logout</button>
                            </form>
                            <p class="text-third">Welcome Back, {{ auth()->user()->name }} !</p>
                        @else
                            <a href="/login"
                                class="rounded-md px-3 py-2 text-sm font-medium {{ $active == 'login' ? 'bg-third text-gray-900' : 'text-third hover:bg-third hover:text-gray-900' }}">Login</a>
                            <a href="/register"
                                class="rounded-md px-3 py-2 text-sm font-medium {{ $active == 'register' ? 'bg-third text-gray-900' : 'text-third hover:bg-third hover:text-gray-900' }}">Register</a>
                        @endauth
                    </div>
                </div>
                <!-- SMALL NAV-->
                <div class="-mr-2 flex lg:hidden justify-end">
                    <!-- Mobile menu button -->
                    <button type="button"
                        class="relative inline-flex items-center justify-center my-3 rounded-md bg-slate-100 p-2 text-gray-800 hover:bg-slate-200 hover:text-slate-700 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                        aria-controls="mobile-menu" aria-expanded="false">
                        <span class="absolute -inset-0.5" id="mobile-hamburger"></span>
                        <span class="sr-only">Open main menu</span>
                        <!-- Menu open: "hidden", Menu closed: "block" -->
                        {{-- : --}}
                        <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                        <!-- Menu open: "block", Menu closed: "hidden" -->
                        {{-- X --}}
                        <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    {{-- Dropdown small nav --}}
    <div class="lg:hidden hidden absolute bg-gray-100 z-60 w-[80%] right-0 mx-[1rem] rounded-md shadow-xl"
        id="mobile-menu">
        <div class="space-y-1 px-2 pb-3 pt-2 lg:px-3">
            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-third hover:text-white" -->
            <a href="/"
                class="block rounded-md px-3 py-2 text-base font-medium  {{ $active == 'beranda' ? 'bg-gray-900 text-white' : 'text-gray-500 hover:bg-third hover:text-white' }}">Beranda</a>
            <a href="/blog"
                class="block rounded-md px-3 py-2 text-base font-medium {{ $active == 'blog' ? 'bg-gray-900 text-white' : 'text-gray-500 hover:bg-gray-Press Releasehover:text-white' }}">Press
                Release</a>
            <a href="/departement"
                class="block rounded-md px-3 py-2 text-base font-medium {{ $active == 'departement' ? 'bg-gray-900 text-white' : 'text-gray-500 hover:bg-third hover:text-white' }}">Departemen</a>
            <a href="/about"
                class="block rounded-md px-3 py-2 text-base font-medium {{ $active == 'about' ? 'bg-gray-900 text-white' : 'text-gray-500 hover:bg-third hover:text-white' }}">Tentang</a>
            <a href="/lainnya"
                class="block rounded-md px-3 py-2 text-base font-medium {{ $active == 'lainnya' ? 'bg-gray-900 text-white' : 'text-gray-500 hover:bg-third hover:text-white' }}">Halaman
                Lainnya</a>
        </div>
        @auth
            <div class="border-t border-third pb-3 pt-4">
                <div class="flex items-center px-5">
                    <div class="flex-shrink-0">
                        <img class="h-10 w-10 rounded-full" src="/img/avatar.jpg" alt="">
                    </div>
                    <div class="ml-3">
                        <div class="text-base font-medium leading-none text-gray-500">Nama</div>
                        <div class="text-sm font-medium leading-none text-gray-500">Email</div>
                    </div>
                </div>
                <div class="mt-3 space-y-1 px-2">
                    <a href="/dashboard"
                        class="block rounded-md px-3 py-2 text-base font-medium {{ $active == 'dashboard' ? 'bg-third text-white' : 'text-gray-500 hover:bg-third hover:text-white' }}"><i
                            class="fa-solid fa-table-columns"></i> Dashboard
                        Admin</a>
                    <form action="/logout" method="POST" id="logout-form">
                        @csrf
                        <button type="button" onclick="confirmLogout()"
                            class="block rounded-md px-3 py-2 text-base font-medium text-gray-500 hover:bg-third hover:text-white"
                            role="menuitem" tabindex="-1" id="user-menu-item-2"><i
                                class="fa-solid fa-right-from-bracket"></i> Sign out</button>
                    </form>
                </div>
            </div>
        @endauth
    </div>
</nav>
