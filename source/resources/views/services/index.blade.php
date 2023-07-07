@extends('layouts.app')

@section('content')


                    <h3 class="pb-4 mb-4 font-italic border-bottom">
                        {{ __('Services') }}
                    </h3>
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ url('/services/create') }}" class="btn btn-primary m-3"
                                role="button
                            title="{{ 'Add New' }} {{ 'Service' }}">
                                <i class="fa fa-plus" aria-hidden="true"></i> {{ __('Add New') }}
                            </a>

                            {!! Form::open([
                                'method' => 'GET',
                                'url' => '/services',
                                'class' => 'form-inline my-2 my-lg-0 float-right',
                                'role' => 'search',
                            ]) !!}
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="{{ __('Search') }}..."
                                    value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                            {!! Form::close() !!}

                            <br />
                            <br />
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nome</th>
                                            <th>Descrição</th>
                                            <th>SLA</th>
                                            <th>{{ __('Actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($services as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->description }}</td>
                                                <td>{{ $item->sla }}</td>
                                                <td>
                                                    <a href="{{ url('/services/' . $item->id . '/edit') }}" title="Edit Service"><button
                                                            class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"
                                                                aria-hidden="true"></i> Edit</button></a>
                                                    {!! Form::open([
                                                        'method' => 'DELETE',
                                                        'url' => ['/services', $item->id],
                                                        'style' => 'display:inline',
                                                    ]) !!}
                                                    {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', [
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-sm',
                                                        'title' => 'Delete Service',
                                                        'onclick' => 'return confirm("Confirm delete?")',
                                                    ]) !!}
                                                    {!! Form::close() !!}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="pagination-wrapper"> {!! $services->appends(['search' => Request::get('search')])->render() !!} </div>
                            </div>

                        </div>
                    </div>




@endsection
