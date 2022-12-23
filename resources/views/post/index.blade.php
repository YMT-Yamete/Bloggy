@extends('layout.adminLayout')

@section('content')
    <div class="container p-5">
        <div class="d-flex justify-content-between">
            <h3>Posts List</h3>
            <a href="{{ url('/posts/create/') }}" class="btn btn-primary">Add new post</a>
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
                        <th>Title</th>
                        <th>Category</th>
                        <th>Content</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->category->name }}</td>
                            <td>{{ $post->content }}</td>
                            <td>
                                <form action="{{ url('/posts/' . $post->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <table>
                                        <tr>
                                            <td><a href="{{ url('/posts/' . $post->id . '/edit') }}"
                                                    class="btn btn-info m-1">Edit</a></td>
                                            <td><button class="btn btn-danger m-1">Delete</button></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><a href="{{ url('/posts/' . $post->id . '/comments') }}"
                                                    class="btn btn-warning m-1">View Comments <span
                                                        class="badge text-bg-secondary">{{ count($post->comments) }}</span></a>
                                        </tr>
                                    </table>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $posts->links() }}
        </div>
    </div>
@endsection
