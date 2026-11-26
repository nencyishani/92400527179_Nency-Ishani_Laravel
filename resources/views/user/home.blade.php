@extends('layouts.panel')
@section('title', 'Home')
@section('content')
@php $grads = ['g-purple','g-pink','g-teal','g-orange']; $icons = ['bi-flower1','bi-droplet-half','bi-stars','bi-brightness-high','bi-emoji-smile','bi-heart-pulse']; @endphp
<div class="hero mb-4 anim-up">
  <span class="blob b1" style="width:200px;height:200px;background:#fff;right:-50px;top:-50px"></span>
  <span class="blob b2" style="width:120px;height:120px;background:#fff;right:18%;bottom:-30px"></span>
  <h2>Hello, {{ explode(' ', auth()->user()->name)[0] }} 🌸<br>Time to unwind.</h2>
  <p>Browse our signature treatments and book your next wellness session with an expert therapist.</p>
  <a href="{{ route('user.bookings.create') }}" class="btn btn-light fw-semibold px-4 py-2 rounded-pill"><i class="bi bi-calendar-plus me-1"></i>Book Now</a>
</div>

<h5 class="fw-bold mb-3">Our Treatments</h5>
<div class="row g-4">
  @forelse($treatments as $k => $t)
    <div class="col-md-6 col-xl-4 anim-up" style="animation-delay: {{ $k * .07 }}s">
      <div class="card-x hover t-card">
        <div class="thumb {{ $grads[$k % 4] }}"><i class="bi {{ $icons[$k % 6] }}"></i></div>
        <div class="body">
          <h6>{{ $t->treatment_name }}</h6>
          <p class="desc">{{ \Illuminate\Support\Str::limit($t->description, 80) }}</p>
          <div class="d-flex justify-content-between align-items-center mb-3">
            <span class="chip"><i class="bi bi-clock"></i>{{ $t->duration }} min</span><span class="price">₹{{ number_format($t->price) }}</span>
          </div>
          <div class="d-flex gap-2">
            <a href="{{ route('user.treatments.show', $t) }}" class="btn btn-soft flex-fill py-2">Details</a>
            <a href="{{ route('user.bookings.create', ['treatment_id' => $t->id]) }}" class="btn btn-grad flex-fill py-2">Book</a>
          </div>
        </div>
      </div>
    </div>
  @empty
    <div class="col-12"><div class="card-x"><div class="empty"><i class="bi bi-droplet"></i>No treatments available yet</div></div></div>
  @endforelse
</div>
@endsection
