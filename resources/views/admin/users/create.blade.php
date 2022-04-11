@extends('layouts.admin-dashboard')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-5 border-bottom">
        <h1 class="h2">Users</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <a class="btn btn-sm btn-outline-success" href="{{ route('users.index') }}">Back to users</a>
            </div>
        </div>
    </div>
    <div class="row">
        {!! Form::open(['action' => ['App\Http\Controllers\Admin\UserController@update', $user->id], 'method' => 'POST',
        'class' => 'col-4']) !!}
        <div class="form-group">
            {{ Form::label('name', 'Name') }}
            {{ Form::text('name', $user->name, ['class' => 'form-control ' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'guest']) }}
            @if ($errors->has('name'))
                <div class="invalid-feedback">
                    {{ $errors->getBag('default')->first('name') }}
                </div>
            @endif
        </div>
        <div class="form-group">
            {{ Form::label('email', 'Email') }}
            {{ Form::text('email', $user->email, ['class' => 'form-control ' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'guest']) }}
            @if ($errors->has('email'))
                <div class="invalid-feedback">
                    {{ $errors->getBag('default')->first('email') }}
                </div>
            @endif
        </div>
        <div class="form-group">
            {{ Form::label('role', 'Role') }}
            {{ Form::select('role', $roles, $userRole, ['class' => 'form-control ' . ($errors->has('role') ? ' is-invalid' : '')]) }}
            @if ($errors->has('role'))
                <div class="invalid-feedback">
                    {{ $errors->getBag('default')->first('role') }}
                </div>
            @endif
        </div>
        {{ Form::button('Update', ['type' => 'submit', 'class' => 'btn btn-primary']) }}
        {!! Form::close() !!}
    </div>
@endsection
