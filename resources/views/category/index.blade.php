@extends('layout.adminLayout')

@section('content')
    <div class="container p-5">
        <div class="d-flex justify-content-between">
            <h3>Categories List</h3>
            <a href="{{ url('/categories/create/') }}" class="btn btn-primary">Add new category</a>
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
                        <th>Name</th>
                        <th>Posts</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                                @foreach ($category->posts as $post)
                                    <div>{{ $post->title }}</div>
                                    <hr>
                                @endforeach
                            </td>
                            <td>
                                <form action="{{ url('/categories/' . $category->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ url('/categories/' . $category->id . '/edit') }}"
                                        class="btn btn-info">Edit</a>
                                    <button class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $categories->links() }}
        </div>
    </div>
@endsection
