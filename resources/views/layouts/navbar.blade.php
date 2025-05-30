<div style="max-height: 275px; overflow: visible; box-shadow: 0 -1px 0 0 rgba(0,0,0,0.125), 1px 0 0 0 rgba(0,0,0,0.125) inset, -1px 0 0 0 rgba(0,0,0,0.125) inset, 0 1px 0 0 rgba(0,0,0,0.125);">
    <div class="navbar navbar-dark navbar-expand-xl" style="align-items: center; z-index:1100; height: 72px;">
        <div class="navbar-brand" style="display: inline-flex; gap: 10px; align-items:center">
            <a href="
                    @auth
                        @unless(request()->is('login')) 
                            {{ route('dashboard') }}
                        @endunless
                    @endauth " class="d-inline-block">
                <img src="{{ asset('global_assets/images/star.png') }}" alt="" style="width: 40px; height: 40px;">
            </a>
            <p class="h5 mb-0">Posts Project</p>
        </div>
        @auth
            @unless(request()->is('login'))
                <div class="ml-auto" style="margin-right: 1rem;">
                    <form action="{{ route('userposts.logout') }}" method="POST"> 
                        @csrf 
                        <button type="submit" class="btn btn-primary" style="width: 128px">Log out</button>
                    </form>
                </div>
            @endunless
        @endauth    
    </div>
</div>
