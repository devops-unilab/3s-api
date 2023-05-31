@extends('layouts.app')

@section('content')
    <h3 class="pb-4 mb-4 font-italic border-bottom">
        {{__("OrderStatusLog")}} {{ $orderstatuslog->id }}
    </h3>
    <div class="card">
        <div class="card-body">

            <a href="{{ url('/order-status-logs') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
            <a href="{{ url('/order-status-logs/' . $orderstatuslog->id . '/edit') }}" title="Edit OrderStatusLog"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
            {!! Form::open([
                'method'=>'DELETE',
                'url' => ['orderstatuslogs', $orderstatuslog->id],
                'style' => 'display:inline'
            ]) !!}
                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                        'type' => 'submit',
                        'class' => 'btn btn-danger btn-sm',
                        'title' => 'Delete OrderStatusLog',
                        'onclick'=>'return confirm("Confirm delete?")'
                ))!!}
            {!! Form::close() !!}
            <br/>
            <br/>

            <div class="table-responsive">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <th>ID</th><td>{{ $orderstatuslog->id }}</td>
                        </tr>
                        <tr><th> Id </th><td> {{ $orderstatuslog->id }} </td></tr><tr><th> Order Id </th><td> {{ $orderstatuslog->order_id }} </td></tr><tr><th> Status </th><td> {{ $orderstatuslog->status }} </td></tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
