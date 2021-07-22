@extends('layout.blade')

@section('content')
    <div class="container">
        <h3>вариант изображения</h3>
        <form action="{{ route('upload') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="form-group">
                <input type="file" name="pictures">
            </div>
            <button class="btn btn-default" type="submit">Upload</button>
        </form>
        @isset($path)
            <img class="img-fluid" src="{{ asset('/storage/', $path) }}" alt="">
        @endisset
    </div>
