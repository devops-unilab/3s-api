@php
    $strId = '';
    if (isset($id) && $id != '') {
        $strId = ' id = easyPaginate' . $id;
    }
@endphp
<div class="panel panel-default" id="panel1">
    <div class="panel-heading">
        <h3 class="pb-4 mb-4 font-italic border-bottom" data-toggle="collapse" data-target="#{{ $id }}"
            href="#{{ $id }}">
            {{ $title }}
            <button type="button" class="float-right btn ml-3
            btn-warning btn-circle btn-lg"
                data-toggle="collapse" href="# {{ $id }}" role="button" aria-expanded="false"
                aria-controls="{{ $id }}"><i class="fa fa-expand icone-maior"></i></button>
        </h3>

    </div>
    <div id="{{ $id }}" class="panel-collapse collapse in {{ $strShow }}">
        <div class="panel-body">
            <div {{ $strId }} class="alert-group">
                @forelse ($orders as $order)
                    @php
                        $strClass = 'alert-warning';
                        if ($order->status == 'opened' || $order->status == 'reserved') {
                            $strClass = 'alert-warning';
                        } elseif ($order->status == 'in progress') {
                            $strClass = 'alert-info';
                        } elseif ($order->status == 'closed') {
                            $strClass = 'alert-success';
                        } elseif ($order->status == 'committed') {
                            $strClass = 'alert-success';
                        } elseif ($order->status == 'canceled') {
                            $strClass = 'alert-secondary';
                        } elseif ($order->status == 'pending customer response' || $order->status == 'pending it resource') {
                            $strClass = 'alert-danger';
                        }
                    @endphp
                    <div class="alert {{ $strClass }} alert-dismissable">
                        <a href="{{ route('orders.show', $order) }}" class="close"><i
                                class="fa fa-search icone-maior"></i></a>
                        <strong>#{{ $order->id }}</strong> {{ substr($order->description, 0, 200) }}...
                    </div>
                @empty
                    <div class="alert alert-light alert-dismissable text-center">
                        <strong>Nenhuma Ocorrência</strong>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
