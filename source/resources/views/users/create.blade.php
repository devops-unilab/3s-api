@extends('layouts.app')

@section('content')
    @include('admin.navbar')
    <div class="card">
        <div class="card-header">Create New User</div>
        <div class="card-body">
            <a href="{{ url('/users') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
            <br />
            <br />

            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            {!! Form::open(['url' => '/users', 'class' => 'form-horizontal', 'files' => true]) !!}

            @include ('users.form', ['formMode' => 'create'])

            {!! Form::close() !!}
        </div>
    </div>
@endsection
