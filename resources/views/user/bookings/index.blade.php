@extends('layouts.panel')
@section('title', 'My Bookings')
@section('content')
<div class="card-x anim-up">
  <div class="card-head"><h5>My Bookings</h5><a href="{{ route('user.bookings.create') }}" class="btn btn-grad py-2 px-3"><i class="bi bi-plus-lg me-1"></i>New Booking</a></div>
  <div class="card-body-x table-responsive">
    <table class="table-x">
      <thead><tr><th>#</th><th>Treatment</th><th>Therapist</th><th>Date & Time</th><th>Duration</th><th>Price</th><th>Status</th><th>Action</th></tr></thead>
      <tbody>
      @forelse($bookings as $b)
        <tr><td>{{ $b->id }}</td><td><b>{{ $b->treatment->treatment_name }}</b></td><td>{{ $b->therapist->therapist_name }}</td>
            <td>{{ $b->booking_date->format('d M Y') }}<br><small class="text-muted">{{ \Carbon\Carbon::parse($b->booking_time)->format('h:i A') }}</small></td>
            <td>{{ $b->duration }} min</td><td><b>₹{{ number_format($b->price, 2) }}</b></td>
            <td><span class="badge-s s-{{ $b->status }}">{{ $b->status }}</span></td>
            <td>
              @if($b->isEditable())
              <div class="d-flex gap-2">
                <a class="btn-ico edit" href="{{ route('user.bookings.edit', $b) }}" title="Edit"><i class="bi bi-pencil"></i></a>
                <form method="POST" action="{{ route('user.bookings.destroy', $b) }}" onsubmit="return confirm('Cancel this booking?')">@csrf @method('DELETE')
                  <button class="btn-ico del" title="Cancel"><i class="bi bi-x-lg"></i></button></form>
              </div>
              @else <span class="text-muted small">—</span> @endif
            </td></tr>
      @empty
        <tr><td colspan="8"><div class="empty"><i class="bi bi-calendar-heart"></i>You have no bookings yet</div></td></tr>
      @endforelse
      </tbody>
    </table>
    {{ $bookings->links('pagination::bootstrap-5') }}
  </div>
</div>
@endsection
