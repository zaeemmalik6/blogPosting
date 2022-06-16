@extends('admin.master')

@section('content')
    <div class="col-lg-6 m-auto">

        <form method="POST" action="{{ url('/admin/posts/' . $post) }}">
            @csrf
            @method('put')
            <br><br>
            <div class="card">
                <div class="card-header bg-dark">
                    <h1 class="text-white text-center"> Update Post </h1>
                </div><br>
                {{-- {{ dd($post->category->id) }} --}}

                <label><b>Update Category:</b></label>
                <select class="form-select" class="form-control" name="category_id">
                    <option value="{{ $post->category->id }}"> {{ $post->category->category_type }}</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_type }}</option>
                    @endforeach
                </select>
                <br>
                <label><b>Update title:</b></label>
                <input type="text" name="title" class="form-control" value="{{ $post->title }}">
                <br>

                <label><b>Update body:</b></label>
                <input type="text" name="body" class="form-control" value="{{ $post->body }}">
                <br>

                <button type="submit" class="btn btn-success">Update</button>

            </div>
        </form>

        </body>

        </html>
    @endsection
