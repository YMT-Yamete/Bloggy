@extends('layout.layout')

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">
            @foreach ($posts as $post)
                <div class="col-12">
                    <div class="card my-3">
                        <div class="card-header">
                            # {{ $post->category->name }}
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text"><span class="limitedContent">{{ $post->content }}</span></p>
                            <a href="{{ url('/posts/'. $post->id .'/show') }}" class="btn btn-primary">Read More</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection