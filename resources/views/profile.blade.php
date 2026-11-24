 @extends('layouts.frontend')

    @section('content')

          <div class="container" style="display: block;"> <!-- Block display for profile layout -->

            <!-- Profile Header -->
            <div class="profile-header">
                <img src="{{asset('uploads/profiles/'.$user->profile->image)}}"
                    alt="Profile" class="profile-avatar-lg">

                <div class="profile-info">
                    <h1>{{$user->name}}</h1>
                    <span class="profile-handle">{{ '@'.$user->profile->username}}</span>

                    <div class="profile-stats">
                        <div class="stat-item">
                            <span class="stat-value">{{count($user->posts)}}</span>
                            <span class="stat-label">Posts</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-value">{{count($user->followers)}}</span>
                            <span class="stat-label">Followers</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-value">{{count($user->followings)}}</span>
                            <span class="stat-label">Following</span>
                        </div>
                    </div>

                    <p style="margin-bottom: 20px; max-width: 500px;">{{ $user->profile->bio}}
                       </p>

                    <div style="display: flex; gap: 10px;">
                        <button class="btn-primary" onclick="window.location.href='{{route('profile.edit')}}'">Edit
                            Profile</button>
                        <button class="follow-btn" style="padding: 10px 20px;">Share Profile</button>
                    </div>
                </div>
            </div>

            <!-- Profile Posts Grid -->
            <h2 style="margin-bottom: 20px; border-bottom: 1px solid var(--border-color); padding-bottom: 10px;">Posts
            </h2>
            <div class="profile-grid">
                <!-- Grid items will be injected by script.js -->
               @foreach ($posts as $post)
                    <div class="grid-post">
                            <img src="{{asset('uploads/posts/'.$post->image)}}" alt="Post">
                        <div class="grid-overlay">
                         <span><i class="ri-heart-fill"></i> {{count($post->likes)}}</span>
                         <span><i class="ri-chat-3-fill"></i> {{count($post->comments)}}</span>
                        </div>
                     </div>
                   
               @endforeach
            </div>

        </div>

     @endsection