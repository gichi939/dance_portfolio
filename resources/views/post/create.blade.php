@extends('layouts.admin')

@section('title', '新規作成')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="col-6 my-5">
                <h2>新規作成</h2>
            </div>
            <form action="{{ route('post.create') }}" method="post" enctype="multipart/form-data">
                @csrf

                @if (count($errors) > 0)
                <ul>
                    @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                    @endforeach
                </ul>
                @endif

                <div class="row">
                    <div class="col-3 mb-5">
                        <label for="title">タイトル</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                    </div>
                </div>
                <!-- </div> -->
                <div class="form-group row">
                    <label class="col-md-3" for="body">本文</label>
                    <div class="col-md-6">
                        <textarea class="form-control" name="body" rows="20">{{ old('body') }}</textarea>
                    </div>
                </div>
                <!-- <input type="submit" class="btn btn-primary" value="更新"> -->

                <input type="submit" class="btn btn-primary btn-lg col-1 offset-5" value="更新">
            </form>
        </div>
    </div>
</div>