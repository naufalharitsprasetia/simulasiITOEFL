@include('layout.head')
@include('sweetalert::alert')
@include('layout.navbar')
<main class="main-screen pt-[64px]">
    @yield('content')
    <button onclick="topFunction()" id="myBtnTop" title="Go to top" style="display: block">
        <i class="fa-solid fa-arrow-up fa-flip fa-xl" style="color: white;"></i>
    </button>
</main>
@include('layout.navfooter')
@include('layout.footer')
