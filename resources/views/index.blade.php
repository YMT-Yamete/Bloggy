@extends('layout.layout')

@section('content')
    <div class="container">
        <div class="divEightyPercent mt-3">
            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling"
                aria-controls="offcanvasScrolling">Filter by Category</button>

            <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1"
                id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Filter by Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <form method="GET" action="{{ url('/') }}">
                        @csrf
                        @foreach ($categories as $category)
                            <div class="mb-3 form-check">
                                <input type="checkbox" value="{{ $category->id }}" name="category_ids[]">
                                <label>{{ $category->name }}</label>
                            </div>
                        @endforeach
                        <div>
                            <button type="submit" class="btn btn-primary filterButton">Filter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            @if (count($posts) == 0)
            <div class="container d-flex justify-content-center align-items-center" style="height: 80vh">
                <h5>There are no posts yet</h5>
            </div>
            @endif
            @foreach ($posts as $post)
                <div class="col-12">
                    <div class="card my-3">
                        <div class="card-header text-center">
                            # {{ $post->category->name }}
                        </div>
                        <div class="text-center">
                            <img src="{{ route('displayBlogImage', $post->img_path) }}" class="card-img-top cardImg" />
                        </div>
                        <hr>
                        <div class="card-body">
                            <h5 class="card-title text-center mb-4">{{ $post->title }}</h5>
                            <p class="card-text"><span class="limitedContent">{{ $post->content }}</span></p>
                            <div class="text-end">
                                <a href="{{ url('/posts/' . $post->id . '/show') }}" class="btn btn-primary">Read More
                                    >>></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="divEightyPercent">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
