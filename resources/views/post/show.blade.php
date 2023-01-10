@extends('layout.layout')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-start py-3 divEightyPercent">
            <a href="{{ url('/') }}" class="btn btn-secondary">Back</a>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-12">
                <div class="card my-3">
                    <div class="card-header text-center">
                        # {{ $post->category->name }}
                    </div>
                    <div class="text-center">
                        <img src="{{ route('displayBlogImage', $post->img_path) }}" class="card-img-top cardImg" />
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-center mb-4">{{ $post->title }} <span class="authorName">By
                                {{ $post->user->name }} <br> Upload Date: {{ $post->user->created_at }} </span></h5>
                        <p class="card-text"><span>{{ $post->content }}</span></p>
                    </div>
                    <div class="mb-2 d-flex">
                        <form action="{{ url('/posts/' . $post->id . '/like/') }}" method="POST" class="mx-2">
                            @csrf
                            <button class="btn btn-primary"><i class="fa fa-thumbs-up"
                                    @if ($reactedReaction == 'Like') style="color:rgb(4, 255, 4);" @endif>
                                    {{ count($likes) }}</i> </button>
                        </form>
                        <form action="{{ url('/posts/' . $post->id . '/dislike/') }}" method="POST" class="mx-2">
                            @csrf
                            <button class="btn btn-danger"><i class="fa fa-thumbs-down" @if ($reactedReaction == 'Dislike') style="color:rgb(4, 255, 4);" @endif> {{ count($dislikes) }}</i>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="divEightyPercent">
                    <form action="{{ url('/posts/' . $post->id . '/comments/') }}" method="POST">
                        <div class="input-group mb-3">
                            @csrf
                            <input type="text" class="form-control" placeholder="Write Comment" name="comment">
                            <div class="input-group-append">
                                <button class="btn btn-success">Add Comment</button>
                            </div>
                        </div>
                    </form>
                    <h4 class="pb-4">Comments ({{ $comments->count() }})</h4>
                    @if ($comments->count() <= 0)
                        <h6 class="text-center p-5">No comments yet.</h6>
                        <hr>
                    @endif
                    @foreach ($comments as $comment)
                        <div class="commentDiv pb-2" role="alert">
                            <div>
                                <h5><b class="text-lg">{{ $comment->user->name }}:</b> </h5>
                            </div>
                            <p>{{ $comment->text }}</p>
                            <hr>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
