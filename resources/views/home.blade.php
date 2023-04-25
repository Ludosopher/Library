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
    <div class="card mb-3" style="max-width: 1000px;">
        <div class="row no-gutters">
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">{{ $user->name }}</h5>
                    <h6 class="card-title" style="font-weight: bold;">{{ $user->email }}</h6>
                </div>
                <div style="display: flex; justify-content: end;">
                    <a class="nav-item nav-link active" href="{{ route('user-form') }}" style="text-align: end;">Изменить</a>
                    <a class="nav-item nav-link active" href="{{ route('user-delete') }}" style="text-align: end;">Удалить</a>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div> --}}
</div>
@endsection
