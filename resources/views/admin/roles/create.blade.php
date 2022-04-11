@extends('layouts.admin-dashboard')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-5 border-bottom">
        <h2 class="h2">Create role</h2>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <a class="btn btn-sm btn-outline-success" href="{{ route('roles.index') }}">Back to roles</a>
            </div>
        </div>
    </div>

    <div class="row">
        {!! Form::open(['action' =>[ 'App\Http\Controllers\Admin\RoleController@store'], 'class' => 'col-4']) !!}
        <div class="form-group">
            {{ Form::label('name', 'Name', ['class' => 'awesome']) }}
            {{ Form::text('name', '', ['class' => 'form-control ' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'guest']) }}
            @if ($errors->has('name'))
                <div class="invalid-feedback">
                    {{ $errors->getBag('default')->first('name') }}
                </div>
            @endif
        </div>
        {{ Form::button('Create', ['type' => 'submit', 'class' => 'btn btn-primary']) }}
        {!! Form::close() !!}
    </div>

@endsection
