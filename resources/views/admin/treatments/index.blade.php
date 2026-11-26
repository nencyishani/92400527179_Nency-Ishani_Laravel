@extends('layouts.panel')
@section('title', 'Treatments')
@section('content')
<div class="card-x anim-up">
  <div class="card-head"><h5>Spa Treatments</h5><a href="{{ route('admin.treatments.create') }}" class="btn btn-grad py-2 px-3"><i class="bi bi-plus-lg me-1"></i>Add Treatment</a></div>
  <div class="card-body-x table-responsive">
    <table class="table-x">
      <thead><tr><th>#</th><th>Treatment</th><th>Description</th><th>Duration</th><th>Price</th><th>Action</th></tr></thead>
      <tbody>
      @forelse($treatments as $t)
        <tr><td>{{ $t->id }}</td><td><b>{{ $t->treatment_name }}</b></td><td class="text-muted">{{ \Illuminate\Support\Str::limit($t->description, 55) }}</td>
            <td><span class="chip"><i class="bi bi-clock"></i>{{ $t->duration }} min</span></td><td><b>₹{{ number_format($t->price, 2) }}</b></td>
            <td class="d-flex gap-2">
              <a class="btn-ico edit" href="{{ route('admin.treatments.edit', $t) }}"><i class="bi bi-pencil"></i></a>
              <form method="POST" action="{{ route('admin.treatments.destroy', $t) }}" onsubmit="return confirm('Delete this treatment?')">@csrf @method('DELETE')<button class="btn-ico del"><i class="bi bi-trash"></i></button></form>
            </td></tr>
      @empty
        <tr><td colspan="6"><div class="empty"><i class="bi bi-droplet"></i>No treatments yet</div></td></tr>
      @endforelse
      </tbody>
    </table>
    {{ $treatments->links('pagination::bootstrap-5') }}
  </div>
</div>
@endsection
