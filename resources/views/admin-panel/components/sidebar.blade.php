<nav class="sidebar-container">
    <div class="logo-and-navigation-container">
        <div class="logo-container">
            <img src="{{ asset('images/logo.png') }}" alt="logo">
            <h3>AdminPanel</h3>
        </div>
        <ul class="navigation-container">
            <li class="menu-item active">
                <a class="menu-link" href="">
                    <i class='bx bxs-dashboard'></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="menu-item">
                <a class="menu-link" href="">
                    <i class='bx bxs-user'></i>
                    <p>Profile</p>
                </a>
            </li>
        </ul>
    </div>
    <div class="logout-container">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">
                <i class='bx bx-log-out-circle'></i>
                <p>{{ __('Log out') }}</p>
            </button>
        </form>
    </div>
</nav>
