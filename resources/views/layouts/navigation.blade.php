<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" style="padding: 10px 0;">
    <div class="container">
        <!-- Brand Logo - Matching your welcome page style -->
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <img src="/images/charityhublogo.png" alt="CharityHub Logo" style="height: 50px;">
        </a>
        
        <!-- Mobile Toggle Button -->
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Navigation -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item" style="margin: 0 10px;">
                    <a class="nav-link" href="{{ route('donations.index') }}" style="padding: 8px 16px; border-radius: 8px; {{ request()->routeIs('donations.index') ? 'background-color: rgba(78, 115, 223, 0.1); color: #4e73df; font-weight: 600;' : '' }}">
                        <i class="fas fa-box-open" style="margin-right: 8px;"></i>
                        {{ __('Donations') }}
                    </a>
                </li>
                <li class="nav-item" style="margin: 0 10px;">
                    <a class="nav-link" href="{{ route('charities.index') }}" style="padding: 8px 16px; border-radius: 8px; {{ request()->routeIs('charities.index') ? 'background-color: rgba(78, 115, 223, 0.1); color: #4e73df; font-weight: 600;' : '' }}">
                        <i class="fas fa-hands-helping" style="margin-right: 8px;"></i>
                        {{ __('Charities') }}
                    </a>
                </li>
                @if(auth()->user()->role === 'admin')
                <li class="nav-item" style="margin: 0 10px;">
                    <a class="nav-link" href="{{ route('donations.create') }}" style="padding: 8px 16px; border-radius: 8px; {{ request()->routeIs('donations.create') ? 'background-color: rgba(78, 115, 223, 0.1); color: #4e73df; font-weight: 600;' : '' }}">
                        <i class="fas fa-plus-circle" style="margin-right: 8px;"></i>
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
                            <div style="font-weight: 600;">{{ Auth::user()->name }}</div>
                            <div style="font-size: 14px; color: #6c757d;">{{ ucfirst(Auth::user()->role) }}</div>
                        </div>
                        <div class="avatar" style="background-color: #4e73df; color: white; width: 40px; height: 40px; line-height: 40px; text-align: center; border-radius: 50%; font-weight: bold;">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    </a>

                    <div class="dropdown-menu dropdown-menu-end shadow border-0 mt-2" style="border-radius: 8px; padding: 8px; border: none;">
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('profile.edit') }}" style="padding: 8px 16px; border-radius: 6px;">
                            <i class="fas fa-user-circle" style="margin-right: 10px; color: #6c757d;"></i>
                            {{ __('Profile Settings') }}
                        </a>
                        <div style="border-top: 1px solid #dee2e6; margin: 6px 0;"></div>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}" style="padding: 8px 16px; border-radius: 6px; color: #dc3545;"
                            onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt" style="margin-right: 10px;"></i>
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