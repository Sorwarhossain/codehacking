@extends('layouts.admin')

@section('title')Edit Category @stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            @include('includes.form_error')
            {!! Form::model($category, ['method' => 'PATCH', 'action' => ['AdminCategoriesController@update', $category->id]]) !!}
            <div class="form-group">
                {{Form::label('name', 'Category Name')}}
                {{Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter Category Name'])}}
            </div>
            <div class="form-group">
                {{Form::submit('Update Category', ['class'  => 'btn btn-primary'])}}
            </div>
            {!! Form::close() !!}
        </div>
        <div class="col-md-6">
            {!! Form::open(['method' => 'DELETE', 'action' => ['AdminCategoriesController@destroy', $category->id]]) !!}
                <div class="form-group">
                    {{Form::submit('Delete Category', ['class'  => 'btn btn-danger'])}}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection