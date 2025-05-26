@extends('postsLayout.layout')

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
                @csrf

                <div class="form-group row">
                    <label for="title" class="col-form-label col-lg-2">Title: </label>
                    <div class="col-lg-10">
                        <input type="text" name="title" id="title" autocomplete="off" class="form-control">
                    </div> 
                </div>

                <label for="desc">Description: </label>
                <textarea name="description" id="desc" autocomplete="off"></textarea>
                <br>
                <label for="img">Post Image: </label>
                <input type="file" name="img" id="img">
                <br>
                <label for="cat">Post Category: </label>
                <select name="category_id" id="cat" required>
                    <option value="">Select Category</option>
                    @foreach(App\Models\PostCategory::all() as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <br>
                <button type="submit">Create Post</button>
            </form>
        </div>
    </div>
@endsection