<nav>
    <div class="navbar">
        <img src="{{ asset('img/logo.webp') }}" alt="logo">
        <div class="navbar-nav">
            <a href="{{ route('dashboard') }}" class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <i class="icon fa-solid fa-shapes"></i>Dashboard
            </a>
            <a href="{{ route('report') }}" class="{{ request()->is('admin/report') ? 'active' : '' }}">
                <i class="icon fa-solid fa-folder-open"></i>Report
            </a>
            <a href="{{ route('member') }}" class="{{ request()->is('admin/member') ? 'active' : '' }}">
                <i class="icon fa-solid fa-chalkboard-user"></i>Manage Users
            </a>
            <a href="{{ route('rewards') }}" class="{{ request()->is('admin/rewards') ? 'active' : '' }}">
                <i class="icon fa-solid fa-award"></i>Manage Rewards
            </a>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="icon fa-solid fa-circle-left"></i>Log Out
            </a>
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
</nav>
