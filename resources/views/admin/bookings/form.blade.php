@extends('layouts.panel')
@section('title', $booking->exists ? 'Edit Booking' : 'Add Booking')
@section('content')
<div class="card-x anim-up" style="max-width:860px">
  <div class="card-body-x">
    <form method="POST" action="{{ $booking->exists ? route('admin.bookings.update', $booking) : route('admin.bookings.store') }}">
      @csrf @if($booking->exists) @method('PUT') @endif
      <div class="row g-3">
        <div class="col-md-6"><label class="form-label">Customer</label>
          <select name="user_id" class="form-select @error('user_id') is-invalid @enderror"><option value="">Select customer</option>
            @foreach($customers as $c)<option value="{{ $c->id }}" @selected(old('user_id', $booking->user_id) == $c->id)>{{ $c->name }} ({{ $c->email }})</option>@endforeach</select>
          @error('user_id')<div class="invalid-msg mt-1 ms-0">{{ $message }}</div>@enderror</div>
        <div class="col-md-6"><label class="form-label">Treatment</label>
          <select name="treatment_id" id="treatment" class="form-select @error('treatment_id') is-invalid @enderror"><option value="">Select treatment</option>
            @foreach($treatments as $t)<option value="{{ $t->id }}" data-price="{{ $t->price }}" @selected(old('treatment_id', $booking->treatment_id) == $t->id)>{{ $t->treatment_name }}</option>@endforeach</select>
          @error('treatment_id')<div class="invalid-msg mt-1 ms-0">{{ $message }}</div>@enderror</div>
        <div class="col-md-6"><label class="form-label">Therapist</label>
          <select name="therapist_id" class="form-select @error('therapist_id') is-invalid @enderror"><option value="">Select therapist</option>
            @foreach($therapists as $t)<option value="{{ $t->id }}" @selected(old('therapist_id', $booking->therapist_id) == $t->id)>{{ $t->therapist_name }}</option>@endforeach</select>
          @error('therapist_id')<div class="invalid-msg mt-1 ms-0">{{ $message }}</div>@enderror</div>
        <div class="col-md-6"><label class="form-label">Price (₹)</label>
          <input type="number" step="0.01" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $booking->price) }}">
          @error('price')<div class="invalid-msg mt-1 ms-0">{{ $message }}</div>@enderror</div>
        <div class="col-md-4"><label class="form-label">Date</label>
          <input type="date" name="booking_date" @unless($booking->exists) min="{{ date('Y-m-d') }}" @endunless class="form-control @error('booking_date') is-invalid @enderror" value="{{ old('booking_date', optional($booking->booking_date)->format('Y-m-d')) }}">
          @error('booking_date')<div class="invalid-msg mt-1 ms-0">{{ $message }}</div>@enderror</div>
        <div class="col-md-4"><label class="form-label">Time</label>
          <input type="time" name="booking_time" class="form-control @error('booking_time') is-invalid @enderror" value="{{ old('booking_time', $booking->booking_time ? substr($booking->booking_time, 0, 5) : '') }}">
          @error('booking_time')<div class="invalid-msg mt-1 ms-0">{{ $message }}</div>@enderror</div>
        <div class="col-md-4"><label class="form-label">Status</label>
          <select name="status" class="form-select">@foreach(\App\Models\Booking::STATUSES as $s)<option @selected(old('status', $booking->status ?? 'Pending') == $s)>{{ $s }}</option>@endforeach</select></div>
      </div>
      <div class="mt-4">
        <button class="btn btn-grad px-4"><i class="bi bi-check2-circle me-1"></i>Save Booking</button>
        <a href="{{ route('admin.bookings.index') }}" class="btn btn-soft px-4 py-2 ms-2">Cancel</a>
      </div>
    </form>
  </div>
</div>
@push('scripts')
<script>
  const tr = document.getElementById('treatment'), pr = document.getElementById('price');
  tr.addEventListener('change', () => { const p = tr.selectedOptions[0].dataset.price; if (p) pr.value = p; });
</script>
@endpush
@endsection
