@extends('layouts.app')

@section('content')
<div class="container-xl">
    <div class="row row-deck row-cards">
        <form method="POST" action="{{ route('phone.store') }}">
            @csrf
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">    
                            {{ __('app.add').' '.__('app.phone') }}
                        </h3>
                    </div>

                    <div class="card-body">
                        <label class="form-label">
                            {{ __('app.telco') }}
                        </label>
                        <div class="form-selectgroup-boxes row mb-3">
                            @foreach($telcos as $telco)
                                <div class="col-lg-3  mb-2">
                                    <label class="form-selectgroup-item">
                                        <input type="radio" {{ old('telco') == $telco ? 'checked' : '' }} name="telco" value="{{ $telco }}" class="form-selectgroup-input">
                                        <span class="form-selectgroup-label d-flex align-items-center p-3">
                                        <span class="me-3">
                                            <span class="form-selectgroup-check"></span>
                                        </span>
                                        <span class="form-selectgroup-label-content">
                                            <span class="form-selectgroup-title strong mb-1">
                                                {{ strtoupper($telco) }}
                                            </span>
                                        </span>
                                        </span>
                                    </label>
                                </div>
                            @endforeach

                            @error('telco')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">{{ __('app.phone') }}</label>
                                    <input type="tel" name="phone" value="{{ old('phone') }}" class="form-control">
                                    @error('phone')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">
                                        {{ __('app.status') }}
                                    </label>
                                    <select name="status" class="form-select">
                                        <option value="">{{ __('app.select').' '.__('app.status') }}</option>
                                        <option {{ old('status') == 'active' ? 'selected' : '' }} value="active">{{ __('app.active') }}</option>
                                        <option {{ old('status') == 'blocked' ? 'selected' : '' }} value="blocked">{{ __('app.blocked') }}</option>
                                    </select>
                                    @error('status')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary ms-auto">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                            {{ __('app.save') }}
                        </button>
                        <a href="{{ url('/phone') }}" class="btn btn-link link-secondary">
                            {{ __('app.cancel') }}
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

    
@endsection