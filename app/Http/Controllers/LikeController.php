<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    //

    public function store(Request $request){
        $user = auth()->user();

        // check if user has liked the post before and then remove it
        
        $post = Post::where('id', $request['post_id'])->first();

        if($post->likes && $post->likes->where('user_id', $user->id)->first()){
            $postLike = $post->likes->where('user_id', $user->id)->first();
            $postLike->delete();
            return $postLike;
        }

        $like = Like::create([
            'user_id' => $user->id,
            'post_id' => $request['post_id']
        ]);

        if(!$like){
            return 'Post was not liked';
        }

        return $like;
    }
}
