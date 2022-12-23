@extends('layout.adminLayout')

@section('content')
    <div class="container p-5">
        <div class="d-flex justify-content-between">
            <h3>Post create form</h3>
            <a href="{{ url('/posts') }}" class="btn btn-secondary">Back</a>
        </div>
        <hr>
        <form action="{{ url('/posts') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="title">Title</label>
                <input type="text" value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror"
                    name="title">
                @error('title')
                    <span class="text-danger"> {{ $message }} </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="category_id">Category</label>
                <select type="text" class="form-control @error('category_id') is-invalid @enderror" name="category_id">
                    <option selected disabled="disabled">Select category</option>
                    @foreach ($categories as $category)
                        <option value={{ $category->id }} {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <span class="text-danger"> {{ $message }} </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="content">Content</label>
                <textarea rows="4" class="form-control @error('title') is-invalid @enderror" name="content">{{ old('content') }}</textarea>
                @error('content')
                    <span class="text-danger"> {{ $message }} </span>
                @enderror
            </div>
            <div class="mb-3">
                <input type="submit" class="btn btn-primary">
            </div>
        </form>
    </div>
@endsection
