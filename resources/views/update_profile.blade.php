 @extends('layouts.frontend')

    @section('content')

     <div class="container" style="display: block;">

        <div class="form-card">
                <h2 style="margin-bottom: 20px; text-align: center;">Edit Profile</h2>

                <form action="{{route('profile.update')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div style="display: flex; justify-content: center; margin-bottom: 30px;">
                        <div style="position: relative;">
                            <img src="{{asset('uploads/profiles/'.$user->profile->image)}}"
                                alt="Profile" style="width: 100px; height: 100px; border-radius: 50%;">
                            <label for="profile-upload"
                                style="position: absolute; bottom: 0; right: 0; background: var(--primary-color); width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; border: 2px solid var(--bg-card);">
                                <i class="ri-camera-line" style="color: white; font-size: 16px;"></i>
                            </label>
                            <input type="file" name="image" id="profile-upload" style="display: none;" accept="image/*">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="input-field" value="{{$user->name}}">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="input-field" value="{{$profile->username}}">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Bio</label>
                        <textarea name="bio" class="input-field"
                            style="min-height: 80px;">{{$profile->bio}}</textarea>
                    </div>

                    {{-- <div class="form-group">
                        <label class="form-label">Website</label>
                        <input type="url" class="input-field" placeholder="https://yourwebsite.com">
                    </div> --}}

                    <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 30px;">
                        <button type="button" class="action-btn" onclick="window.history.back()">Cancel</button>
                        <button type="submit" class="btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>

        </div>


    @endsection