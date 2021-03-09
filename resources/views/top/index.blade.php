<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <title>Document</title>
</head>

<body>
    <div>
        @foreach($posts as $post)

    {{ $post->title }}

        @if($post->is_liked_by_auth_user())
        <a href="{{ route('post.unlike', ['id' => $post->id]) }}" class="">
            <i class="material-icons" style="font-size: 42px; color:red;">favorite</i>
            <span class="badge">{{ $post->likes->count() }}</span>
        </a>
        @else
        <a href="{{ route('post.like', ['id' => $post->id]) }}" class="">
            <i class="material-icons" style="font-size: 42px; color:red;">favorite_border</i>
            <span class="badge">{{ $post->likes->count() }}</span>
        </a>
        @endif

        @endforeach
    </div>
    <a href="{{ route('post.show') }}">新規作成</a>
</body>

</html>