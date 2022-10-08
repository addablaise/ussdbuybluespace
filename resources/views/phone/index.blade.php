@extends('layouts.app')

@section('content')
<div class="container-xl">
    <a href="{{ url('/phone/add') }}" class="btn btn-primary mb-3">
        {{ __('app.create').' '.__('app.phone') }}
    </a>
    <div class="row row-deck row-cards">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">    
                        {{ __('app.phones') }}
                    </h3>
                </div>
        
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                        <thead>
                            <tr>
                                <th class="w-1">#</th>
                                <th>{{ __('app.phone')}}</th>
                                <th>{{ __('app.telco')}}</th>
                                <th>{{ __('app.created_at') }}</th>
                                <th>{{ __('app.status')}}</th>
                                <th>{{ __('app.action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($phones) )
                                @foreach($phones as $phone)
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
                                        <td>
                                            <a href="{{ url('/phone/'.$phone->id.'/edit') }}" class="text-primary me-2">
                                                {{ __('app.edit') }}        
                                            </a>
                                            <a href="javascript:;" onclick="confirmDelete('{{ url('/phone/'.$phone->id.'/delete') }}');" class="text-danger me-2">
                                                {{ __('app.delete') }}        
                                            </a>
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

                <div class="card-footer">
                    <div class="row">
                        <div class="col-sm-4">
                            <div>
                                {!! __('app.pagination_hint', [
                                    'first' => $phones->firstItem(),
                                    'last' => $phones->lastItem(),
                                    'total' => $phones->total()
                                ]) !!}
                            </div>
                        </div>
                        <div class="col-sm-auto ms-auto">
                            <div>
                                <ul class="pagination pagination-separated">
                                    <li class="page-item {{ $phones->previousPageUrl() ? '' : 'disabled'}}">
                                        <a class="page-link" href="{{ $phones->previousPageUrl() ?? '#' }}" tabindex="-1">
                                            {{ __('app.previous') }}
                                        </a>
                                    </li>
                                    @for($i = 1; $i <= $phones->lastPage(); $i++)
                                        <li class="page-item {{ $phones->currentPage() == $i ? 'active' : ''}}">
                                            <a class="page-link" href="{{ $phones->url($i) . ($filters ?? '') }}">
                                                {{ $i }}
                                            </a>
                                        </li>
                                    @endfor

                                    <li class="page-item {{ $phones->nextPageUrl() ? '' : 'disabled'}}">
                                        <a class="page-link" href="{{ $phones->nextPageUrl() ?? '#' }}">
                                        {{ __('app.next') }}
                                    </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection