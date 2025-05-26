<style>
    body {
        margin: 0 !important;  /* Remove default body margin */
        padding: 0 !important; /* Remove default body padding */
    }
    .navbar {
        padding-top: 0 !important;  /* Remove navbar top padding */
        padding-bottom: 0 !important;
    }
</style>

<nav class="navbar navbar-expand-lg w-100" style="background-color:rgba(178, 247, 224, 0.527); border-bottom: 3px solid #2d5263">
    <div class="container-fluid" style="margin-bottom: 3px; margin-left: 0.3rem; ">
        <div style="display: inline-flex; align-items: center; gap: 8px;">  <!-- Forced minimum width -->
            <a class="navbar-brand p-0" href="{{ route('userposts.list') }}">
                <img src="{{ asset('global_assets/images/star.png') }}" 
                     alt="App Logo" 
                     style="height:30px; width:30px; display:block;">
            </a>
            <h1 class="h5 mb-0" style="margin-left: -13.5rem; color: #000000;" !important>CRUD Task</h1>
        </div>
        @if($show_logout ?? true)
            
        @endif
        @auth
            @unless(request()->is('login'))
                <div style="color: #000000;">
                    <h3>Logged in as:</h3>
                </div>
        
                <div class="d-flex align-items-center gap-2">
                    <img src="{{ asset('global_assets/images/pie-chart.png') }}" alt="User Picture" 
                    style="width: 32px; height: 32px; object-fit: cover;" class="rounded-circle align-middle">
                    <span style="color: #000000; font-size: 24px; 
                    line-height:32px; position:relative; top:-8px;">{{ Auth::user()->name }}</span>
                </div>
                @if($show_logout ?? true)
                    <form method="POST" action="{{ route('userposts.logout') }}" class="mb-0">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm">
                            <i class=""></i> Logout
                        </button>
                    </form>
                @else 
                    <div>
                        <form action="{{ route('userposts.list') }}" method="GET">
                            <button type="submit">Return to dashboard</button>
                        </form>
                    </div>
                @endif
            @endunless
        @endauth
    </div>
</nav>