@extends('layout.layout')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-start py-3">
            <a href="{{ url('/') }}" class="btn btn-secondary">Back</a>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-12">
                <div class="card my-3">
                    <div class="card-header">
                        # {{ $post->category->name }}
                    </div>
                    <div class="text-center">
                        <img src="{{ route('displayBlogImage', $post->img_path) }}" class="card-img-top cardImg" />
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-center">{{ $post->title }} <span class="authorName">By {{ $post->user->name }}</span> </h5>
                        <p class="card-text"><span>{{ $post->content }}</span></p>
                    </div>
                </div>
                <div>
                    <form action="{{url('/posts/'. $post->id .'/comments/')}}" method="POST">
                        <div class="input-group mb-3">
                            @csrf
                            <input type="text" class="form-control" placeholder="Write Comment" name="comment">
                            <div class="input-group-append">
                                <button class="btn btn-outline-success">Add Comment</button>
                            </div>
                        </div>
                    </form>
                    <h4>Comments</h4>
                    @foreach ($post->comments as $comment)
                        <div class="alert alert-secondary" role="alert">
                            <div>
                                <h5><b class="text-lg">{{ $comment->user->name }}:</b> </h5>
                            </div>
                            <p>{{ $comment->text }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
@endsection
