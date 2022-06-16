@extends('admin.master')

@section('content')
    <div class="col-lg-6 m-auto">

        <form method="post" action="{{ url('/admin/users/' . $user) }}">
            @csrf
            @method('put')
            <br><br>
            <div class="card">
                <div class="card-header bg-dark">
                    <h1 class="text-white text-center"> Update User Data </h1>
                </div><br>

                <label><b>Name:</b></label>
                <input type="text" name="name" class="form-control" value="{{ $user->name }}"> <br>

                <label><b>Email:</b></label>
                <input type="email" name="email" class="form-control" value="{{ $user->email }}"> <br>

                <button type="submit" class="btn btn-success">Update</button>

            </div>
        </form>
    @endsection
