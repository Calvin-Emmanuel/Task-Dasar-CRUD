<?php $i = 0;?>

<!DOCTYPE html>
<html>
<head>
    <title>Post Export</title>
</head>
<body>
    <h2>All Posts</h2>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Post ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Creation Date</th>
                <th>Last Updated At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
            <tr>
                <td><?= $i . ')'?></td>
                <td>{{ $post->id }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->description }}</td>
                <td>{{ $post->creation_at }}</td>
                <td>{{ $post->updated_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>