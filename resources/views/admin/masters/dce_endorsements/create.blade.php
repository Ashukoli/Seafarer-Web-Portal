@extends('layouts.admin.app')

@section('content')
<main class="page-content">
    <h4>Add DCE Endorsement</h4>
    <form method="POST" action="{{ route('admin.dce-endorsements.store') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">DCE Name</label>
            <input type="text" name="dce_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Sort</label>
            <input type="number" name="sort" class="form-control" value="0">
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</main>
@endsection
