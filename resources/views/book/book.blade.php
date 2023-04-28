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
    @php $book = $data['book']; @endphp
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
                        <a class="nav-item nav-link active" href="{{ route('book-delete', ['slug' => $book->slug]) }}" style="text-align: end;">Удалить</a>
                    </div>
                </div>
            </div>
        </div>

        <h2 style="margin-bottom: 20px; text-align: center;">Комментарии</h2>
        <div class="row d-flex justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-0 border" style="background-color: #f0f2f5;">
                    <div class="card-body p-4">
                        
                        <div style="padding-bottom: 50px;">
                            <form method="POST" action="{{ route('book-comment-add') }}">
                            @csrf
                                <div class="form-outline mb-4">
                                    <textarea class="form-control" id="content" name="content" rows="2" placeholder="Здесь пишите комментарий ..."></textarea>
                                    <input type="hidden" name="user_id" value="{{ $data['user_id'] }}">
                                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                                </div>
                                <button type="submit" class="btn btn-primary" style="float: right; margin: 0px;">Добавить</button>
                            </form>
                        </div>
                        @foreach($book->comments()->orderByDesc('created_at')->get() as $comment)
                            <div class="card mb-4">
                                <div class="card-body">
                                    <p>{{ $comment->content }}</p>

                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex flex-row align-items-center">
                                            <p class="small mb-0 ms-2">{{ $comment->user->name }}</p>
                                        </div>
                                        <div class="d-flex flex-row align-items-center">
                                            <p class="small text-muted mb-0">{{ date('Y-m-d H:i', strtotime($comment->created_at)) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>    
                        @endforeach
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection