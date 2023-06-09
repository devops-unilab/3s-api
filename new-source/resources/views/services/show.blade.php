@extends('layouts.app')

@section('content')
    <h3 class="pb-4 mb-4 font-italic border-bottom">
        {{__("Service")}} {{ $service->id }}
    </h3>
    <div class="card">
        <div class="card-body">

            <a href="{{ url('/services') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
            <a href="{{ url('/services/' . $service->id . '/edit') }}" title="Edit Service"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
            {!! Form::open([
                'method'=>'DELETE',
                'url' => ['services', $service->id],
                'style' => 'display:inline'
            ]) !!}
                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                        'type' => 'submit',
                        'class' => 'btn btn-danger btn-sm',
                        'title' => 'Delete Service',
                        'onclick'=>'return confirm("Confirm delete?")'
                ))!!}
            {!! Form::close() !!}
            <br/>
            <br/>

            <div class="table-responsive">
                <table class="table table-borderless">
                    <caption>This is a table</caption>
                    <tbody>
                        <tr>
                            <th>ID</th><td>{{ $service->id }}</td>
                        </tr>
                        <tr><th> Name </th><td> {{ $service->name }} </td></tr><tr><th> Description </th><td> {{ $service->description }} </td></tr><tr><th> Sla Duration </th><td> {{ $service->sla_duration }} </td></tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
