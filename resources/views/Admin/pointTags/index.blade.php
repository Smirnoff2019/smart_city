@extends('Admin.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>SmartCity - CRUD отношений </h2>
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
            <th>Id</th>
            <th>Point_id</th>
            <th>Tag_id</th>
            <th>Created_at</th>
            <th>Updated_at</th>
            <!--<th style="width: 280px">Action</th>-->
        </tr>
        @foreach ($paginator as $user)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $pointTags->id }}</td>
                <td>{{ $pointTags->point_id }}</td>
                <td>{{ $pointTags->tag_id }}</td>
                <td>{{ $pointTags->created_at }}</td>
                <td>{{ $pointTags->updated_at }}</td>
            </tr>
        @endforeach
    </table>

    {!! $paginator->links() !!}

@endsection
