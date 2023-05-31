@extends('layouts.app')

@section('content')
    <h3 class="pb-4 mb-4 font-italic border-bottom">
        {{__("Edit")}} {{__("Division")}}
    </h3>
    <div class="card">
        <div class="card-header">Edit Division #{{ $division->id }}</div>
        <div class="card-body">
            <a href="{{ url('/divisions') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
            <br />
            <br />

            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            {!! Form::model($division, [
                'method' => 'PATCH',
                'url' => ['/divisions', $division->id],
                'class' => 'form-horizontal',
                'files' => true
            ]) !!}

            @include ('divisions.form', ['formMode' => 'edit'])

            {!! Form::close() !!}

        </div>
    </div>
@endsection
