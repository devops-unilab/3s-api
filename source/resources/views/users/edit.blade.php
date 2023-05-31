@extends('layouts.app')

@section('content')
    <h3 class="pb-4 mb-4 font-italic border-bottom">
        {{__("Edit")}} {{__("User")}}
    </h3>
    <div class="card">
        <div class="card-header">Edit User #{{ $user->id }}</div>
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

            {!! Form::model($user, [
                'method' => 'PATCH',
                'url' => ['/users', $user->id],
                'class' => 'form-horizontal',
                'files' => true
            ]) !!}

            @include ('users.form', ['formMode' => 'edit'])

            {!! Form::close() !!}

        </div>
    </div>
@endsection
