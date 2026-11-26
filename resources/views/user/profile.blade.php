@extends('layouts.panel')
@section('title', 'Profile')
@section('content')
<div class="row g-4">
  <div class="col-lg-4 anim-up">
    <div class="card-x text-center p-4">
      <div class="avatar mx-auto mb-3" style="width:90px;height:90px;font-size:2.2rem">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
      <h5 class="fw-bold mb-0">{{ $user->name }}</h5>
      <div class="text-muted small mb-3">{{ $user->email }}</div>
      <span class="chip"><i class="bi bi-calendar-check"></i>{{ $user->bookings()->count() }} bookings</span>
    </div>
  </div>
  <div class="col-lg-8 anim-up d1">
    <div class="card-x"><div class="card-body-x">
      <form method="POST" action="{{ route('user.profile.update') }}">@csrf @method('PUT')
        <div class="row g-3">
          @foreach([['name','Full Name','text'],['email','Email','email'],['contact','Contact','tel']] as [$n,$l,$t])
            <div class="col-md-{{ $n === 'name' ? 12 : 6 }}"><label class="form-label">{{ $l }}</label>
              <input type="{{ $t }}" name="{{ $n }}" class="form-control @error($n) is-invalid @enderror" value="{{ old($n, $user->$n) }}">
              @error($n)<div class="invalid-msg mt-1 ms-0">{{ $message }}</div>@enderror</div>
          @endforeach
          <div class="col-md-6"><label class="form-label">New Password <small class="text-muted">(optional)</small></label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
            @error('password')<div class="invalid-msg mt-1 ms-0">{{ $message }}</div>@enderror</div>
          <div class="col-md-6"><label class="form-label">Confirm Password</label><input type="password" name="password_confirmation" class="form-control"></div>
        </div>
        <button class="btn btn-grad px-4 mt-4"><i class="bi bi-check2-circle me-1"></i>Update Profile</button>
      </form>
    </div></div>
  </div>
</div>
@endsection
