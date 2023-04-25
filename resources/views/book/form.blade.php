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
        <h1 style="margin-bottom: 50px; text-align: center;">{{isset($data['book']) ? 'Обновить' : 'Добавить'}} данные книги</h1>
        <div style="width: 500px; margin: 0 auto;">
            <form method="POST" action="{{ route(isset($data['book']) ? 'book-update' : 'book-add') }}" enctype="multipart/form-data">
            @csrf
                <label for="title">Заголовок</label>
                <input class="form-control" type="text" name="title" value="{{ $data['book']->title ?? (old('title') ?? '') }}">
                <label style="margin-top: 30px;" for="author">Автор</label>
                <input class="form-control" type="text" name="author" value="{{ $data['book']->author ?? (old('author') ?? '') }}">
                <label style="margin-top: 30px;" for="description">Описание</label>
                <input class="form-control" type="text" name="description" value="{{ $data['book']->description ?? (old('description') ?? '') }}">
                <label style="margin-top: 30px;" for="inputState">Категория</label>
                <select id="inputState" name="category_id" class="form-control">
                    @foreach($data['categories'] as $category)
                        @if (isset($data['book']) && $data['book']->category_id == $category->id)
                            <option selected value="{{ $category->id }}">{{ $category->title }}</option>
                        @elseif(old('category_id') !== null && old('category_id') == $category->id)
                            <option selected value="{{ $category->id }}">{{ $category->title }}</option>   
                        @else
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @endif
                    @endforeach
                </select>
                <label style="margin-top: 30px;" for="cover">Загрузить изображение обложки</label>
                <input type="file" class="form-control-file" name="cover" id="cover">
                <input type="hidden" name="updating_id" value="{{ $data['book']->id ?? '' }}">
                <button style="margin-top: 30px; float: right;" type="submit" class="btn btn-primary top-right-button">{{isset($data['book']) ? 'Обновить' : 'Добавить'}}</button>
            </form>
        </div>
    </div>
@endsection