@extends('layouts.app')

@section('content')
    <h3 class="pb-4 mb-4 font-italic border-bottom">
        {{ __('Orderstatuslogs') }}
    </h3>
    <div class="card">
        <div class="card-body">
            <a href="{{ url('/order-status-logs/create') }}"
            class="btn btn-primary m-3" role="button
            title="{{('Add New')}} {{('OrderStatusLog')}}">
                <i class="fa fa-plus" aria-hidden="true"></i> {{ __('Add New') }}
            </a>

            {!! Form::open(['method' => 'GET', 'url' => '/order-status-logs', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
            <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="{{__('Search')}}..." value="{{ request('search') }}">
                <span class="input-group-append">
                    <button class="btn btn-secondary" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
            {!! Form::close() !!}

            <br/>
            <br/>
            <div class="table-responsive">
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th>#</th><th>Id</th><th>Order Id</th><th>Status</th><th>{{__('Actions')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($orderstatuslogs as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->id }}</td><td>{{ $item->order_id }}</td><td>{{ $item->status }}</td>
                            <td>
                                <a href="{{ url('/order-status-logs/' . $item->id) }}" title="View OrderStatusLog"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                <a href="{{ url('/order-status-logs/' . $item->id . '/edit') }}" title="Edit OrderStatusLog"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                {!! Form::open([
                                    'method'=>'DELETE',
                                    'url' => ['/order-status-logs', $item->id],
                                    'style' => 'display:inline'
                                ]) !!}
                                    {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                            'type' => 'submit',
                                            'class' => 'btn btn-danger btn-sm',
                                            'title' => 'Delete OrderStatusLog',
                                            'onclick'=>'return confirm("Confirm delete?")'
                                    )) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="pagination-wrapper"> {!! $orderstatuslogs->appends(['search' => Request::get('search')])->render() !!} </div>
            </div>

        </div>
    </div>

@endsection
