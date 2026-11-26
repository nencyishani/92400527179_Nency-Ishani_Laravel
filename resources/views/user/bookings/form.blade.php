@extends('layouts.panel')
@section('title', $booking->exists ? 'Edit Booking' : 'Book Treatment')
@section('content')
<div class="card-x anim-up" style="max-width:780px">
  <div class="card-body-x">
    <form method="POST" action="{{ $booking->exists ? route('user.bookings.update', $booking) : route('user.bookings.store') }}">
      @csrf @if($booking->exists) @method('PUT') @endif
      <div class="row g-3">
        <div class="col-md-6"><label class="form-label">Treatment</label>
          <select name="treatment_id" id="treatment" class="form-select @error('treatment_id') is-invalid @enderror"><option value="">Select treatment</option>
            @foreach($treatments as $t)<option value="{{ $t->id }}" data-info="{{ $t->duration }} min • ₹{{ number_format($t->price, 2) }}" @selected(old('treatment_id', $booking->treatment_id) == $t->id)>{{ $t->treatment_name }}</option>@endforeach</select>
          @error('treatment_id')<div class="invalid-msg mt-1 ms-0">{{ $message }}</div>@enderror
          <div class="chip mt-2" id="info" style="display:none"></div></div>
        <div class="col-md-6"><label class="form-label">Therapist</label>
          <select name="therapist_id" class="form-select @error('therapist_id') is-invalid @enderror"><option value="">Select therapist</option>
            @foreach($therapists as $t)<option value="{{ $t->id }}" @selected(old('therapist_id', $booking->therapist_id) == $t->id)>{{ $t->therapist_name }} — {{ $t->specialization }}</option>@endforeach</select>
          @error('therapist_id')<div class="invalid-msg mt-1 ms-0">{{ $message }}</div>@enderror</div>
        <div class="col-md-6"><label class="form-label">Date</label>
          <input type="date" name="booking_date" min="{{ date('Y-m-d') }}" class="form-control @error('booking_date') is-invalid @enderror" value="{{ old('booking_date', optional($booking->booking_date)->format('Y-m-d')) }}">
          @error('booking_date')<div class="invalid-msg mt-1 ms-0">{{ $message }}</div>@enderror</div>
        <div class="col-md-6"><label class="form-label">Time</label>
          <input type="time" name="booking_time" class="form-control @error('booking_time') is-invalid @enderror" value="{{ old('booking_time', $booking->booking_time ? substr($booking->booking_time, 0, 5) : '') }}">
          @error('booking_time')<div class="invalid-msg mt-1 ms-0">{{ $message }}</div>@enderror</div>
      </div>
      <div class="mt-4">
        <button class="btn btn-grad px-4"><i class="bi bi-check2-circle me-1"></i>{{ $booking->exists ? 'Update Booking' : 'Confirm Booking' }}</button>
        <a href="{{ route('user.bookings.index') }}" class="btn btn-soft px-4 py-2 ms-2">Cancel</a>
      </div>
    </form>
  </div>
</div>
@push('scripts')
<script>
  const tr = document.getElementById('treatment'), info = document.getElementById('info');
  const show = () => { const d = tr.selectedOptions[0]?.dataset.info; info.style.display = d ? 'inline-flex' : 'none'; info.textContent = d || ''; };
  tr.addEventListener('change', show); show();
</script>
@endpush
@endsection
