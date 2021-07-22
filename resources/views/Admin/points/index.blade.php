@extends('Admin.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>SmartCity - CRUD точек </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('Admin.points.create') }}"> Create New Point</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Comment</th>
            <th>Type</th>
            <th>Image</th>
            <th>Latitude</th>
            <th>Longitude</th>
            <th>Tag</th>
            <th>Created_at</th>
            <th>Updated_at</th>
            <th style="width: 280px">Action</th>
        </tr>
        @foreach ($paginator as $point)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $point->comment }}</td>
                <td>{{ $point->type }}</td>
                <td>{{ $point->image }}</td>
                <td>{{ $point->latitude }}</td>
                <td>{{ $point->longitude }}</td>
                <td>{{ $point->tags()->pluck('title')->implode(', ') or ''}}</td>
                <td>{{ $point->created_at }}</td>
                <td>{{ $point->updated_at }}</td>
                <td>
                    <form action="{{ route('Admin.points.destroy', $point->id) }}" method="POST">

                        <a class="btn btn-info" href="{{ route('Admin.points.show', $point->id) }}">Show</a>

                        <a class="btn btn-primary" href="{{ route('Admin.points.edit', $point->id) }}">Edit</a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {!! $paginator->links() !!}

@endsection
