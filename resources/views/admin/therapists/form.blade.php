@extends('layouts.panel')
@section('title', $therapist->exists ? 'Edit Therapist' : 'Add Therapist')
@section('content')
<div class="card-x anim-up" style="max-width:760px">
  <div class="card-body-x">
    <form method="POST" action="{{ $therapist->exists ? route('admin.therapists.update', $therapist) : route('admin.therapists.store') }}">
      @csrf @if($therapist->exists) @method('PUT') @endif
      @foreach([['therapist_name','Therapist Name','text'],['contact','Contact','tel'],['specialization','Specialization','text']] as [$n,$l,$t])
        <div class="mb-3"><label class="form-label">{{ $l }}</label>
          <input type="{{ $t }}" name="{{ $n }}" class="form-control @error($n) is-invalid @enderror" value="{{ old($n, $therapist->$n) }}">
          @error($n)<div class="invalid-msg mt-1 ms-0">{{ $message }}</div>@enderror</div>
      @endforeach
      <button class="btn btn-grad px-4"><i class="bi bi-check2-circle me-1"></i>Save</button>
      <a href="{{ route('admin.therapists.index') }}" class="btn btn-soft px-4 py-2 ms-2">Cancel</a>
    </form>
  </div>
</div>
@endsection
