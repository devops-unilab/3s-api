@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="panel-group" id="accordion">
                @if(session()->get('role') != 'customer')
                    @include('partials.index-orders',
                    [
                        'orders' => $ordersLate,
                        'id' => 'collapseAtraso',
                        'title' => 'Ocorrências Em Atraso(' . count($ordersLate) . ')',
                        'strShow' => "show"
                    ])
                @endif

                @include('partials.index-orders',
                [
                    'orders' => $ordersNotLate,
                    'title' => 'Ocorrências Em Aberto(' . count($ordersNotLate) . ')',
                    'id' => 'collapseAberto',
                    'strShow' => 'show'
                ])
                @include('partials.index-orders',
                [
                    'orders' => $ordersFinished,
                    'title' => "Ocorrências Encerradas",
                    'id' => 'collapseEncerrada',
                    'strShow' => ''
                ])
            </div>
        </div>
		<aside class="col-md-4 blog-sidebar">
            <div class="p-4 mb-3 bg-light rounded">
                <h4 class="font-italic">Filtros</h4>
                @include('partials.form-basic-filter')
                @include('partials.form-advanced-filter')
                @include('partials.form-campus-filter')
                @include('partials.card-info')
            </div>
        </aside>
    </div>

    {{-- <div class="card">
        <div class="card-body">
            <a href="{{ url('/orders/create') }}"
            class="btn btn-primary m-3" role="button
            title="{{('Add New')}} {{('Order')}}">
                <i class="fa fa-plus" aria-hidden="true"></i> {{ __('Add New') }}
            </a>

            {!! Form::open(['method' => 'GET', 'url' => '/orders', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
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
                            <th>#</th><th>Service Id</th><th>Description</th><th>Attachment</th><th>{{__('Actions')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($orders as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->service_id }}</td><td>{{ $item->description }}</td><td>{{ $item->attachment }}</td>
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
    </div> --}}
@endsection
