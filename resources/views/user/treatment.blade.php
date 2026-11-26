@extends('layouts.panel')
@section('title', 'Treatment Details')
@section('content')
<div class="card-x anim-up overflow-hidden" style="max-width:820px">
  <div class="thumb g-purple d-grid" style="height:170px;place-items:center;color:#fff;font-size:4rem"><i class="bi bi-flower1"></i></div>
  <div class="card-body-x">
    <h3 class="fw-bold">{{ $treatment->treatment_name }}</h3>
    <div class="d-flex gap-3 align-items-center my-3">
      <span class="chip"><i class="bi bi-clock"></i>{{ $treatment->duration }} minutes</span>
      <span class="price">₹{{ number_format($treatment->price, 2) }}</span>
    </div>
    <p class="text-muted">{{ $treatment->description ?: 'No description available.' }}</p>
    <a href="{{ route('user.bookings.create', ['treatment_id' => $treatment->id]) }}" class="btn btn-grad px-4"><i class="bi bi-calendar-plus me-1"></i>Book this treatment</a>
    <a href="{{ route('user.home') }}" class="btn btn-soft px-4 py-2 ms-2">Back</a>
  </div>
</div>
@endsection
