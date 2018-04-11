@extends('layouts.admin')

@section('title')All Categories @stop

@section('content')
    @if(Session::has('cat_created'))
        <div class="alert alert-success text-center">
            {{session('cat_created')}}
        </div>
    @endif
    @if(Session::has('cat_updated'))
        <div class="alert alert-success text-center">
            {{session('cat_updated')}}
        </div>
    @endif
    @if(Session::has('cat_deleted'))
        <div class="alert alert-danger text-center">
            {{session('cat_deleted')}}
        </div>
    @endif
    <div class="row">
        <div class="col-md-6">
            @include('includes.form_error')
            {!! Form::open(['method' => 'POST', 'action' => 'AdminCategoriesController@store']) !!}
                <div class="form-group">
                    {{Form::label('name', 'Category Name')}}
                    {{Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter Category Name'])}}
                </div>
                <div class="form-group">
                    {{Form::submit('Create Category', ['class'  => 'btn btn-primary'])}}
                </div>
            {!! Form::close() !!}
        </div>
        <div class="col-md-6">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                @if($categories)
                    @foreach($categories as $cat)
                        <tr>
                            <td>{{$cat->id}}</td>
                            <td><a href="{{route('admin.categories.edit', $cat->id)}}">{{$cat->name}}</a></td>
                            <td>{{$cat->created_at ? $cat->created_at->diffForHumans() : 'No time available'}}</td>
                        </tr>
                    @endforeach
                 @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection