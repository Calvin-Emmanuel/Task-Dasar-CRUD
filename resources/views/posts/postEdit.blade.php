@extends('layouts.basicLayout')

@section('title', 'Post Editing')

@section('css')
    <style>
        .update-header {
            margin-left: -1rem;
        }

        .update-form {

        }

        .update-return {

        }
    </style>
@endsection

@section('content')
    <div class="all">
        <div class="update-header">
            <h2>Update your post!</h2>
        </div>

        <div>
            <form action="{{ route('userposts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label for="title" class="col-form-label col-lg-2">Title </label>
                    <div class="col-lg-10">
                        <input type="text" name="title" value="{{ $post->title }}" id="title" autocomplete="off" class="form-control">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="desc" class="col-form-label col-lg-2">Description </label>
                    <div class="col-lg-10">
                        <textarea name="description" id="desc" autocomplete="off" rows="3" cols="3" class="form-control">{{ $post->description }}</textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="img" class="col-form-label col-lg-2">Post Image</label>
                    <div class="col-lg-10">
                        <input type="file" name="img" class="form-control h-auto">
                    </div>
                </div>

                @if($post->image_path)
                    <div class="form-group row" style="align-items: center;">
                        <label class="col-form-label col-lg-2">Current Image</label>
                        <div class="col-lg-10">
                            <img src="{{ asset('storage/' . $post->image_path) }}" width="100" class="mb-2">
                            <div class="form-check"> 
                                <input type="checkbox" name="remove_image" id="img-remove">
                                <label for="img-remove" class="form-check-label"> Remove image</label>
                            </div>
                        </div>
                    </div>
                @endif
                
                <div class="form-group row">
                    <label for="cat" class="col-form-label col-lg-2">Post Category </label>
                        <div class="col-lg-10">
                            <select name="category_id" id="cat" class="custom-select" required>
                                @foreach(App\Models\PostCategory::all() as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $post->category_id == $category->id ? 'selected' : ''}}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                </div>
                
                <button type="submit" class="btn btn-primary">Update</button>
                
            </form>
        </div>   
    </div>
@endsection