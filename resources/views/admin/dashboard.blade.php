@extends('layouts.panel')
@section('title', 'Dashboard')
@section('content')
<div class="row g-4 mb-4">
  @foreach([['Total Bookings',$stats['bookings'],'bi-calendar2-check','g-purple'],['Customers',$stats['customers'],'bi-people','g-pink'],['Treatments',$stats['treatments'],'bi-droplet-half','g-teal'],['Therapists',$stats['therapists'],'bi-person-heart','g-orange']] as $k => [$l,$n,$i,$g])
    <div class="col-6 col-xl-3 anim-up d{{ $k+1 }}">
      <div class="stat {{ $g }}"><i class="bi {{ $i }}"></i><div class="num">{{ $n }}</div><div class="lbl">{{ $l }}</div></div>
    </div>
  @endforeach
</div>

<div class="row g-4">
  <div class="col-lg-8 anim-up d2">
    <div class="card-x">
      <div class="card-head"><h5>Recent Bookings</h5><a href="{{ route('admin.bookings.index') }}" class="btn btn-soft btn-sm px-3">View all</a></div>
      <div class="card-body-x table-responsive">
        <table class="table-x">
          <thead><tr><th>Customer</th><th>Treatment</th><th>Therapist</th><th>Date</th><th>Status</th></tr></thead>
          <tbody>
          @forelse($recent as $b)
            <tr><td>{{ $b->user->name }}</td><td>{{ $b->treatment->treatment_name }}</td><td>{{ $b->therapist->therapist_name }}</td>
                <td>{{ $b->booking_date->format('d M Y') }}</td><td><span class="badge-s s-{{ $b->status }}">{{ $b->status }}</span></td></tr>
          @empty
            <tr><td colspan="5"><div class="empty"><i class="bi bi-inbox"></i>No bookings yet</div></td></tr>
          @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-lg-4 anim-up d3">
    <div class="card-x mb-4">
      <div class="card-head"><h5>Booking Status</h5></div>
      <div class="card-body-x">
        @foreach(\App\Models\Booking::STATUSES as $s)
          @php $c = $statusCounts[$s] ?? 0; $pct = $stats['bookings'] ? round($c / $stats['bookings'] * 100) : 0; @endphp
          <div class="mb-3">
            <div class="d-flex justify-content-between small mb-1"><span class="badge-s s-{{ $s }}">{{ $s }}</span><b>{{ $c }}</b></div>
            <div class="progress" style="height:8px;border-radius:10px"><div class="progress-bar" style="width:{{ $pct }}%;background:var(--grad);border-radius:10px"></div></div>
          </div>
        @endforeach
      </div>
    </div>
    <div class="stat g-teal"><i class="bi bi-currency-rupee"></i><div class="num">₹{{ number_format($revenue, 2) }}</div><div class="lbl">Revenue (Completed)</div></div>
  </div>
</div>
@endsection
