@extends('layouts.app')

@section('content')
<div class="container-xl">
    <div class="row row-deck row-cards">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">    
                        {{ __('app.logs') }}
                    </h3>
                </div>
        
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                        <thead>
                            <tr>
                                <th class="w-1">#</th>
                                <th>{{ __('app.action')}}</th>
                                <th>{{ __('app.created_at') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($logs) )
                                @foreach($logs as $log)
                                    <tr>
                                        <td><span class="text-muted">{{ $loop->iteration }}</span></td>
                                        <td>
                                            <a href="javascript:;" class="fw-bold">
                                                {{ $log->action }}      
                                            </a>
                                        </td>
                                        <td>
                                            {{ date('d M y h:i a', strtotime($log->created_at)) }}<br>
                                            @if($log->created_at != $log->updated_at)
                                                <span class="text-muted">
                                                {!! __('app.updated_at').': <b>'.date('d M y h:i a', strtotime($log->updated_at)).'</b>' !!}
                                                </span>        
                                            @endif
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
                                    'first' => $logs->firstItem(),
                                    'last' => $logs->lastItem(),
                                    'total' => $logs->total()
                                ]) !!}
                            </div>
                        </div>
                        <div class="col-sm-auto ms-auto">
                            <div>
                                <ul class="pagination pagination-separated">
                                    <li class="page-item {{ $logs->previousPageUrl() ? '' : 'disabled'}}">
                                        <a class="page-link" href="{{ $logs->previousPageUrl() ?? '#' }}" tabindex="-1">
                                            {{ __('app.previous') }}
                                        </a>
                                    </li>
                                    @for($i = 1; $i <= $logs->lastPage(); $i++)
                                        <li class="page-item {{ $logs->currentPage() == $i ? 'active' : ''}}">
                                            <a class="page-link" href="{{ $logs->url($i) . ($filters ?? '') }}">
                                                {{ $i }}
                                            </a>
                                        </li>
                                    @endfor

                                    <li class="page-item {{ $logs->nextPageUrl() ? '' : 'disabled'}}">
                                        <a class="page-link" href="{{ $logs->nextPageUrl() ?? '#' }}">
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