@extends('layouts.panel')
@section('title', 'Therapists')
@section('content')
<div class="card-x anim-up">
  <div class="card-head"><h5>Therapists</h5><a href="{{ route('admin.therapists.create') }}" class="btn btn-grad py-2 px-3"><i class="bi bi-plus-lg me-1"></i>Add Therapist</a></div>
  <div class="card-body-x table-responsive">
    <table class="table-x">
      <thead><tr><th>#</th><th>Name</th><th>Contact</th><th>Specialization</th><th>Action</th></tr></thead>
      <tbody>
      @forelse($therapists as $t)
        <tr><td>{{ $t->id }}</td>
            <td><div class="d-flex align-items-center gap-2"><div class="avatar" style="width:34px;height:34px;font-size:.8rem">{{ strtoupper(substr($t->therapist_name,0,1)) }}</div><b>{{ $t->therapist_name }}</b></div></td>
            <td>{{ $t->contact }}</td><td><span class="chip">{{ $t->specialization }}</span></td>
            <td class="d-flex gap-2">
              <a class="btn-ico edit" href="{{ route('admin.therapists.edit', $t) }}"><i class="bi bi-pencil"></i></a>
              <form method="POST" action="{{ route('admin.therapists.destroy', $t) }}" onsubmit="return confirm('Delete this therapist?')">@csrf @method('DELETE')<button class="btn-ico del"><i class="bi bi-trash"></i></button></form>
            </td></tr>
      @empty
        <tr><td colspan="5"><div class="empty"><i class="bi bi-person-heart"></i>No therapists yet</div></td></tr>
      @endforelse
      </tbody>
    </table>
    {{ $therapists->links('pagination::bootstrap-5') }}
  </div>
</div>
@endsection
