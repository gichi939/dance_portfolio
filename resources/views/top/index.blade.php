@extends('layouts.app')

@section('title', 'トップページ')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            @foreach ($posts as $post)
            @auth
            <!-- post.phpに作ったisLikedByメソッドをここで使用 -->
            @if (!$post->isLikedBy(Auth::user()))
            <p>{{ $post->title }}</p>
            <p>{{ $post->body }}</p>
            <span class="likes">
                <i class="fas fa-heart like-toggle" data-post-id="{{ $post->id }}"></i>
                <span class="like-counter">{{$post->likes_count}}</span>
            </span>
            @else
            <p>{{ $post->title }}</p>
            <p>{{ $post->body }}</p>
            <span class="likes">
                <i class="fas fa-heart like-toggle liked" data-post-id="{{ $post->id }}"></i>
                <span class="like-counter">{{$post->likes_count}}</span>
            </span>
            @endif
            @endauth
            @guest
            <span class="likes">
                <i class="fas fa-heart"></i>
                <span class="like-counter">{{$post->likes_count}}</span>
            </span>
            @endguest
            @endforeach

        </div>
    </div>
    @endsection