@extends('layouts.panel')
@section('title', 'Bookings')
@section('content')
<div class="card-x anim-up">
  <div class="card-head"><h5>All Bookings</h5><a href="{{ route('admin.bookings.create') }}" class="btn btn-grad py-2 px-3"><i class="bi bi-plus-lg me-1"></i>Add Booking</a></div>
  <form class="filter-bar" method="GET">
    <select name="treatment_id" class="form-select"><option value="">All Treatments</option>
      @foreach($treatments as $t)<option value="{{ $t->id }}" @selected(request('treatment_id') == $t->id)>{{ $t->treatment_name }}</option>@endforeach</select>
    <select name="therapist_id" class="form-select"><option value="">All Therapists</option>
      @foreach($therapists as $t)<option value="{{ $t->id }}" @selected(request('therapist_id') == $t->id)>{{ $t->therapist_name }}</option>@endforeach</select>
    <select name="status" class="form-select"><option value="">All Status</option>
      @foreach(\App\Models\Booking::STATUSES as $s)<option @selected(request('status') == $s)>{{ $s }}</option>@endforeach</select>
    <button class="btn btn-grad py-2 px-3"><i class="bi bi-funnel me-1"></i>Filter</button>
    <a href="{{ route('admin.bookings.index') }}" class="btn btn-soft py-2 px-3">Reset</a>
  </form>
  <div class="card-body-x table-responsive">
    <table class="table-x">
      <thead><tr><th>#</th><th>Customer</th><th>Treatment</th><th>Therapist</th><th>Date & Time</th><th>Duration</th><th>Price</th><th>Status</th><th>Action</th></tr></thead>
      <tbody>
      @forelse($bookings as $b)
        <tr><td>{{ $b->id }}</td><td>{{ $b->user->name }}</td><td>{{ $b->treatment->treatment_name }}</td><td>{{ $b->therapist->therapist_name }}</td>
            <td>{{ $b->booking_date->format('d M Y') }}<br><small class="text-muted">{{ \Carbon\Carbon::parse($b->booking_time)->format('h:i A') }}</small></td>
            <td>{{ $b->duration }} min</td><td><b>₹{{ number_format($b->price, 2) }}</b></td>
            <td>
              <form method="POST" action="{{ route('admin.bookings.status', $b) }}">@csrf @method('PATCH')
                <select name="status" onchange="this.form.submit()" class="form-select form-select-sm s-{{ $b->status }}" style="border-radius:30px;font-weight:600;min-width:125px;border:0">
                  @foreach(\App\Models\Booking::STATUSES as $s)<option @selected($b->status == $s)>{{ $s }}</option>@endforeach
                </select></form></td>
            <td class="d-flex gap-2">
              <a class="btn-ico edit" href="{{ route('admin.bookings.edit', $b) }}"><i class="bi bi-pencil"></i></a>
              <form method="POST" action="{{ route('admin.bookings.destroy', $b) }}" onsubmit="return confirm('Delete this booking?')">@csrf @method('DELETE')<button class="btn-ico del"><i class="bi bi-trash"></i></button></form>
            </td></tr>
      @empty
        <tr><td colspan="9"><div class="empty"><i class="bi bi-calendar-x"></i>No bookings match your filters</div></td></tr>
      @endforelse
      </tbody>
    </table>
    {{ $bookings->links('pagination::bootstrap-5') }}
  </div>
</div>
@endsection
