<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function post_show() {
        return view('post.create');
    }

    public function post_create(Request $request) {

        $this->validate($request, Post::$rules);

        $post = new Post;

        $create_form = $request->all();

        unset($create_form['_token']);

        $post->fill($create_form);
        $post->save();

        return redirect('/');
    }
}
