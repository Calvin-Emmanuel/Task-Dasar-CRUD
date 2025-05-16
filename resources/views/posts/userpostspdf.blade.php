<?php $i=1?>

<!DOCTYPE html>
<html>
<body>
    <h1>User Posts</h1>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Post ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Image</th>
                <th>Category</th>
                <th>Creation Date</th>
                <th>Last Updated At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
                <tr>
                    <td><?= $i . ')'?></td>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->description }}</td>
                    <td><img src="{{ storage_path('app/public/'. $post->image_path) }}"></td>
                    <td>{{ $post->category->name ?? 'Uncategorized'}}</td>
                    <td>{{ $post->created_at->format('Y-m-d H:i') }}</td>
                    <td>{{ $post->updated_at->format('Y-m-d H:i') }}</td>
                </tr>
                <?php $i++ ?>
                @endforeach
        </tbody>
    </table>
</body>
</html>