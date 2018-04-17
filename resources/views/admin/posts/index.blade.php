@extends('layouts.admin')

@section('title')All Posts Page @stop


@section('content')
    @if(Session::has('post_created'))
        <div class="alert alert-success text-center">
            {{session('post_created')}}
        </div>
    @endif
    @if(Session::has('post_updated'))
        <div class="alert alert-success text-center">
            {{session('post_updated')}}
        </div>
    @endif
    @if(Session::has('post_delete'))
        <div class="alert alert-danger text-center">
            {{session('post_delete')}}
        </div>
    @endif

    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Photo</th>
            <th>Content</th>
            <th>Post Owner</th>
            <th>Category</th>
            <th>Created At</th>
            <th>Updated At</th>
        </thead>
        <tbody>
        @if($posts)
            @foreach($posts as $post)
                <tr>
                    <td>{{$post->id}}</td>
                    <td><a href="{{route('admin.posts.edit', $post->id)}}">{{$post->title}}</a></td>
                    <td>
                        <div class="thumbnail">
                            @if($post->photo_id)
                                <img src="{{$post->photo->file}}" alt="" width="70px" height="70px">
                            @else
                                <img src="http://via.placeholder.com/70x70" alt="">
                            @endif
                        </div>
                    </td>
                    <td width="240px">{{str_limit($post->content, 90, ' ...')}}</td>
                    <td>{{$post->user->name}}</td>
                    <td>{{$post->category->name}}</td>
                    <td>{{$post->created_at->diffForHumans()}}</td>
                    <td>{{$post->updated_at->diffForHumans()}}</td>
                    <td>
                        <a href="{{route('home.post', $post->id)}}">View Post</a><br>
                        <a href="{{route('admin.comments.show', $post->id)}}">Comments</a>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>

    <div class="row">
        <div class="col-md-8 col-md-offset text-center">
            {{$posts->links()}}
        </div>
    </div>
@endsection