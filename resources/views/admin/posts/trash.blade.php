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

<h2>List of trash posts</h2>

<div class="container">
    <div class="col-lg-12">
        <br>
        <table id="tabledata" class=" table table-striped table-hover table-bordered">

            <thead>
                <tr class="bg-dark text-white text-center">
                    <th>Index </th>
                    <th>Category_Name </th>
                    <th>Post_title</th>
                    <th>Post_body</th>
                    <th>Post_by</th>
                    <th>Restore</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($posts as $key => $post)
                    <tr>
                        <td>
                            {{ $key }}
                        </td>
                        <td>
                            {{ $post->category->category_type }}
                        </td>
                        <td>
                            {{ $post->title }}
                        </td>
                        <td>
                            {{ $post->body }}
                        </td>
                        <td>
                            {{ $post->user->name }}
                        </td>
                        <td>
                            <a href="{{ route('restorePost', ['post' => $post]) }}">
                                <button class="btn btn-success" type="submit">Restore</button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endsection
