<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = ['post_id','user_id'];

  public function post()
  {
    return $this->belongsTo(post::class);
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }
  public function like_exist($id, $post_id)
    {
        //Likesテーブルのレコードにユーザーidと投稿idが一致するものを取得
        $exist = Like::where('user_id', '=', $id)->where('post_id', '=', $post_id)->get();

        // レコード（$exist）が存在するなら
        if (!$exist->isEmpty()) {
            return true;
        } else {
        // レコード（$exist）が存在しないなら
            return false;
        }
    }
}
