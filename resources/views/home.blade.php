
    @extends('layouts.frontend')

    @section('content')
        <div class="container">
            <!-- Feed -->
            <div class="feed">
                <!-- Create Post Trigger (Optional quick access) -->
                <div class="post-card" style="display: flex; gap: 15px; align-items: center; cursor: pointer;"
                    onclick="window.location.href='{{route('post.create')}}'">
                    <img src="{{asset('uploads/profiles/'.$user->profile->image)}}"
                        alt="Profile" class="user-avatar-sm">
                    <input type="text" placeholder="What's on your mind?" class="input-field"
                        style="background: var(--bg-body); cursor: pointer;" readonly>
                    <i class="ri-image-add-line" style="font-size: 24px; color: var(--primary-color);"></i>
                </div>

                <div class="feed-posts">
                    <!-- post -->
                    @foreach ($posts as $post)
                    <div class="post-card">
                        <div class="post-header">
                            <div class="user-info">
                                <img src="{{asset('uploads/profiles/'.$post->user->profile->image)}}"
                                    alt="User" class="user-avatar-sm">
                                <div>
                                    <div class="username">{{$post->user->name}}</div>
                                    <div class="time">{{$post->created_at->diffForHumans()}}</div>
                                </div>
                            </div>
                            <i class="ri-more-fill" style="cursor: pointer; color: var(--text-muted);"></i>
                        </div>

                        <div class="caption">
                            <span>@sarah_d</span>{{$post->body}}
                        </div>
                                    {{-- https://images.unsplash.com/photo-1628155930542-3c7a64e2c833?ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=1600&amp;q=80 --}}
                        <img src="{{asset('uploads/posts/'.$post->image)}}"
                            alt="Post Image" class="post-image">

                        <div class="post-actions">
                            @if ($post->likes->where('user_id',$user->id)->first())
                                <button class="action-btn liked" data-id="{{$post->id}}" onclick="toggleLike(this)"><i class="ri-heart-fill"></i>
                                    <span class="likes-count-{{$post->id}}"> {{count($post->likes)}}</span>
                                </button>
                            @else
                                <button class="action-btn" data-id="{{$post->id}}" onclick="toggleLike(this)"><i class="ri-heart-line"></i>
                                    <span class="likes-count-{{$post->id}}"> {{count($post->likes)}}</span>
                                </button> 
                            @endif
                           
                            <button class="action-btn">
                                <i class="ri-chat-3-line"></i>
                                <span class="comment-count-{{$post->id}}"> {{count($post->comments)}}</span>
                            </button>
                            <button class="action-btn">
                                <i class="ri-share-forward-line"></i>
                            </button>
                        </div>

                        <div class="comments-section">
                            @foreach ($post->comments as $comment )
                                <div style="font-size: 14px; margin-bottom: 5px;">
                                <span style="font-weight: 600;">{{$comment->user->name}}</span> <span
                                    style="color: var(--text-muted);">{{$comment->body}}</span>
                            </div> 
                            @endforeach
                           
                            {{-- 
                            <div style="font-size: 14px; margin-bottom: 5px;">
                                <span style="font-weight: 600;">Jane Smith</span> <span
                                    style="color: var(--text-muted);">Love the color palette!</span>
                            </div>


                            <div style="font-size: 14px; margin-bottom: 5px;"><span style="font-weight: 600;">You</span>
                                <span style="color: var(--text-muted);">rfgjh</span></div> --}}
                            <div class="comment-input-area">
                                <input type="text" data-id="{{$post->id}}" placeholder="Add a comment..." class="input-field">
                                <button class="btn-primary" onclick="addComment(this)">Post</button>
                            </div>
                        </div>
                    </div>
                    @endforeach



                   
                    
                    
                    
                    
                    {{-- <div class="post-card">
                        <div class="post-header">
                            <div class="user-info">
                                <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=800&amp;q=80"
                                    alt="User" class="user-avatar-sm">
                                <div>
                                    <div class="username">Sarah Design</div>
                                    <div class="time">2 hours ago</div>
                                </div>
                            </div>
                            <i class="ri-more-fill" style="cursor: pointer; color: var(--text-muted);"></i>
                        </div>

                        <div class="caption">
                            <span>@sarah_d</span> Working on a new dashboard design! 🎨 What do you think?
                        </div>

                        <img src="https://images.unsplash.com/photo-1628155930542-3c7a64e2c833?ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=1600&amp;q=80"
                            alt="Post Image" class="post-image">

                        <div class="post-actions">
                            <button class="action-btn liked" onclick="toggleLike(this)"><i class="ri-heart-fill"></i>
                                125</button>
                            <button class="action-btn">
                                <i class="ri-chat-3-line"></i> 2
                            </button>
                            <button class="action-btn">
                                <i class="ri-share-forward-line"></i>
                            </button>
                        </div>

                        <div class="comments-section">

                            <div style="font-size: 14px; margin-bottom: 5px;">
                                <span style="font-weight: 600;">John Doe</span> <span
                                    style="color: var(--text-muted);">Looks amazing! 🔥</span>
                            </div>

                            <div style="font-size: 14px; margin-bottom: 5px;">
                                <span style="font-weight: 600;">Jane Smith</span> <span
                                    style="color: var(--text-muted);">Love the color palette!</span>
                            </div>


                            <div style="font-size: 14px; margin-bottom: 5px;"><span style="font-weight: 600;">You</span>
                                <span style="color: var(--text-muted);">rfgjh</span></div>
                            <div class="comment-input-area">
                                <input type="text" placeholder="Add a comment..." class="input-field">
                                <button class="btn-primary" onclick="addComment(this)">Post</button>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>

            <!-- Sidebar (Desktop Only) -->
            <div class="sidebar-right">
                <div class="sidebar-card">
                    <div class="sidebar-title">Suggested for you</div>

                  @foreach ($suggestedusers as $suggesteduser)

                      <div class="suggested-user">
                        <div class="user-info">
                            <img src="{{asset('uploads/profiles/'.$suggesteduser->profile->image)}}"
                                alt="User" class="user-avatar-sm">
                            <div>
                                <div class="username" style="font-size: 14px;">{{$suggesteduser->name}}</div>
                                <div class="time">{{$suggesteduser->created_at->diffForHumans()}}</div>
                            </div>
                        </div>
                        @if ($user->isFollowing($suggesteduser))


                        <button class="follow-btn" data-id="12" onclick="followUser(this)" style="background: var(--primary-color); color: rgb(255, 255, 255); border-color: transparent;">Following</button>
                        @else

                         <button class="follow-btn" data-id="{{$suggesteduser->id}}" onclick="followUser(this)">Follow</button>   
                        @endif
                        
                        
                    </div>
                      
                  @endforeach

                    {{-- <div class="suggested-user">
                        <div class="user-info">
                            <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80"
                                alt="User" class="user-avatar-sm">
                            <div>
                                <div class="username" style="font-size: 14px;">Anna Tech</div>
                                <div class="time">Followed by Alex</div>
                            </div>
                        </div>
                        <button class="follow-btn" onclick="followUser(this)">Follow</button>
                    </div> --}}

                </div>
            </div>
        </div>

    @endsection
   