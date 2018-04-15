@extends('layouts.admin')

@section('title')All Media @stop

@section('content')
    @if(Session::has('media_created'))
        <div class="alert alert-success text-center">
            {{session('media_created')}}
        </div>
    @endif
    @if(Session::has('media_updated'))
        <div class="alert alert-success text-center">
            {{session('media_updated')}}
        </div>
    @endif
    @if(Session::has('media_deleted'))
        <div class="alert alert-danger text-center">
            {{session('media_deleted')}}
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @if($photos)
                    @foreach($photos as $photo)
                        <tr>
                            <td>{{$photo->id}}</td>
                            <td><img width="200px" src="{{$photo->file ? $photo->file : 'http://via.placeholder.com/350x150'}}" alt=""></td>
                            <td>{{$photo->created_at ?  $photo->created_at->diffForHumans() : 'No time available'}}</td>
                            <td>
                                {!! Form::open(['method' => 'DELETE', 'action' => ['AdminMediasController@destroy', $photo->id]]) !!}
                                    <div class="form-group">
                                        {{Form::submit('Delete Media', ['class'  => 'btn btn-danger'])}}
                                    </div>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection