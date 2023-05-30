@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Edit Order #{{ $order->id }}</div>
        <div class="card-body">
            <a href="{{ url('/orders') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
            <br />
            <br />

            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            {!! Form::model($order, [
                'method' => 'PATCH',
                'url' => ['/orders', $order->id],
                'class' => 'form-horizontal',
                'files' => true
            ]) !!}

            @include ('orders.form', ['formMode' => 'edit'])

            {!! Form::close() !!}

        </div>
    </div>
@endsection
