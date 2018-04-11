@extends('layouts.admin')

@section('title')All User Page @stop


@section('content')

    @if(Session::has('user_created'))
        <div class="alert alert-success text-center">
            {{session('user_created')}}
        </div>
    @endif
    @if(Session::has('user_updated'))
        <div class="alert alert-success text-center">
            {{session('user_updated')}}
        </div>
    @endif
    @if(Session::has('user_delete'))
        <div class="alert alert-danger text-center">
            {{session('user_delete')}}
        </div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Photo</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
        </thead>
        <tbody>
        @if($users)
            @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>
                        <div class="thumbnail">
                        @if($user->photo_id)
                            <img src="{{$user->photo->file}}" alt="" width="80px" height="80px">
                        @else
                            <img src="http://via.placeholder.com/80x80" alt="">
                        @endif
                        </div>
                    </td>
                    <td><a href="{{route('admin.users.edit', $user->id)}}">{{$user->name}}</a></td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->role->name}}</td>
                    <td>{{$user->is_active == 1 ? 'Active' : 'Not Active'}}</td>
                    <td>{{$user->created_at->diffForHumans()}}</td>
                    <td>{{$user->updated_at->diffForHumans()}}</td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
@endsection