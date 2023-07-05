@extends('layouts.app')

@section('content')
    <h3 class="pb-4 mb-4 font-italic border-bottom">
        {{ __('Add New') }} {{ __('Order') }}
    </h3>
    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    @if (count($ordersNotCommited) > 0)
        @include('partials.index-orders', [
            'orders' => $ordersNotCommited,
            'title' => 'Para continuar confirme os chamados fechados.',
            'id' => 'collapseToConfirm',
            'strShow' => 'show',
        ])
    @else
        @include('orders.form')
    @endif
@endsection
