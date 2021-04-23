<?php

namespace App\Http\Controllers;

use App\Post;
use App\Like;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PostController extends Controller
{
    
    // public function index()
    // {
    //     $data = [];
    //     // ユーザの投稿の一覧を作成日時の降順で取得
    //     //withCount('テーブル名')とすることで、リレーションの数も取得できます。
    //     $posts = Post::withCount('likes')->orderBy('created_at', 'desc');
    //     $like_model = new Like;
        
    //     $data = [
    //         'posts' => $posts,
    //         'like_model'=>$like_model,
    //     ];
    //     // dd($data);
        
    //     return view('top.index', $data);
    // }
    
    public function ajaxlike(Request $request)
    {
        $id = Auth::user()->id;
        $post_id = $request->post_id;
        $like = new Like;
        $post = Post::findOrFail($post_id);
        
        // 空でない（既にいいねしている）なら
        if ($like->like_exist($id, $post_id)) {
            //likesテーブルのレコードを削除
            $like = Like::where('post_id', $post_id)->where('user_id', $id)->delete();
        } else {
            //空（まだ「いいね」していない）ならlikesテーブルに新しいレコードを作成する
            $like = new Like;
            $like->post_id = $request->post_id;
            $like->user_id = Auth::user()->id;
            $like->save();
        }
        
        //loadCountとすればリレーションの数を○○_countという形で取得できる（今回の場合はいいねの総数）
        $postLikesCount = $post->loadCount('likes')->likes_count;
        
        //一つの変数にajaxに渡す値をまとめる
        //今回ぐらい少ない時は別にまとめなくてもいいけど一応。笑
        $json = [
            'postLikesCount' => $postLikesCount,
        ];
        //下記の記述でajaxに引数の値を返す
        return response()->json($json);
    }

    public function like(Request $request)
{
    $user_id = Auth::user()->id; //1.ログインユーザーのid取得
    $post_id = $request->post_id; //2.投稿idの取得
    $already_liked = Like::where('user_id', $user_id)->where('post_id', $post_id)->first(); 
    
    if (!$already_liked) { //もしこのユーザーがこの投稿にまだいいねしてなかったら
        $like = new Like; //4.Likeクラスのインスタンスを作成
        $like->post_id = $post_id; //Likeインスタンスにpost_id,user_idをセット
        $like->user_id = $user_id;
        $like->save();
    } else { //もしこのユーザーがこの投稿に既にいいねしてたらdelete
        Like::where('post_id', $post_id)->where('user_id', $user_id)->delete();
    }
    //5.この投稿の最新の総いいね数を取得
    $post_likes_count = Post::withCount('likes')->findOrFail($post_id)->likes_count;
    $param = [
        'post_likes_count' => $post_likes_count,
    ];
    return response()->json($param); //6.JSONデータをjQueryに返す
}

public function index(Request $request)
{
    $posts = Post::withCount('likes')->orderBy('id', 'desc')->paginate(10);
    $param = [
        'posts' => $posts,
    ];
    return view('top.index', $param);
}

    public function post_show()
    {
        return view('post.create');
    }
    
    public function post_create(Request $request) {
    
        $this->validate($request, Post::$rules);
    
        $post = new Post;
    
        $create_form = $request->all();
    
        unset($create_form['_token']);
    
        $post->fill($create_form);
        $post->user_id = Auth::id();
        $post->save();
    
        return redirect('/');
    }
}
