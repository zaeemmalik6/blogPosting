@extends('admin.master')

@section('content')

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

<br>
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

@if (session()->has('message3'))
    <div id='msg' class='alert alert-success'>
        {{ session()->get('message3') }}
    </div>
@endif

<br>

<h2>List of categories</h2>

<div class="container">
    <div class="col-lg-12">
        <br>
        <table id="tabledata" class=" table table-striped table-hover table-bordered">

            <thead>
                <tr class="bg-dark text-white text-center">
                    <th>Index</th>
                    <th>Category_Name </th>
                    <th>Added_by</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($categories as $key => $category)
                    <tr>
                        <td>
                            {{ $key }}
                        </td>
                        <td>
                            {{ $category->category_type }}
                        </td>
                        <td>
                            {{ $category->user->name }}
                        </td>
                        <td><a href="{{ url('/admin/categories/' . $category->id . '/edit') }}"
                                class="btn btn-success">Update</a>
                        </td>
                        <td>
                            <form method="POST" action="{{ url('/admin/categories/' . $category) }}" method="delete">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                {{-- {{ $categories->links('pagination::bootstrap-4') }} --}}
            </tbody>

        </table>
        {{ $categories->links('pagination::bootstrap-4') }}

        <div class="w-100 d-flex justify-content-center p-3">
            <a href="{{ url('/admin/categories/create') }}" class="btn btn-success">Add a
                new category</a>
        </div>

        <div class="w-100 d-flex justify-content-center p-3">
            <a href="{{ route('trashCategories') }}" class="btn btn-success">Restore deleted category</a>
        </div>

    @endsection
