@extends('layouts.admin')

@section('title')Replies for Comment : {{$comment->comment}} @stop

@section('content')

    @if(Session::has('delete_reply'))
        <div class="alert alert-danger">
            {{session('delete_reply')}}
        </div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Author</th>
                <th>Email</th>
                <th>Reply</th>
                <th>Status</th>
                <th>Create Date</th>
                <th>View Post</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @if($replies)
            @foreach($replies as $reply)
                <tr>
                    <td>{{$reply->id}}</td>
                    <td>{{$reply->user->name}}</td>
                    <td>{{$reply->user->email}}</td>
                    <td>{{$reply->reply}}</td>
                    <td>{{$reply->is_active == 1 ? 'Approved' : 'Not Approved'}}</td>
                    <td>{{$reply->created_at->diffForHumans()}}</td>
                    <td><a href="{{route('home.post', $reply->comment->post->id)}}">View Post</a></td>
                    <td>
                        @if($reply->is_active == 0)
                            {!! Form::open(['method' => 'PATCH', 'action' => ['CommentRepliesController@update', $reply->id]]) !!}
                            <input type="hidden" name="is_active" value="1">
                            <div class="form-group">
                                {{Form::submit('Approve', ['class'  => 'btn btn-primary'])}}
                            </div>
                            {!! Form::close() !!}
                        @else
                            {!! Form::open(['method' => 'PATCH', 'action' => ['CommentRepliesController@update', $reply->id]]) !!}
                            <input type="hidden" name="is_active" value="0">
                            <div class="form-group">
                                {{Form::submit('Unapprove', ['class'  => 'btn btn-warning'])}}
                            </div>
                            {!! Form::close() !!}
                        @endif
                    </td>
                    <td>
                        {!! Form::open(['method' => 'DELETE', 'action' => ['CommentRepliesController@destroy', $reply->id]]) !!}
                        <div class="form-group">
                            {{Form::submit('Delete', ['class'  => 'btn btn-danger'])}}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
@endsection