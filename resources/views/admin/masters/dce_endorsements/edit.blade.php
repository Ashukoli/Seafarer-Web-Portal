@extends('layouts.admin.app')

@section('content')
<main class="page-content">
    <h4>Edit DCE Endorsement</h4>
    <form method="POST" action="{{ route('admin.dce-endorsements.update', $dce_endorsement->id) }}">
        @csrf @method('PUT')
        <div class="mb-3">
            <label class="form-label">DCE Name</label>
            <input type="text" name="dce_name" class="form-control" value="{{ $dce_endorsement->dce_name }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Sort</label>
            <input type="number" name="sort" class="form-control" value="{{ $dce_endorsement->sort }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</main>
@endsection
