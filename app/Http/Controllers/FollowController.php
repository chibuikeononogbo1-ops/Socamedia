<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    //
    public function store(Request $request){
        // return $request->all();
        
         
         $user = auth()->user();
         $followuser = User::where('id', $request->suggesteduser_id)->first();



        // check if user has followed before and then remove it
        if($user->isFollowing($followuser)){
            $followRecord = $user->followings->where('following_id', $followuser->id)->first();
            $followRecord->delete();
            return $followRecord;
        }
        

        $follow = Follow::create([
            'follower_id' => $user->id,
            'following_id' => $followuser->id,
        ]);

        if(!$follow){
            return 'Post was not followed';
        }

        return $follow;
         
    }
}
