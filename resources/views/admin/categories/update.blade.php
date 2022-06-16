@extends('admin.master')

@section('content')
    <div class="col-lg-6 m-auto">

        <form method="POST" action="{{ url('/admin/categories/' . $category) }}">
            @csrf
            @method('put')
            <br><br>
            <div class="card">
                <div class="card-header bg-dark">
                    <h1 class="text-white text-center"> Update Category </h1>
                </div><br>

                <label><b>Category_Name:</b></label>
                <input type="text" name="category_type" class="form-control" value="{{ $category->category_type }}">
                <br>

                <button type="submit" class="btn btn-success">Update</button>

            </div>
        </form>

        </body>

        </html>
    @endsection
