<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      $posts = Post::latest()->get();
      $user = auth()->user();
      $suggestedusers = User::where('id', '!=', $user->id)->inRandomOrder()->take(3)->get();


    //   $anotheruser = User::where('id', '11')->first();

    //   if($user->isFollowing($anotheruser)){
    //     $followRecord = $user->followings->where('following_id', $anotheruser->id);
    //     dd($followRecord, $user->isFollowing($anotheruser));
    //   }

      
        return view('home', compact('posts','user', 'suggestedusers'));
    }


    public function profile()
    {
        $user = auth()->user(); //auth user
        $posts = Post::where('user_id', $user->id)->latest()->get();
        return view('profile', compact('user', 'posts'));
    }


    public function posting()
    {
        return view('posting');
    }
    public function update()
    {
        return view('update_profile');
    }
}
