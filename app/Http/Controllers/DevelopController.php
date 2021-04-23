<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Like;
use App\Post;

class DevelopController extends Controller
{
    public function show() {

      $posts = Post::withCount('likes')->orderBy('id', 'desc')->paginate(10);
      $param = [
          'posts' => $posts,
      ];
      return view('top.index', $param);
    }

    /**
  * 引数のIDに紐づくリプライにLIKEする
  *
  * @param $id リプライID
  * @return \Illuminate\Http\RedirectResponse
  */
  public function like($id)
  {
    Like::create([
      'post_id' => $id,
      'user_id' => Auth::id(),
    ]);


    return redirect()->back();
  }

  /**
   * 引数のIDに紐づくリプライにUNLIKEする
   *
   * @param $id リプライID
   * @return \Illuminate\Http\RedirectResponse
   */
  public function unlike($id)
  {
    $like = Like::where('post_id', $id)->where('user_id', Auth::id())->first();
    $like->delete();


    return redirect()->back();
  }
}
