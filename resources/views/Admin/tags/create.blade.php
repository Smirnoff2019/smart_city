@extends('Admin.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Создание нового ориентира </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route( 'Admin.tags.index' ) }}"> Back </a>
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

    <form action="{{ route( 'Admin.tags.store' ) }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Title:</strong>
                    <label>
                        <input name="title" class="form-control" placeholder="Title tag">
                    </label>
                </div>
            </div>
{{--            @foreach ($points as $point)--}}
            <div class="form-check-inline">
                <label class="form-check-label">
                    <input type="text" class="form-check-input" name="point" placeholder="Point comment">
                </label>
            </div>
{{--            @endforeach--}}
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary"> Add Tag </button>
            </div>
        </div>
    </form>
@endsection
