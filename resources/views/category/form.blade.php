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
        <h1 style="margin-bottom: 50px; text-align: center;">{{$category ? 'Обновить' : 'Добавить'}} данные категории</h1>
        <div style="width: 500px; margin: 0 auto;">
            <form method="POST" action="{{ route($category ? 'category-update' : 'category-add') }}" enctype="multipart/form-data">
            @csrf
                <label for="title">Заголовок</label>
                <input class="form-control" type="text" name="title" value="{{ $category->title ?? (old('title') ?? '') }}">
                <input type="hidden" name="updating_id" value="{{ $category->id ?? '' }}">
                <button style="margin-top: 30px; float: right;" type="submit" class="btn btn-primary top-right-button">{{ $category ? 'Обновить' : 'Добавить' }}</button>
            </form>
        </div>
    </div>
@endsection