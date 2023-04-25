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
        <h1 style="margin-bottom: 50px; text-align: center;">Обновить свои данные</h1>
        <div style="width: 500px; margin: 0 auto;">
            <form method="POST" action="{{ route('user-update') }}">
            @csrf
                <label for="name">Имя</label>
                <input class="form-control" type="text" name="name" value="{{ $user->name ?? (old('name') ?? '') }}">
                <label style="margin-top: 30px;" for="email">Электронная почта</label>
                <input class="form-control" type="text" name="email" value="{{ $user->email ?? (old('email') ?? '') }}">
                <label style="margin-top: 30px;" for="password">Пароль</label>
                <input class="form-control" type="text" name="password" value="">
                <input type="hidden" name="updating_id" value="{{ $user->id ?? '' }}">
                <button style="margin-top: 30px; float: right;" type="submit" class="btn btn-primary top-right-button">Обновить</button>
            </form>
        </div>
    </div>
@endsection