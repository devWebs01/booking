<div>
    <nav class="main-nav">
        <!-- ***** Logo Start ***** -->
        <a href="https://themewagon.github.io/scholar" class="logo">
            <h1>Scholar</h1>
        </a>
        <!-- ***** Logo End ***** -->

        <!-- ***** Menu Start ***** -->
        <ul class="nav">
            <li class="scroll-to-section"><a href="/" class="{{ request()->routeIs('/') ? 'active' : '' }}">Home</a>
            </li>
            <li class="scroll-to-section"><a href="{{ route('mapping') }}"
                    class="{{ request()->routeIs('mapping') ? 'active' : '' }}">Lihat map</a></li>

            <li class="scroll-to-section"><a href="{{ route('login') }}">Login</a></li>
            <li class="scroll-to-section"><a href="{{ route('register') }}">Daftar</a></li>
        </ul>
        <a class='menu-trigger'>
            <span>Menu</span>
        </a>
        <!-- ***** Menu End ***** -->
    </nav>
</div>
