@extends('layouts.basicLayout')

@section('title', 'Post Creation')

@section('css')
    <style>
        .create-header {
            margin-left: -1rem;
        }


    </style>
@endsection

@section('content')
    <div class="all">
        <div class="create-header">
            <h2>Create your post!</h2>
        </div>

        <div>
            <form action="{{ route('userposts.store') }}" method="post" enctype="multipart/form-data">
                <fieldset class="mb-3">
                @csrf

                    <div class="form-group row">
                        <label for="title" class="col-form-label col-lg-2">Title </label>
                        <div class="col-lg-10">
                            <input type="text" name="title" id="title" autocomplete="off" class="form-control">
                        </div> 
                    </div>

                    <div class="form-group row">
                        <label for="desc" class="col-form-label col-lg-2">Description </label>
                        <div class="col-lg-10">
                            <textarea name="description" id="desc" autocomplete="off" rows="3" cols="3" class="form-control"></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="img" class="col-form-label col-lg-2">Post Image </label>
                        <div class="col-lg-10">
                            <input type="file" name="img" class="form-control h-auto">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="cat" class="col-form-label col-lg-2">Post Category </label>
                        <div class="col-lg-10">
                            <select name="category_id" id="cat" class="custom-select" required>
                                <option value="">Select Category</option>
                                @foreach(App\Models\PostCategory::all() as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div>
                        <button type="submit" class="btn btn-primary">Create Post</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
@endsection