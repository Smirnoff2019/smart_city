@extends('Admin.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>SmartCity - CRUD пользователей </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('Admin.users.create') }}"> Add User </a>
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
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Created_at</th>
            <th>Updated_at</th>
            <th style="width: 280px">Action</th>
        </tr>
        @foreach ($paginator as $user)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->created_at }}</td>
                <td>{{ $user->updated_at }}</td>
                <td>
                    <form action="{{ route('Admin.users.destroy', $user->id) }}" method="POST">

                        <a class="btn btn-info" href="{{ route('Admin.users.show', $user->id) }}">Show</a>

                        <a class="btn btn-primary" href="{{ route('Admin.users.edit', $user->id) }}">Edit</a>

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
