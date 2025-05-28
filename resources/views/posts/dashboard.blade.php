@extends('layouts.basicLayout')

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid ps-5">
        <div class="row">

            <div class="col-xl-4 col-lg-4 col-md-6 mb-4">
                <div class="card h-100 shadow-sm">

                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">Posts</h5>
                    </div>

                    <div class="card-body text-center d-flex flex-column">
                        <div class="my-3">
                            <i class="fas fa-newspaper fa-3x text-primary"></i>
                        </div>

                        <a href="{{ route('userposts.list') }}" class="btn btn-primary mt-auto">View Posts</a>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-6 mb-4">
                <div class="card h-100 shadow-sm">

                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">Profile</h5>
                    </div>

                    <div class="card-body text-center d-flex flex-column">
                        <div class="my-3">
                            <i class="fas fa-user fa-3x text-primary"></i>
                        </div>

                        <a href="{{ route('profile.show') }}" class="btn btn-primary mt-auto">View Profile</a>
                    </div>
                </div>
            </div>

            @auth
                @if(auth()->user()->is_admin)
                    <div class="col-xl-4 col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 shadow-sm">

                            <div class="card-header bg-info text-white">
                                <h5 class="card-title mb-0">User List</h5>
                            </div>

                            <div class="card-body text-center d-flex flex-column">
                                <div class="my-3">
                                    <i class="fas fa-users fa-3x text-info"></i>
                                </div>

                                <a href="{{ route('users.list') }}" class="btn btn-info mt-auto">View User List (WIP)</a>
                            </div>
                        </div>
                    </div>
                @endif
            @endauth
        </div>
    </div>
@endsection