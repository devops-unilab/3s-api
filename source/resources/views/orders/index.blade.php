@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Orders</div>
        <div class="card-body">
            <a href="{{ url('/orders/create') }}" class="btn btn-success btn-sm" title="Add New Order">
                <i class="fa fa-plus" aria-hidden="true"></i> Add New
            </a>

            {!! Form::open(['method' => 'GET', 'url' => '/orders', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
            <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
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
                            <th>#</th><th>Division Id</th><th>Service Id</th><th>Client User Id</th><th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->division_id }}</td><td>{{ $item->service_id }}</td><td>{{ $item->client_user_id }}</td>
                            <td>
                                <a href="{{ url('/orders/' . $item->id) }}" title="View Order"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                <a href="{{ url('/orders/' . $item->id . '/edit') }}" title="Edit Order"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                {!! Form::open([
                                    'method'=>'DELETE',
                                    'url' => ['/orders', $item->id],
                                    'style' => 'display:inline'
                                ]) !!}
                                    {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                            'type' => 'submit',
                                            'class' => 'btn btn-danger btn-sm',
                                            'title' => 'Delete Order',
                                            'onclick'=>'return confirm("Confirm delete?")'
                                    )) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="pagination-wrapper"> {!! $orders->appends(['search' => Request::get('search')])->render() !!} </div>
            </div>

        </div>
    </div>

@endsection
