@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card mb-3" style="max-width: 1000px;">
            <div class="row no-gutters">
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{ $category->title }}</h5>
                    </div>
                    <div style="display: flex; justify-content: end;">
                        <a class="nav-item nav-link active" href="{{ route('category-form', ['slug' => $category->slug]) }}" style="text-align: end;">Изменить</a>
                        <a class="nav-item nav-link active" href="{{ route('category-delete', ['slug' => $category->slug]) }}" style="text-align: end;">Удалить</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection