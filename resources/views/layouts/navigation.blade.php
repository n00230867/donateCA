<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm py-3">
    <div class="container">
        <!-- Brand Logo (consider adding your logo here) -->
        <a class="navbar-brand fw-bold text-primary" href="{{ route('dashboard') }}">
            <i class="fas fa-hand-holding-heart me-2"></i>
            {{ config('app.name', 'DonationHub') }}
        </a>
        
        <!-- Mobile Toggle Button -->
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Navigation -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item mx-2">
                    <a class="nav-link px-3 py-2 rounded-3 {{ request()->routeIs('donations.index') ? 'active bg-primary-soft' : '' }}" href="{{ route('donations.index') }}">
                        <i class="fas fa-box-open me-1"></i>
                        {{ __('Donations') }}
                    </a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link px-3 py-2 rounded-3 {{ request()->routeIs('charities.index') ? 'active bg-primary-soft' : '' }}" href="{{ route('charities.index') }}">
                        <i class="fas fa-hands-helping me-1"></i>
                        {{ __('Charities') }}
                    </a>
                </li>
                @if(auth()->user()->role === 'admin')
                <li class="nav-item mx-2">
                    <a class="nav-link px-3 py-2 rounded-3 {{ request()->routeIs('donations.create') ? 'active bg-primary-soft' : '' }}" href="{{ route('donations.create') }}">
                        <i class="fas fa-plus-circle me-1"></i>
                        {{ __('New Donation') }}
                    </a>
                </li>
                @endif
            </ul>

            <!-- Right Side Navigation -->
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <div class="me-2 d-none d-md-block text-end">
                            <div class="fw-medium">{{ Auth::user()->name }}</div>
                            <div class="small text-muted">{{ ucfirst(Auth::user()->role) }}</div>
                        </div>
                        <div class="avatar bg-primary text-white rounded-circle" style="width: 36px; height: 36px; line-height: 36px; text-align: center;">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    </a>

                    <div class="dropdown-menu dropdown-menu-end shadow border-0 mt-2" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item d-flex align-items-center py-2" href="{{ route('profile.edit') }}">
                            <i class="fas fa-user-circle me-2 text-muted"></i>
                            {{ __('Profile Settings') }}
                        </a>
                        <div class="dropdown-divider my-1"></div>
                        <a class="dropdown-item d-flex align-items-center py-2 text-danger" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt me-2"></i>
                            {{ __('Log Out') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
    .navbar {
        padding: 0.5rem 0;
    }
    .nav-link.active {
        color: var(--bs-primary) !important;
        font-weight: 500;
    }
    .bg-primary-soft {
        background-color: rgba(var(--bs-primary-rgb), 0.1);
    }
    .nav-link {
        transition: all 0.2s ease;
    }
    .nav-link:hover {
        transform: translateY(-1px);
    }
    .dropdown-menu {
        border-radius: 0.5rem;
        padding: 0.5rem;
    }
    .dropdown-item {
        border-radius: 0.25rem;
        transition: all 0.2s ease;
    }
    .avatar {
        font-weight: bold;
    }
</style>