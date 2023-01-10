<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bloggy (Author)</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-dark">
        <div class="container">
            <a class="navbar-brand text-light" href=""><b>Bloggy (Author Dashboard)</b></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
                aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                    <li class="nav-item">
                        <a class="nav-link text-light text-center {{ Route::current()->uri == 'users' ? 'bg-success rounded' : '' }}"
                            href="{{ url('/users/') }}">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light text-center {{ Route::current()->uri == 'categories' ? 'bg-success rounded' : '' }}"
                            href="{{ url('/categories/') }}">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light text-center {{ Route::current()->uri == 'posts' ? 'bg-success rounded' : '' }}"
                            href="{{ url('/posts/') }}">Posts</a>
                    </li>
                </ul>
                <form class="d-flex" method="POST" action="{{ url('/logout') }}">
                    @csrf
                    <table class="tableCenter">
                        <tr>
                            <td>
                                <p style="color: white" class="mt-3 px-5">Welcome {{Auth()->User()->name}}</p>
                            </td>
                            <td>
                                <a class="btn btn-secondary" href="{{ url('/') }}">View as normal user</a>
                                <button class="btn btn-danger">Logout</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </nav>

    @yield('content')

</body>

</html>
