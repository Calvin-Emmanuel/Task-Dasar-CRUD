<div style="max-height: 275px; overflow: visible; box-shadow: 0 -1px 0 0 rgba(0,0,0,0.125), 1px 0 0 0 rgba(0,0,0,0.125) inset, -1px 0 0 0 rgba(0,0,0,0.125) inset, 0 1px 0 0 rgba(0,0,0,0.125);">
    <div class="navbar navbar-dark navbar-expand-xl" style="align-items: center">
        <div class="navbar-brand" style="display: inline-flex; gap: 10px; align-items:center">
            <a href="
                    @auth
                        @unless(request()->is('login')) 
                            {{ route('userposts.list') }}
                        @endunless
                    @endauth " class="d-inline-block">
                <img src="{{ asset('global_assets/images/star.png') }}" alt="" style="width: 40px; height: 40px;">
            </a>
            <p class="h5 mb-0">CRUD Task</p>
        </div>
        @auth
            @unless(request()->is('login'))
                <div style="margin-right: 1rem">
                            <a href="#" class="navbar-nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown">
                                <img src="{{ asset('global_assets/images/placeholders/placeholder.jpg') }}" class="rounded-circle mr-2" height="34" alt="">
                                <span>{{ Auth::user()->name }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" style="margin-right: 1rem">
                                <form action="{{ route('userposts.logout') }}" method="POST" style="margin-left: 1rem; margin-right: 1rem;"> 
                                    @csrf 
                                    <button type="submit" class="btn btn-primary form-control">Log out</button>
                                </form>
                            </div>
                </div>
                @endunless
            @endauth    
    </div>
</div>
