<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //
    public function store(Request $request){
        // dd($request->all());

         $user = auth()->user();

         $comment = Comment::create([
            'user_id' => $user->id,
            'post_id' => $request->post_id,
            'body' => $request->body,
         ]);

         if(!$comment){
            return 'coment was not created';
         }

         return $comment;

    }

    

   
}
