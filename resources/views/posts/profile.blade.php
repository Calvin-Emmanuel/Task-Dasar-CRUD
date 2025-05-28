@extends('layouts.basicLayout')

@section('title', 'Profile')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profile</div>

                <div class="card-body">
                    <p><strong>Name:</strong> {{ $user->name }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>Role:</strong> {{ $user->is_admin ? 'Admin' : 'User' }}</p>
                    
                    <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profile</a>
                    <a href="{{ route('dashboard') }}" class="btn btn-info">Return to Dashboard</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection