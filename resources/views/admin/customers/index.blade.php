@extends('layouts.panel')
@section('title', 'Customers')
@section('content')
<div class="card-x anim-up">
  <div class="card-head"><h5>All Customers</h5>
    <form class="d-flex gap-2"><input name="q" value="{{ request('q') }}" class="form-control" placeholder="Search name / email"><button class="btn btn-grad py-2"><i class="bi bi-search"></i></button></form>
  </div>
  <div class="card-body-x table-responsive">
    <table class="table-x">
      <thead><tr><th>#</th><th>Name</th><th>Email</th><th>Contact</th><th>Bookings</th><th>Joined</th><th>Action</th></tr></thead>
      <tbody>
      @forelse($customers as $c)
        <tr><td>{{ $c->id }}</td>
            <td><div class="d-flex align-items-center gap-2"><div class="avatar" style="width:34px;height:34px;font-size:.8rem">{{ strtoupper(substr($c->name,0,1)) }}</div>{{ $c->name }}</div></td>
            <td>{{ $c->email }}</td><td>{{ $c->contact }}</td><td><span class="chip">{{ $c->bookings_count }}</span></td>
            <td>{{ $c->created_at->format('d M Y') }}</td>
            <td><form method="POST" action="{{ route('admin.customers.destroy', $c) }}" onsubmit="return confirm('Delete this customer and all their bookings?')">@csrf @method('DELETE')
                <button class="btn-ico del"><i class="bi bi-trash"></i></button></form></td></tr>
      @empty
        <tr><td colspan="7"><div class="empty"><i class="bi bi-people"></i>No customers found</div></td></tr>
      @endforelse
      </tbody>
    </table>
    {{ $customers->links('pagination::bootstrap-5') }}
  </div>
</div>
@endsection
