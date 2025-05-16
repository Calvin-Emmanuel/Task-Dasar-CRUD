<!DOCTYPE html>
<html>
<head>
    <title>See stuff</title>
</head>
<body>
    <h2>Create your post!</h2>
    
    <form action="{{ route('userposts.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <label for="title">Title: </label>
        <input type="text" name="title" id="title" autocomplete="off"> 
        <br>
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
    <a href="{{ route('userposts.list') }}">Return to list</a>
</body>
</html>