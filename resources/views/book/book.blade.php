@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card mb-3" style="max-width: 1000px;">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <img src="{{ asset('storage/covers/'.$book->cover) }}" class="card-img" alt="cover" height="500" width="250">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{ $book->title }}</h5>
                        <h6 class="card-title" style="font-weight: bold;">{{ $book->author }}</h6>
                        <p class="card-text">{{ $book->description }}</p>
                        <p class="card-text"><small class="text-muted">{{ $book->category->title }}</small></p>
                    </div>
                    <div style="display: flex; justify-content: end;">
                        <a class="nav-item nav-link active" href="{{ route('book-form', ['slug' => $book->slug]) }}" style="text-align: end;">Изменить</a>
                        <a class="nav-item nav-link active" href="{{ route('book-form', ['slug' => $book->slug]) }}" style="text-align: end;">Удалить</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection