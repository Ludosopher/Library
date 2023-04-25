@extends('layouts.app')

@section('content')
    <div class="container">
        @if (\Session::has('response'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ \Session::get('response') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <h1 style="margin-bottom: 50px;">Книги</h1>
        <form method="POST" action="{{ route('books') }}">
        @csrf
            <div class="form-group col-md-4" style="display: flex; justify-content: start;">
                <div>
                    <label for="inputState">Категория</label>
                    <select id="inputState" name="category_id" class="form-control">
                        <option value="">Все</option>
                        @foreach($data['categories'] as $category)
                            @if(old('category_id') !== null && old('category_id') == $category->id)
                                <option selected value="{{ $category->id }}">{{ $category->title }}</option>   
                            @else
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary top-right-button" style="height: 40px; margin-top: 30px; margin-left: 10px;">Показать</button>
            </div>
        </form>
        @if(isset($data['books']) && is_iterable($data))
            <div class="row row-cols-1 row-cols-md-4">
                @foreach($data['books'] as $book)
                    @if(is_object($book))
                        <div class="col mb-4">
                            <div class="card">
                                <img src="{{ asset('storage/covers/'.$book->cover) }}" class="card-img-top" alt="cover" height="350">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $book->title }}</h5>
                                    <h6 class="card-title" style="font-weight: bold;">{{ $book->author }}</h6>
                                </div>
                                <a class="nav-item nav-link active" href="{{ route('book', ['slug' => $book->slug]) }}" style="text-align: end;">Смотреть</a>
                                <div class="card-footer">
                                    <small class="text-muted">{{ $book->category->title }}</small>
                                </div>
                            </div>
                        </div>    
                    @endif
                @endforeach
            </div>
        @endif
        <div class="nav-pagination">
            {{ $data['books']->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection