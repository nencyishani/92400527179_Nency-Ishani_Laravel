@extends('layouts.panel')
@section('title', $treatment->exists ? 'Edit Treatment' : 'Add Treatment')
@section('content')
<div class="card-x anim-up" style="max-width:760px">
  <div class="card-body-x">
    <form method="POST" action="{{ $treatment->exists ? route('admin.treatments.update', $treatment) : route('admin.treatments.store') }}">
      @csrf @if($treatment->exists) @method('PUT') @endif
      <div class="mb-3"><label class="form-label">Treatment Name</label>
        <input name="treatment_name" class="form-control @error('treatment_name') is-invalid @enderror" value="{{ old('treatment_name', $treatment->treatment_name) }}">
        @error('treatment_name')<div class="invalid-msg mt-1 ms-0">{{ $message }}</div>@enderror</div>
      <div class="mb-3"><label class="form-label">Description</label>
        <textarea name="description" rows="3" class="form-control">{{ old('description', $treatment->description) }}</textarea></div>
      <div class="row g-3 mb-4">
        <div class="col-md-6"><label class="form-label">Duration (minutes)</label>
          <input type="number" name="duration" class="form-control @error('duration') is-invalid @enderror" value="{{ old('duration', $treatment->duration) }}">
          @error('duration')<div class="invalid-msg mt-1 ms-0">{{ $message }}</div>@enderror</div>
        <div class="col-md-6"><label class="form-label">Price (₹)</label>
          <input type="number" step="0.01" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $treatment->price) }}">
          @error('price')<div class="invalid-msg mt-1 ms-0">{{ $message }}</div>@enderror</div>
      </div>
      <button class="btn btn-grad px-4"><i class="bi bi-check2-circle me-1"></i>Save</button>
      <a href="{{ route('admin.treatments.index') }}" class="btn btn-soft px-4 py-2 ms-2">Cancel</a>
    </form>
  </div>
</div>
@endsection
