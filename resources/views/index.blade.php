@extends('layout.layout')

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">
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
                            <h5 class="card-title text-center">{{ $post->title }}</h5>
                            <p class="card-text"><span class="limitedContent">{{ $post->content }}</span></p>
                            <div class="text-center">
                                <a href="{{ url('/posts/' . $post->id . '/show') }}" class="btn btn-primary">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
