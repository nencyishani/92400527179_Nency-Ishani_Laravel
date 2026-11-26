@extends('layouts.auth')
@section('title', 'Login')
@section('content')
@php $as = old('login_as', 'user'); @endphp
<div class="auth-card">
  <div class="auth-side">
    <div class="logo"><i class="bi bi-flower1"></i></div>
    <h2>Relax. Refresh.<br>Rejuvenate.</h2>
    <p>Book treatments with our expert therapists in just a few clicks.</p>
    <ul>
      <li><i class="bi bi-check-circle-fill"></i> Premium wellness treatments</li>
      <li><i class="bi bi-check-circle-fill"></i> Certified therapists</li>
      <li><i class="bi bi-check-circle-fill"></i> Easy online booking</li>
    </ul>
  </div>
  <div class="auth-form">
    <h3>Welcome Back 👋</h3>
    <p class="sub">Login to continue to your panel</p>

    @if(session('success')) <div class="flash ok mb-3"><i class="bi bi-check-circle"></i>{{ session('success') }}</div> @endif
    @if(session('error'))   <div class="flash err mb-3"><i class="bi bi-exclamation-circle"></i>{{ session('error') }}</div> @endif

    <form method="POST" action="{{ route('login.post') }}" novalidate>
      @csrf
      <div class="role-switch">
        <input type="radio" name="login_as" id="roleUser" value="user" {{ $as === 'user' ? 'checked' : '' }}>
        <label for="roleUser"><i class="bi bi-person"></i> User</label>
        <input type="radio" name="login_as" id="roleAdmin" value="admin" {{ $as === 'admin' ? 'checked' : '' }}>
        <label for="roleAdmin"><i class="bi bi-shield-lock"></i> Admin</label>
        <span class="pill"></span>
      </div>

      <div class="field">
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder=" " value="{{ old('email') }}" required autofocus>
        <label class="fl">Email (Username)</label><i class="bi bi-envelope ico"></i>
      </div>
      @error('email') <div class="invalid-msg">{{ $message }}</div> @enderror

      <div class="field">
        <input type="password" id="pw" name="password" class="form-control" placeholder=" " required>
        <label class="fl">Password</label><i class="bi bi-lock ico"></i>
        <i class="bi bi-eye-slash toggle-eye" data-target="pw"></i>
      </div>

      <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="form-check"><input class="form-check-input" type="checkbox" name="remember" id="rem"><label class="form-check-label small" for="rem">Remember me</label></div>
      </div>

      <button class="btn btn-grad w-100">Login <i class="bi bi-arrow-right ms-1"></i></button>
      <p class="text-center mt-4 mb-0 small">New customer? <a class="auth-link" href="{{ route('register') }}">Create an account</a></p>
    </form>
  </div>
</div>
@endsection
