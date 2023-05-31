@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Order {{ $order->id }}</div>
        <div class="card-body">

            <a href="{{ url('/orders') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
            <a href="{{ url('/orders/' . $order->id . '/edit') }}" title="Edit Order"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
            {!! Form::open([
                'method'=>'DELETE',
                'url' => ['orders', $order->id],
                'style' => 'display:inline'
            ]) !!}
                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                        'type' => 'submit',
                        'class' => 'btn btn-danger btn-sm',
                        'title' => 'Delete Order',
                        'onclick'=>'return confirm("Confirm delete?")'
                ))!!}
            {!! Form::close() !!}
            <br/>
            <br/>

            <div class="table-responsive">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <th>ID</th><td>{{ $order->id }}</td>
                        </tr>
                        <tr><th> Service Id </th><td> {{ $order->service_id }} </td></tr><tr><th> Description </th><td> {{ $order->description }} </td></tr><tr><th> Attachment </th><td> {{ $order->attachment }} </td></tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
