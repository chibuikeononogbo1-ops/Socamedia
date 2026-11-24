<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function create(){
         $user = auth()->user(); //auth user
         $create = auth()->user()->create; //auth user not functioning
        return view('posting', compact('user', 'create'));
    }

    // public function store(){
        
    //      return view('home');
    // }

        
    

    public function store(Request $request){
        // dd($request->all());

    $validateData = $request->validate([
            
            'body' => ' string',
            'image' => 'image| max:2048',
    ]);

       $user = auth()->user();
       if($request->image){
            $imageName = $request->file('image')->hashName();
            $path =$request->file('image')->move(public_path('uploads/posts'), $imageName);
            $validateData['image'] = $imageName;


            
        }

        
        $post = Post::create([
            'user_id' =>$user->id,
            'body' =>$validateData['body'],
            'image' =>$validateData['image'],
        ]);

        return redirect()->route('home');
    }

      
    }


        
            
            
            
       


