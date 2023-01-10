<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bloggy</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    {{-- icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    @yield('backgroundCss')
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-dark">
        <div class="container">
            <a class="navbar-brand text-light" href=""><b>Bloggy</b></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
                aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                    <li class="nav-item text-center">
                        <a class="nav-link text-light {{ Route::current()->uri == '/' ? 'bg-success rounded' : '' }}"
                            href="{{ url('/') }}">Blogs</a>
                    </li>
                    <li class="nav-item text-center">
                        <a class="nav-link text-light {{ Route::current()->uri == 'about' ? 'bg-success rounded' : '' }}"
                            href="{{ url('/about') }}">About</a>
                    </li>
                </ul>
                @if (!Auth::check())
                    <a href="{{ url('/login') }}" class="btn btn-success">Login</a>
                @else
                    <form action="{{ url('/logout') }}" method="post">
                        @csrf
                        <table class="tableCenter">
                            <tr>
                                <td>
                                    <p style="color: white" class="mt-3 px-5">Welcome {{Auth()->User()->name}}</p>
                                </td>
                                <td>
                                    @if(Auth()->User()->role == "Author")
                                        <a class="btn btn-secondary" href="{{ url('/users') }}">View as author</a>
                                    @endif
                                    <button class="btn btn-danger">Logout</button>
                                </td>
                            </tr>
                        </table>
                    </form>
                @endif
            </div>
        </div>
    </nav>  
    @yield('content')

</body>

</html>
