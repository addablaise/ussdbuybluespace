@extends('layouts.auth')

@section('content')
<div class="text-center mb-4">
    <h2>{{ __('app.title') }}</h2>
</div>
<form class="card card-md" method="POST">
    @csrf
    <div class="card-body">
        <h2 class="card-title text-center mb-4">
        {{ __('auth.login_hint') }}
        </h2>
        <div class="mb-3">
            <label class="form-label">
                {{ __('auth.email') }}
            </label>
            <input type="email" name="email" class="form-control" placeholder="{{ __('app.enter').' '.__('auth.email') }}">
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-2">
            <label class="form-label">
                {{ __('auth.password') }}
            </label>
            <div class="input-group input-group-flat">
            <input type="password" name="password" class="form-control" placeholder="{{ __('app.enter').' '.__('auth.password') }}">
            <span class="input-group-text">
                <a href="javascript:void()" class="link-secondary" title="Show password" data-bs-toggle="tooltip"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="2" /><path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7" /></svg>
                </a>
            </span>
            </div>
        </div>
        <div class="mb-2">
            <label class="form-check">
            <input type="checkbox" name="remember" class="form-check-input"/>
            <span class="form-check-label">
                {{ __('auth.remember_hint') }}
            </span>
            </label>
        </div>
        <div class="form-footer">
            <button type="submit" class="btn btn-primary w-100">
                {{ __('auth.signin') }}
            </button>
        </div>
    </div>
</form>
@endsection