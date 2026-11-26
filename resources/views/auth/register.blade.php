@extends('layouts.auth')
@section('title', 'Register')
@section('content')
<div class="auth-card">
  <div class="auth-side">
    <div class="logo"><i class="bi bi-flower2"></i></div>
    <h2>Join our<br>wellness family</h2>
    <p>Create a free account to book treatments, track bookings and manage your profile.</p>
    <ul>
      <li><i class="bi bi-stars"></i> Exclusive treatments</li>
      <li><i class="bi bi-calendar-check"></i> Manage bookings anytime</li>
      <li><i class="bi bi-heart"></i> Personalised care</li>
    </ul>
  </div>
  <div class="auth-form">
    <h3>Create Account ✨</h3>
    <p class="sub">Register as a customer</p>
    <form method="POST" action="{{ route('register.post') }}" novalidate>
      @csrf
      @foreach([['name','text','Full Name','bi-person'],['email','email','Email (Username)','bi-envelope'],['contact','tel','Contact Number','bi-telephone']] as [$n,$t,$l,$i])
        <div class="field">
          <input type="{{ $t }}" name="{{ $n }}" class="form-control @error($n) is-invalid @enderror" placeholder=" " value="{{ old($n) }}">
          <label class="fl">{{ $l }}</label><i class="bi {{ $i }} ico"></i>
        </div>
        @error($n) <div class="invalid-msg">{{ $message }}</div> @enderror
      @endforeach
      <div class="field">
        <input type="password" id="pw1" name="password" class="form-control @error('password') is-invalid @enderror" placeholder=" ">
        <label class="fl">Password</label><i class="bi bi-lock ico"></i><i class="bi bi-eye-slash toggle-eye" data-target="pw1"></i>
      </div>
      @error('password') <div class="invalid-msg">{{ $message }}</div> @enderror
      <div class="field">
        <input type="password" id="pw2" name="password_confirmation" class="form-control" placeholder=" ">
        <label class="fl">Confirm Password</label><i class="bi bi-shield-check ico"></i><i class="bi bi-eye-slash toggle-eye" data-target="pw2"></i>
      </div>
      <button class="btn btn-grad w-100">Register <i class="bi bi-person-plus ms-1"></i></button>
      <p class="text-center mt-4 mb-0 small">Already registered? <a class="auth-link" href="{{ route('login') }}">Login</a></p>
    </form>
  </div>
</div>
@endsection
