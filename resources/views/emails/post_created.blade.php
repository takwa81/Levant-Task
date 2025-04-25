<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>New Post Notification</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 30px; color: #333;">

    <table width="100%" cellpadding="0" cellspacing="0"
        style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); padding: 20px;">
        <tr>
            <td>
                <h2 style="margin-top: 0;">Hello {{ $admin->name ?? 'Admin' }} ,</h2>

                <p>
                    A new post has just been created by <strong>{{ $post->user->name ?? 'Unknown User' }}</strong>.
                </p>

                <h3 style="margin-bottom: 5px;">Post Title:</h3>
                <p style="font-size: 18px; font-weight: bold; color: #1D4ED8;">{{ $post->title }}</p>

                @if ($post->content)
                    <h3 style="margin-bottom: 5px;">Post Content:</h3>
                    <p style="margin-bottom: 20px;">{{ Str::limit(strip_tags($post->content), 200) }}</p>
                @endif

                <p>
                    <a href="{{ url('/api/posts/' . $post->id) }}"
                        style="display: inline-block; padding: 10px 20px; background-color: #1D4ED8; color: #ffffff; text-decoration: none; border-radius: 5px;">
                        View Post
                    </a>
                </p>

                <p style="margin-top: 40px;">Thank you,<br><strong>Levant Company</strong></p>
            </td>
        </tr>
    </table>

</body>

</html>
