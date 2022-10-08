@extends('layouts.app')

@section('content')
<div class="container-xl">
    <div class="row row-deck row-cards">
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                    <div class="subheader">
                        {{ __('app.users') }}
                    </div>
                    
                    </div>
                    <div class="h1 mb-3">
                        {{ $users }}
                    </div>
                    <div class="d-flex mb-2">
                        <div>
                            {{ __('app.total').' '.__('app.users') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                    <div class="subheader">
                        {{ __('app.phones') }}
                    </div>
                    
                    </div>
                    <div class="h1 mb-3">
                        {{ $phones }}
                    </div>
                    <div class="d-flex mb-2">
                        <div>
                            {{ __('app.total').' '.__('app.phones') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                    <div class="subheader">
                        {{ __('app.active').' '.__('app.phones') }}
                    </div>
                    
                    </div>
                    <div class="h1 mb-3">
                        {{ $active }}
                    </div>
                    <div class="d-flex mb-2">
                        <div>
                            {{ __('app.total').' '.__('app.active').' '.__('app.phones') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                    <div class="subheader">
                        {{ __('app.blacklisted').' '.__('app.phones') }}
                    </div>
                    
                    </div>
                    <div class="h1 mb-3">
                        {{ $blacklisted }}
                    </div>
                    <div class="d-flex mb-2">
                        <div>
                            {{ __('app.total').' '.__('app.blacklisted').' '.__('app.phones') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        {{ __('app.recent').' '.__('app.phones') }}
                    </h3>
                </div>
        
                <div class="table-responsive">
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                        <thead>
                            <tr>
                                <th class="w-1">#</th>
                                <th>{{ __('app.phone')}}</th>
                                <th>{{ __('app.telco')}}</th>
                                <th>{{ __('app.created_at') }}</th>
                                <th>{{ __('app.status')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($recent) )
                                @foreach($recent as $phone)
                                    <tr>
                                        <td><span class="text-muted">{{ $loop->iteration }}</span></td>
                                        <td>
                                            <a href="tel:{{ $phone->phone }}" class="fw-bold">
                                                {{ $phone->phone }}        
                                            </a>
                                        </td>
                                        <td>
                                            {{ strtoupper($phone->telco) }}        
                                        </td>
                                        <td>
                                            {{ date('d M y h:i a', strtotime($phone->created_at)) }}<br>
                                            @if($phone->created_at != $phone->updated_at)
                                                <span class="text-muted">
                                                {!! __('app.updated_at').': <b>'.date('d M y h:i a', strtotime($phone->updated_at)).'</b>' !!}
                                                </span>        
                                            @endif
                                        </td>
                                        <td class="fw-bold {{ $phone->status == 'active' ? 'text-success' : 'text-danger' }}">
                                            {{ strtoupper($phone->status) }}        
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="text-center p-4">
                                        <h4>{{ __('app.no_results_found') }}</h4>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection