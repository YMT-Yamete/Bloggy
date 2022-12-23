@extends('layout.adminLayout')

@section('content')
    <div class="container p-5">
        <div class="d-flex justify-content-between">
            <h3>Category edit form</h3>
            <a href="{{ url('/categories') }}" class="btn btn-secondary">Back</a>
        </div>
        <hr>
        <form action="{{ url('/categories/' . $category->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name">Name</label>
                <input type="text" value="{{ old('name') ?? $category->name }}"
                    class="form-control @error('name') is-invalid @enderror" name="name">
                @error('name')
                    <span class="text-danger"> {{ $message }} </span>
                @enderror
            </div>
            <div class="mb-3">
                <input type="submit" class="btn btn-primary">
            </div>
        </form>
    </div>
@endsection
