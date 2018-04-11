@extends('layouts.admin')

@section('title')Edit User Page @stop


@section('content')
    <div class="row">
        @include('includes.form_error')
        <div class="col-md-4">
            <div class="image-wrapper">
                @if($user->photo)
                    <img src="{{$user->photo->file}}" alt="" class="img-responsive img-rounded">
                @else
                    <img src="http://via.placeholder.com/300x300" alt="" class="img-responsive img-rounded">
                @endif
            </div><br><br>
            {!! Form::open(['method' => 'DELETE', 'action' => ['AdminUserController@destroy', $user->id]]) !!}
            <div class="form-group">
                {{Form::submit('Delete User', ['class'  => 'btn btn-danger btn-block'])}}
            </div>
            {!! Form::close() !!}
        </div>
        <div class="col-md-8">
            {!! Form::model($user, ['method' => 'PATCH', 'action' => ['AdminUserController@update', $user->id], 'files' => true]) !!}
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
                {{Form::select('is_active', [1 => 'Active', 0 => 'Not Active'], null, ['class' => 'form-control'])}}
            </div>
            <div class="form-group">
                {{Form::label('role_id', 'User Role')}}
                {{Form::select('role_id', $roles, null, ['class' => 'form-control'])}}
            </div>
            <div class="form-group">
                {{Form::label('photo_id', 'Select User Image')}}
                {{Form::file('photo_id', ['class' => 'form-control'])}}
            </div>
            <div class="form-group">
                {{Form::submit('Update User', ['class'  => 'btn btn-primary btn-block'])}}
            </div>
        </div>
    </div>

    {!! Form::close() !!}






@endsection