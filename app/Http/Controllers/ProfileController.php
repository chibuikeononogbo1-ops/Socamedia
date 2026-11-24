<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //
    public function edit(){

        $user = auth()->user();
        $profile = auth()->user()->profile;

        return view('update_profile', compact('user', 'profile'));
    }

    public function update(Request $request){
        // dd($request->all());

        $validateData = $request->validate([
            'name' => 'required| string',
            'username' => 'required| string',
            'bio' => ' string',
            'image' => 'image| max:2048',
        ]);


        $user = auth()->user();
        //handle image

        if($request->image){
            $imageName = $request->file('image')->hashName();
            $path =$request->file('image')->move(public_path('uploads/profiles'), $imageName);
            $validateData['image'] = $imageName;

            //remove old profile image
            $oldImagePath = public_path('uploads/profiles/' .$user->profile->image);
            if(file_exists($oldImagePath)){
                unlink($oldImagePath);
            }
        }

        $user->name = $validateData['name'];
        $user->save();

        $profile = $user->profile;
        $profile->username = $validateData['username'];
        $profile->bio = $validateData['bio'];
        $profile->image = $validateData['image'];
        $profile->save();

        // dd($user, $profile);

        return  redirect()->route('profile');
    }
}
