@extends('Admin.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Обновление точки </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('Admin.points.index') }}"> Back </a>
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

    <form action="{{ route('Admin.points.update',$point->id) }}" method="POST">
        @csrf
        @method('POST')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Image:</strong>
                    <input name="image" value="{{ $point->image }}" class="form-control" placeholder="Image">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Latitude:</strong>
                    <input name="latitude" value="{{ $point->latitude }}" class="form-control" placeholder="Latitude">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Longitude:</strong>
                    <input name="longitude" value="{{ $point->longitude }}" class="form-control" placeholder="Longitude">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Comment:</strong>
                    <textarea class="form-control" style="height:50px" name="comment" placeholder="Comment">{{ $point->comment }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Type:</strong>
                    <input name="type" value="{{ $point->type }}" class="form-control" placeholder="Type">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group form-check-inline">
                    <strong>Tags:</strong>
                    @foreach ($tags as $tag)
{{--                        <span>{{ $point->$tags()->pluck('title')->implode(', ') }}</span>--}}
                        <!--<input type="checkbox" name="tags []" value="{{$tag->id}}" class="form-control" placeholder="Tags">
                        <label class="">{{ucfirst($tag->title)}}</label>
                        <br>-->
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="tags []" value="{{ $tag->id }}"
                                        @if($point->tags()->where('tag_id', $tag->id)->count())
                                            checked="checked"
                                        @endif
                                    > {{ $tags->title}}

                                </label>
                            </div>
                    @endforeach
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary"> Update </button>
            </div>
        </div>
    </form>
@endsection
