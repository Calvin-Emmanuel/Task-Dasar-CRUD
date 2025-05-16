
<h2>Update your post!</h2>

<form action="{{ route('userposts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <label for="title">Title: </label>
    <input type="text" name="title" value="{{ $post->title }}" id="title" autocomplete="off">
    <br>
    <label for="desc">Description: </label>
    <textarea name="description" id="desc" autocomplete="off">{{ $post->description }}</textarea>
    <br>
    <label for="img">Post Image:</label>
    <input type="file" name="img">
    <br>
    @if($post->image_path)
        <img src="{{ asset('storage/' . $post->image_path) }}" width="100">
        <br>
        <label>
            <input type="checkbox" name="remove_image"> Remove image
        </label>
    @endif
    <br>
    <label for="cat">Post Category: </label>
        <select name="category_id" id="cat" required>
            @foreach(App\Models\PostCategory::all() as $category)
                <option value="{{ $category->id }}"
                    {{ $post->category_id == $category->id ? 'selected' : ''}}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    <br>
    <button type="submit">Update</button>
    <br>
    <a href="{{ route('userposts.list') }}">Return to list</a>
</form>