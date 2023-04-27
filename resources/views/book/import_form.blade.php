@extends('layouts.app')

@section('content')
    <div class="container">
        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ $error }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>   
            @endforeach
        @endif
        @if (\Session::has('response'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ \Session::get('response') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <h1 style="margin-bottom: 50px; text-align: center;">Импорт данных о книгах из XLS-файла</h1>
        <div style="width: 500px; margin: 0 auto;">
            <form method="POST" action="{{ route('book-import-xls') }}" enctype="multipart/form-data">
            @csrf
                <label style="margin-top: 30px;" for="xls_file">Загрузить XLS-файл</label>
                <input type="file" class="form-control-file" name="xls_file" id="xls_file">
                <button style="margin-top: 30px; float: right;" type="submit" class="btn btn-primary top-right-button">Импортировать</button>
            </form>
        </div>
    </div>
@endsection