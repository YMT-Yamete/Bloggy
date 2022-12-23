@extends('layout.adminLayout')

@section('content')
    <div class="container p-5">
        <div class="d-flex justify-content-between">
            <h3>User edit form</h3>
            <a href="{{ url('/users') }}" class="btn btn-secondary">Back</a>
        </div>
        <hr>
        <form action="{{ url('/users/' . $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title">Name</label>
                <input type="text" value="{{ old('name') ?? $user->name }}"
                    class="form-control @error('name') is-invalid @enderror" name="name">
                @error('name')
                    <span class="text-danger"> {{ $message }} </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email">Email</label>
                <input type="email" value="{{ old('email') ?? $user->email }}"
                    class="form-control @error('email') is-invalid @enderror" name="email">
                @error('email')
                    <span class="text-danger"> {{ $message }} </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="phone">Phone</label>
                <input type="phone" value="{{ old('phone') ?? $user->phone }}"
                    class="form-control @error('phone') is-invalid @enderror" name="phone">
                @error('phone')
                    <span class="text-danger"> {{ $message }} </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="address">Address</label>
                <textarea rows="4" class="form-control @error('title') is-invalid @enderror" name="address">{{ old('address') ?? $user->address }}</textarea>
                @error('address')
                    <span class="text-danger"> {{ $message }} </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="role">Role</label>
                <select type="text" value="{{ old('role') ?? $user->role }}"
                    class="form-control @error('role') is-invalid @enderror" name="role">
                    <option disabled="disabled">Select role</option>
                    @foreach ($roles as $role)
                        <option value={{ $role }}
                            {{ old('role') == $role ? 'selected' : ($user->role == $role ? 'selected' : '') }}>
                            {{ $role }}</option>
                    @endforeach
                </select>
                @error('role')
                    <span class="text-danger"> {{ $message }} </span>
                @enderror
            </div>
            <div class="mb-3">
                <input type="submit" class="btn btn-primary">
            </div>
        </form>
    </div>
@endsection
