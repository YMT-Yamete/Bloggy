@extends('layout.adminLayout')

@section('content')
    <div class="container p-5">
        <div class="d-flex justify-content-between">
            <h3>{{ $post->title }}</h3>
        </div>
        <hr>
        <div>
            @if (session()->has('msg'))
                <div class="alert alert-success">
                    <span>{{ session()->get('msg') }}</span>
                    <button data-bs-dismiss="alert" class="btn-close float-end"></button>
                </div>
            @endif
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Comment</th>
                        <th>User</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($comments as $comment)
                        <tr>
                            <td>{{ $comment->id }}</td>
                            <td>{{ $comment->text }}</td>
                            <td>{{ $comment->user->name }}</td>
                            <td>{{ $comment->status }}</td>
                            <td>
                                <form action="{{ url('/posts/'. $post->id .'/comments/' . $comment->id) }}" method="POST">
                                    @csrf
                                    @method("PUT")
                                    @if($comment->status == "Approved")
                                        <button class="btn btn-danger m-1">Deny</button>
                                    @else
                                        <button class="btn btn-success m-1">Approve</button>
                                    @endif
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- {{ $comments->links() }} --}}
        </div>
    </div>
@endsection
