<?php 
use App\Models\User;
$i=1
?>

<!DOCTYPE html>
<html>
<body>
    <h1>User Posts</h1>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th style="width: 3%;">No</th>
                @if($is_admin)<th style="width: 3%;">Post ID</th>@endif
                @if($is_admin)<th style="width: 3%;">User ID</th>@endif
                <th style="width: 7%;">Title</th>
                <th style="width: 26%;">Description</th>
                <th style="width: 10%;">Image</th>
                <th style="width: 8%;">Category</th>
                <th style="width: 14%;">Creation Date</th>
                <th style="width: 15%;">Last Updated At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
                <tr>
                    <td><?= $i . ')'?></td>
                    @if($is_admin) <td style="text-align: center">{{ $post['id'] }}</td> @endif
                    @if($is_admin) <td style="text-align: center">{{ $post['user_id'] }}</td> @endif
                    <td style="text-align: center">{{ $post['title'] }}</td>
                    <td>{{ $post['description'] }}</td>
                    <td style="text-align: center; max-width: 200px; max-height: 150px; padding: 5px;">
                        <img src="{{ storage_path('app/public/'. $post['image_path']) }}" style="max-width: 100px; max-height: 100px; display: inline-block; vertical-align: middle;">
                    </td>
                    <td style="text-align: center">{{ $post['category'] }}</td>
                    <td style="text-align: center">{{ $post['created_at'] }}</td>
                    <td style="text-align: center">{{ $post['updated_at'] }}</td>
                </tr>
                <?php $i++ ?>
                @endforeach
        </tbody>
    </table>
</body>
</html>