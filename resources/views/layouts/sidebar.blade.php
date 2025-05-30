<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">
    <div class="sidebar-content">
        <div class="card card-sidebar-mobile">
			
            <ul class="nav nav-sidebar" data-nav-type="accordion">
                <li class="nav-item">
                    <a href="/dashboard" class="nav-link {{ request()->is('dashboard*') ? 'active' : '' }}">
                        <i class="icon-home4"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="{{ route('userposts.list') }}" class="nav-link {{ request()->is('posts*') ? 'active' : '' }}">
                        <i class="fas fa-newspaper"></i>
                        <span>Posts</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('profile.show') }}" class="nav-link {{ request()->is('profile*') ? 'active' : '' }}">
                        <i class="fas fa-user"></i>
                        <span>Profile</span>
                    </a>
                </li>

                @auth
                    @if(auth()->user()->is_admin)
                        <li class="nav-item">
                            <a href="{{ route('users.list') }}" class="nav-link {{ request()->is('users*') ? 'active' : '' }}">
                                <i class="fas fa-users"></i>
                                <span>User List</span>
                            </a>
                        </li>
                    @endif
                @endauth
            </ul>
        </div>
    </div>
</div>