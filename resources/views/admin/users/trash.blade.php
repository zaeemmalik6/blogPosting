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
    </style>
@endsection

@section('content')
    <br><br>

    <h2>List of trashed users</h2>

    <div class="container">
        <div class="col-lg-12">
            <br>
            <table id="tabledata" class=" table table-striped table-hover table-bordered">

                <thead>
                    <tr class="bg-dark text-white text-center">
                        <th>Index</th>
                        <th>User Name </th>
                        <th>User Email</th>
                        <th>Restore</th>
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
                                <a href="{{ route('restoreUser', ['user' => $user]) }}">
                                    <button class="btn btn-success" type="submit">Restore</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endsection
