@extends('layouts.admin')

@section('title')Edit Post Page @stop


@section('content')
    <div class="row">
        @include('includes.form_error')
        <div class="col-md-4">
            <div class="image-wrapper">
                @if($post->photo_id)
                    <img src="{{$post->photo->file}}" alt="" class="img-responsive img-rounded">
                @else
                    <img src="http://via.placeholder.com/300x300" alt="" class="img-responsive img-rounded">
                @endif
            </div><br><br>
            {!! Form::open(['method' => 'DELETE', 'action' => ['AdminPostController@destroy', $post->id]]) !!}
            <div class="form-group">
                {{Form::submit('Delete Post', ['class'  => 'btn btn-danger btn-block'])}}
            </div>
            {!! Form::close() !!}
        </div>
        <div class="col-md-8">
            {!! Form::model($post, ['method' => 'PATCH', 'action' => ['AdminPostController@update', $post->id], 'files' => true]) !!}
            <div class="form-group">
                {{Form::label('title', 'Post Title')}}
                {{Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Enter post title'])}}
            </div>
            <div class="form-group">
                {{Form::label('content', 'Post Content')}}
                {{Form::textarea('content', null, ['class' => 'form-control', 'placeholder' => 'Enter some post content here', 'rows' => 6])}}
            </div>
            <div class="form-group">
                {{Form::label('category_id', 'Post Category')}}
                {{Form::select('category_id', $categories, null, ['class' => 'form-control', 'placeholder' => 'Please chose a cetegory'])}}
            </div>
            <div class="form-group">
                {{Form::label('photo_id', 'Select Post Image')}}
                {{Form::file('photo_id', ['class' => 'form-control'])}}
            </div>
            <div class="form-group">
                {{Form::submit('Update Post', ['class'  => 'btn btn-primary btn-block'])}}
            </div>
        </div>
    </div>

    {!! Form::close() !!}






@endsection