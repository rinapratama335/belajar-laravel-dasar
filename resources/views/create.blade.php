@extends('layout');

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            @if($message = Session::get('danger'))
                <div class="alert alert-danger">
                    <strong>{{ $message }}</strong>
                </div>
            @endif

            <form action="{{ action('PostController@store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" name="name" placeholder="Nama Lengkap...">
                </div>
                <div class="form-group">
                    <label>Detail</label>
                    <textarea name="detail" placeholder="Detail..." class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label>Author</label>
                    <input type="text" class="form-control" name="author" placeholder="Pemilik...">
                </div>
                <button class="btn btn-primary">Submit <i class="fas fa-send"></i></button>
            </form>
        </div>
    </div>
@endsection
