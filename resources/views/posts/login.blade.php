@extends('layouts.basicLayout')

@section('title', 'Login')

@section('css')
    <style>
        .login-header{
            margin: -1rem;
        }
    </style>
@endsection

@section('content')
    <div class="all content">
        <div class=".login-header">
            <h1>Log-in here!</h1>
        </div>
        <div>
            @if ($errors->any())
                <p>E-mail or password is wrong</p>
            @endif
        </div>
        <form action="{{ route('login.post') }}" method="POST">
            <fieldset class="mb-3">
                @csrf
                <div class="form-group row">                               
                    <label for="email" class="col-form-label col-lg-2">E-mail</label>
                    <div class="col-lg-10">
                        <input type="text" id="email" name="email" class="form-control" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="pss" class="col-form-label col-lg-2">Password</label>
                    <div class="col-lg-10">
                        <input type="password" id="pss" name="password" class="form-control" required>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-10">
                        <button type="submit" class="btn btn-primary">Log in</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
@endsection