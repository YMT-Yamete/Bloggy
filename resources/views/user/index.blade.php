@extends('layout.adminLayout')

@section('content')
    <div class="container p-5">
        <div class="d-flex justify-content-between">
            <h3>Users List</h3>
            <a href="{{ url('/users/create/') }}" class="btn btn-primary">Add new user</a>
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
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->address }}</td>
                            <td>{{ $user->role }}</td>
                            <td>
                                <form action="{{ url('users/' . $user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ url('users/' . $user->id . '/edit') }}" class="btn btn-info">Edit</a>
                                    <button class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $users->links() }}
        </div>
    </div>
@endsection
