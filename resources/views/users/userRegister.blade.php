@extends('layouts.basicLayout')

@section('title', 'User Registration')

@section('css')

@endsection

@section('content')
    <div class="all">
        <div style="margin-left: -1rem;">
            <h2>User Registration Form</h2>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
            <form action="{{ route('users.guest') }}" method="POST">
                <fieldset class="mb-3">
                @csrf

                    <div class="form-group row">
                        <label for="name" class="col-form-label col-lg-2">Username</label>
                        <div class="col-lg-10">
                            <input type="text" name="name" id="name" autocomplete="off" class="form-control" value="{{ old('name') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-form-label col-lg-2">E-mail</label>
                        <div class="col-lg-10">
                            <input type="text" name="email" id="email" autocomplete="off" class="form-control" value="{{ old('email') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-form-label col-lg-2">Password</label>
                        <div class="col-lg-10">
                            <input type="password" name="password" id="password" autocomplete="off" class="form-control" value="{{ old('password') }}">
                        </div>
                    </div>

                    <input type="hidden" name="is_admin" value="0">

                    <button type="submit" class="btn btn-primary">Register User</button>
                    <a href="{{ route('login') }}" class="btn btn-secondary">Cancel</a>
                </fieldset>
            </form>
    </div>
@endsection