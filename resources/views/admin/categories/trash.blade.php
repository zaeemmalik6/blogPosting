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
    </style>
@endsection

<br><br>

<h2>List of trash categories</h2>

<div class="container">
    <div class="col-lg-12">
        <br>
        <table id="tabledata" class=" table table-striped table-hover table-bordered">

            <thead>
                <tr class="bg-dark text-white text-center">
                    <th>Index</th>
                    <th>Category_Name </th>
                    <th>Added_by</th>
                    <th>Restore</th>
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
                        <td>
                            <a href="{{ route('restoreCategory', ['category' => $category]) }}">
                                <button class="btn btn-success" type="submit">Restore</button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>

    @endsection
