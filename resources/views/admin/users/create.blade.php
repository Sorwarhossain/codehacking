@extends('layouts.admin')

@section('title')Create User Page @stop


@section('content')
    @include('includes.form_error')
    {!! Form::open(['method' => 'POST', 'action' => 'AdminUserController@store', 'files' => true]) !!}
        <div class="form-group">
            {{Form::label('name', 'Name')}}
            {{Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter User Name'])}}
        </div>
        <div class="form-group">
            {{Form::label('email', 'Email')}}
            {{Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Enter User Email'])}}
        </div>

        <div class="form-group">
            {{Form::label('password', 'Password')}}
            {{Form::password('password', ['class' => 'form-control', 'placeholder' => 'Enter User Password'])}}
        </div>
        <div class="form-group">
            {{Form::label('is_active', 'User Status')}}
            {{Form::select('is_active', [1 => 'Active', 0 => 'Not Active'], 0, ['class' => 'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('role_id', 'User Role')}}
            {{Form::select('role_id', $roles, 3, ['class' => 'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('photo_id', 'Select User Image')}}
            {{Form::file('photo_id', ['class' => 'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::submit('Create User', ['class'  => 'btn btn-primary'])}}
        </div>
    {!! Form::close() !!}

@endsection