@extends('admin.master')

@section('content')
    <div class="col-lg-6 m-auto">

        <form method="POST" action="{{ url('/admin/categories/') }}">
            @csrf
            <br><br>
            <div class="card">
                <div class="card-header bg-dark">
                    <h1 class="text-white text-center"> Add Category </h1>
                </div><br>

                <label><b>Category_Name:</b></label>
                <input type="text" name="category_type" class="form-control">
                <br>

                <button type="submit" class="btn btn-success">Add</button>

            </div>
        </form>
    @endsection
