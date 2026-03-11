<style>
    .nav-menu {
        display: flex;
        list-style: none;
        gap: 2rem;
        align-items: center;
        margin: 0;
        padding: 0;
    }
    
    .nav-menu a {
        text-decoration: none;
        color: #333;
        font-weight: 500;
        transition: color 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }
    
    .nav-menu a:hover,
    .nav-menu a.active {
        color: #22c55e;
    }
    
    /* Dropdown Menu Styles */
    .nav-menu .dropdown {
        position: relative;
    }
    
    .nav-menu .dropdown > a {
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }
    
    .nav-menu .dropdown .dropdown-icon {
        transition: transform 0.3s ease;
    }
    
    .nav-menu .dropdown:hover .dropdown-icon {
        transform: rotate(180deg);
    }
    
    .nav-menu .dropdown-menu {
        position: absolute;
        top: 100%;
        left: 0;
        background: white;
        min-width: 200px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        padding: 0.5rem 0;
        margin-top: 0.5rem;
        opacity: 0;
        visibility: hidden;
        transform: translateY(10px);
        transition: all 0.3s ease;
        z-index: 1000;
    }
    
    .nav-menu .dropdown:hover .dropdown-menu {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }
    
    .nav-menu .dropdown-menu li {
        list-style: none;
        margin: 0;
        padding: 0;
    }
    
    .nav-menu .dropdown-menu a {
        display: block;
        padding: 0.5rem 1.5rem;
        color: #333;
        text-decoration: none;
        transition: all 0.2s ease;
    }
    
    .nav-menu .dropdown-menu a:hover,
    .nav-menu .dropdown-menu a.active {
        background-color: #f8f9fa;
        color: #22c55e;
    }
    
    .user-info {
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    
    .user-name {
        font-weight: 500;
    }
    
    .logout-btn, .login-btn {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        background: #ef4444;
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 500;
        border: none;
        cursor: pointer;
        font-family: inherit;
        transition: background-color 0.3s ease;
    }
    
    .login-btn {
        background: #22c55e;
    }
    
    .logout-btn:hover {
        background: #dc2626;
    }
    
    .login-btn:hover {
        background: #16a34a;
    }
</style>

<nav>
    <ul class="nav-menu">
        <li><a href="{{ url('/') }}" {{ request()->is('/') ? 'class=active' : '' }}>Beranda</a></li>
        <li class="dropdown">
            <a href="{{ url('/lapangan') }}" {{ request()->is('lapangan*') || request()->is('infobooking*') ? 'class=active' : '' }}>
                Lapangan
                @auth
                <svg class="dropdown-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="6 9 12 15 18 9"></polyline>
                </svg>
                @endauth
            </a>
            @auth
            <ul class="dropdown-menu">
                <li><a href="{{ url('/infobooking') }}" {{ request()->is('infobooking*') ? 'class=active' : '' }}>Info Booking</a></li>
            </ul>
            @endauth
        </li>
        <li><a href="{{ url('/kontak') }}" {{ request()->is('kontak*') ? 'class=active' : '' }}>Kontak</a></li>
        <li>
            @auth
                <div class="user-info">
                    <span class="user-name">{{ Auth::user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                        @csrf
                        <button type="submit" class="logout-btn">
                            Logout
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M6 12L2 8L6 4M2 8H10M10 2H12C13.1 2 14 2.9 14 4V12C14 13.1 13.1 14 12 14H10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </form>
                </div>
            @else
                <a href="{{ url('/login') }}" class="login-btn">
                    Login
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                        <path d="M6 12L10 8L6 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            @endauth
        </li>
    </ul>
</nav>
