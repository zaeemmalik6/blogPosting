@extends('admin.master')

@section('content')
    <div class="col-lg-6 m-auto">

        <form method="POST" action="{{ url('/admin/posts/') }}">
            @csrf
            <br><br>
            <div class="card">
                <div class="card-header bg-dark">
                    <h1 class="text-white text-center"> Add Post </h1>
                </div><br>

                <label><b>Category:</b></label>
                <select class="form-select" class="form-control" name="category_id">
                    <option value="" disabled selected>Select from below option</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_type }}</option>
                    @endforeach
                </select><br>

                <label><b>Post_title:</b></label>
                <input type="text" name="title" class="form-control">
                <br>

                <label><b>Post_body:</b></label>
                <input type="text" name="body" class="form-control">
                <br>

                <button type="submit" class="btn btn-success">Add</button>

            </div>
        </form>
    @endsection
