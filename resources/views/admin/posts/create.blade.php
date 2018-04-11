@extends('layouts.admin')

@section('title')Create Post Page @stop


@section('content')
    @include('includes.form_error')
    {!! Form::open(['method' => 'POST', 'action' => 'AdminPostController@store', 'files' => true]) !!}
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
        {{Form::submit('Create Post', ['class'  => 'btn btn-primary'])}}
    </div>
    {!! Form::close() !!}
@endsection