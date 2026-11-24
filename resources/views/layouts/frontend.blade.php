<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soca - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="nav-content">
            <a href="{{route('home')}}" class="logo">Soca<span>.</span></a>

            <div class="nav-links">
                <a href="{{route('home')}}" class="nav-link active">
                    <i class="ri-home-fill"></i> <span style="display: none;">Home</span>
                </a>
                <a href="{{route('post.create')}}" class="nav-link">
                    <i class="ri-add-box-line"></i> <span style="display: none;">Post</span>
                </a>
                <a href="{{route('profile')}}" class="nav-link">
                    

                    <img src="{{asset('uploads/profiles/'.$user->profile->image)}}"
                        alt="Profile" class="user-avatar-sm">
                </a>

                <a class="nav-link" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>




        @yield('content')

































         </main>

    <script src="{{asset('js/script.js')}}"></script>
</body>

</html>