@extends('layouts.basicLayout')

@section('title', 'User Edit')

@section('content')
    <div class="all">
        <div style="margin-left: -1rem;">
            <h2>User Update Form</h2>
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
        
        @if(auth()->user()->is_admin)
            <form action="{{ route('users.update', $user->id) }}" method="POST">
                <fieldset class="mb-3">
                @csrf
                @method('PUT')

                    <div class="form-group row">
                        <label for="name" class="col-form-label col-lg-2">Username</label>
                        <div class="col-lg-10">
                            <input type="text" name="name" id="name" autocomplete="off" class="form-control" value="{{ old('name', $user->name) }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-form-label col-lg-2">E-mail</label>
                        <div class="col-lg-10">
                            <input type="text" name="email" id="email" autocomplete="off" class="form-control" value="{{ old('email', $user->email) }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-form-label col-lg-2">Password</label>
                        <div class="col-lg-10">
                            <input type="password" name="password" id="password" autocomplete="off" class="form-control" placeholder="Leave blank to keep current">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="is_admin" class="col-form-label col-lg-2">User Privilege</label>
                        <div class="col-lg-10">
                            <select name="is_admin" id="is_admin" class="custom-select" required>
                                <option value="1" {{ old('is_admin', $user->is_admin ?? false) == '1' ? 'selected' : '' }}>Admin</option>
                                <option value="0" {{ old('is_admin', $user->is_admin ?? false) == '0' ? 'selected' : '' }}>User</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Create User</button>
                </fieldset>
            </form>
        @else
            <div class="alert alert-danger">You do not have permission to view this page</div>
        @endif
    </div>
@endsection