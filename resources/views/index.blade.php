@extends('layout')

@section('content')

    @if($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{$message}}</p>
        </div>
    @endif

    <div class="row">
        <div class="col-md-6">
            <h1>CRUD Laravel 5.8</h1>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ action('PostController@create') }}" class="btn btn-primary">Tambah Data</a>
        </div>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <td>No</td>
                <td>Name</td>
                <td>Detail</td>
                <td>Author</td>
                <td>Action</td>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
            <tr>
                <td>{{ $post->id }}</td>
                <td>{{ $post->name }}</td>
                <td>{{ $post->detail }}</td>
                <td>{{ $post->author }}</td>
                <td>
                    <form action="{{ action('PostController@destroy', $post->id) }}" method="post">
                        <a href="{{ action('PostController@show', $post->id) }}" class="btn btn-info btn-sm"><i class="fas fa-search"></i></a>
                        <a href="{{ action('PostController@edit', $post->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>

                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

@endsection
