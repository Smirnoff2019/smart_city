@extends('Admin.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Редактирование данных пользователя </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('Admin.users.index') }}"> Back </a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('Admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('POST')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <label>
                        <input name="name" value="{{ $user->name }}" class="form-control" placeholder="User name">
                    </label>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email:</strong>
                    <label>
                        <input name="email" value="{{ $user->email }}" class="form-control" placeholder="User email">
                    </label>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Phone:</strong>
                    <label>
                        <input name="phone" value="{{ $user->phone }}" class="form-control" placeholder="User phone">
                    </label>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Edit user</button>
            </div>
        </div>
    </form>
@endsection
