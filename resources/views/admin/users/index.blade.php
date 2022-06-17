@extends('admin.master')

@section('extracss')
    <style>
        h2 {
            text-align: center;
            font-style: italic;
            color: black;
        }

        th {
            font-style: italic;
            color: white !important;
        }

        td {
            text-align: center;
            font-style: italic;
        }

        #msg {
            text-align: center;
            font-style: italic;
        }
    </style>
@endsection

@section('content')
    <br>

    @if (session()->has('error'))
        <div id='msg' class='alert alert-danger'>
            {{ session()->get('error') }}
        </div>
    @endif

    @if (session()->has('message'))
        <div id='msg' class='alert alert-success'>
            {{ session()->get('message') }}
        </div>
    @endif

    @if (session()->has('message1'))
        <div id='msg' class='alert alert-danger'>
            {{ session()->get('message1') }}
        </div>
    @endif

    @if (session()->has('message2'))
        <div id='msg' class='alert alert-success'>
            {{ session()->get('message2') }}
        </div>
    @endif

    <br>
    <h2>List of registered users</h2>

    <div class="container">
        <div class="col-lg-12">
            <br>
            <table id="tabledata" class=" table table-striped table-hover table-bordered">

                <thead>
                    <tr class="bg-dark text-white text-center">
                        <th>Index</th>
                        <th>User Name </th>
                        <th>User Email</th>
                        <th>Reviews</th>
                        <th>Reviews_by</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($users as $key => $user)
                        <tr>
                            <td>
                                {{ $key }}
                            </td>
                            <td>
                                {{ $user->name }}
                            </td>
                            <td>
                                {{ $user->email }}
                            </td>
                            <td>
                                @php
                                    foreach ($user->feedbacks as $feedback) {
                                        echo $feedback->body;
                                        echo '</br>';
                                    }
                                @endphp
                            </td>
                            <td>
                                @php
                                    foreach ($user->feedbacks as $feedback) {
                                        echo $feedback->user->name;
                                        echo '</br>';
                                    }
                                @endphp
                            </td>
                            <td><a href="{{ url('/admin/users/' . $user->id . '/edit') }}"
                                    class="btn btn-success">Update</a>
                            </td>
                            <td>
                                <form method="POST" action="{{ route('users.destroy', $user->id) }}" method="delete">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $users->links('pagination::bootstrap-4') }}

            <div class="w-100 d-flex justify-content-center p-3">
                <a href="{{ route('trashUsers') }}" class="btn btn-success">Restore deleted users</a>
            </div>
        @endsection
