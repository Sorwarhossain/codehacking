@extends('layouts.blog-post')

@section('title'){{$post->title}} @stop

@section('content')
    <!-- Author -->
    <p class="lead">
        by <a href="#">{{$post->user->name}}</a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> Posted on {{$post->created_at->toDayDateTimeString()}}</p>

    <hr>

    <!-- Preview Image -->
    @if($post->photo)
        <img class="img-responsive" src="{{$post->photo->file}}" alt="">
    @else
        <img class="img-responsive" src="http://placehold.it/900x300" alt="">
    @endif


    <hr>

    <!-- Post Content -->
    <p>{{$post->content}}</p>

    <hr>

    <!-- Blog Comments -->

    @if(Session::has('comment_created'))
        <div class="alert alert-success text-center">
            {{session('comment_created')}}
        </div>
    @endif
    @if(Session::has('reply_created'))
        <div class="alert alert-success text-center">
            {{session('reply_created')}}
        </div>
    @endif

    @if(Auth::check())
    <!-- Comments Form -->
    <div class="well">
        <h4>Leave a Comment:</h4>

        {!! Form::open(['method' => 'POST', 'action' => 'PostCommentsController@store']) !!}
            <input type="hidden" name="post_id" value="{{$post->id}}">
            <div class="form-group">
                {{Form::textarea('comment', null, ['class' => 'form-control', 'placeholder' => 'Enter Your Comment', 'rows' => 3])}}
            </div>
            <div class="form-group">
                {{Form::submit('Submit Comment', ['class'  => 'btn btn-primary'])}}
            </div>
        {!! Form::close() !!}
    </div>
    <hr>
    @endif

    <!-- Posted Comments -->
    @if(count($comments) > 0)
        @foreach($comments as $comment)
            <!-- Comment -->
            <div class="media">
                <a class="pull-left" href="#">
                    @if($comment->user->photo)
                        <img width="70px" class="media-object" src="{{$comment->user->photo->file}}" alt="">
                    @else
                        <img width="70px" class="media-object" src="http://placehold.it/70x70" alt="">
                    @endif
                </a>
                <div class="media-body">
                    <h4 class="media-heading">{{$comment->user->name}}
                        <small>{{$comment->created_at->toDayDateTimeString()}}</small>
                    </h4>
                    <p>{{$comment->comment}}</p>

                @if($comment->replies)
                    @php
                        $replies = $comment->replies()->whereIsActive(1)->get();
                    @endphp
                    @foreach($replies as $reply)
                        <!-- Nested Comment -->
                            <div class="media">
                                <a class="pull-left" href="#">
                                    @if($reply->user->photo)
                                        <img width="70px" class="media-object" src="{{$reply->user->photo->file}}" alt="">
                                    @else
                                        <img width="70px" class="media-object" src="http://placehold.it/70x70" alt="">
                                    @endif
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">{{$reply->user->name}}
                                        <small>{{$reply->created_at->toDayDateTimeString()}}</small>
                                    </h4>
                                    <p>{{$reply->reply}}</p>
                                </div> <br>



                            </div>
                            <!-- End Nested Comment -->
                        @endforeach
                    @endif
                    <div class="reply_form_wrapper">
                        {!! Form::open(['method' => 'POST', 'action' => 'CommentRepliesController@createReply']) !!}
                        <input type="hidden" name="comment_id" value="{{$comment->id}}">
                        <div class="form-group">
                            {{Form::textarea('reply', null, ['class' => 'form-control', 'placeholder' => 'Enter Your Reply', 'rows' => 2])}}
                        </div>
                        <div class="form-group">
                            {{Form::submit('Submit Reply', ['class'  => 'btn btn-primary'])}}
                        </div>
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        @endforeach
    @endif

@endsection




@section('sidebar')
    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <div class="input-group">
            <input type="text" class="form-control">
            <span class="input-group-btn">
                <button class="btn btn-default" type="button">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
        </div>
        <!-- /.input-group -->
    </div>

    <!-- Blog Categories Well -->
    @if(count($categories) > 0)
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                    @foreach($categories as $category)
                    <li><a href="#">{{$category->name}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <!-- /.row -->
    </div>
    @endif

    <!-- Side Widget Well -->
    <div class="well">
        <h4>Side Widget Well</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
    </div>
@endsection