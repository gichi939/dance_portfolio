@extends('layouts.admin')

@section('title', 'トップページ')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">

            @foreach($posts as $post)
            <div class="col-md-6">
                {{ $post->title }}
            </div>
            @if($post->is_liked_by_auth_user())
                <a href="{{ route('post.unlike', ['id' => $post->id]) }}" class="">
                    <i class="material-icons" style="font-size: 42px; color:red;">favorite</i>
                </a>
                <span class="badge">{{ $post->likes->count() }}</span>
            @else
            <a href="{{ route('post.like', ['id' => $post->id]) }}" class="">
                <i class="material-icons" style="font-size: 42px; color:red;">favorite_border</i>
                <span class="badge">{{ $post->likes->count() }}</span>
            </a>
            @endif

            <br>
            @endforeach
            <a class="btn btn-primary btn-lg" role="button" href="{{ route('post.show') }}">新規作成</a>
        </div>
    </div>
    @endsection