@extends('layouts.admin')

@section('title')All Comments @stop

@section('content')

    @if(Session::has('delete_comment'))
        <div class="alert alert-danger">
            {{session('delete_comment')}}
        </div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Author</th>
                <th>Email</th>
                <th>Comment</th>
                <th>Status</th>
                <th>Create Date</th>
                <th>Post</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @if($comments)
            @foreach($comments as $comment)
                <tr>
                    <td>{{$comment->id}}</td>
                    <td>{{$comment->user->name}}</td>
                    <td>{{$comment->user->email}}</td>
                    <td>{{$comment->comment}}</td>
                    <td>{{$comment->is_active == 1 ? 'Active' : 'Not Active'}}</td>
                    <td>{{$comment->created_at->diffForHumans()}}</td>
                    <td>
                        <a href="{{route('home.post', $comment->post->id)}}">View Post</a><br>
                        <a href="{{route('admin.comment.replies.show', $comment->id)}}">View Replies</a>
                    </td>
                    <td>
                        @if($comment->is_active == 0)
                            {!! Form::open(['method' => 'PATCH', 'action' => ['PostCommentsController@update', $comment->id]]) !!}
                                <input type="hidden" name="is_active" value="1">
                                <div class="form-group">
                                    {{Form::submit('Approve', ['class'  => 'btn btn-primary'])}}
                                </div>
                            {!! Form::close() !!}
                        @else
                            {!! Form::open(['method' => 'PATCH', 'action' => ['PostCommentsController@update', $comment->id]]) !!}
                                <input type="hidden" name="is_active" value="0">
                                <div class="form-group">
                                    {{Form::submit('Unapprove', ['class'  => 'btn btn-warning'])}}
                                </div>
                            {!! Form::close() !!}
                        @endif
                    </td>
                    <td>
                        {!! Form::open(['method' => 'DELETE', 'action' => ['PostCommentsController@destroy', $comment->id]]) !!}
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