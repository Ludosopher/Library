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
        <h1 style="margin-bottom: 50px;">Категории</h1>
        @if(isset($categories) && is_iterable($categories))
            <div class="row row-cols-1 row-cols-md-4">
                @foreach($categories as $category)
                    @if(is_object($category))
                        <div class="col mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $category->title }}</h5>
                                </div>
                                <a class="nav-item nav-link active" href="{{ route('category', ['slug' => $category->slug]) }}" style="text-align: end;">Смотреть</a>
                            </div>
                        </div>    
                    @endif
                @endforeach
            </div>
        @endif
        <div class="nav-pagination">
            {{ $categories->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection