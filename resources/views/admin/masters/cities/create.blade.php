@extends('layouts.admin.app')

@section('content')
<main class="page-content">
    <div class="page-breadcrumb mb-3">
        <div class="breadcrumb-title pe-3">Masters</div>
        <div class="ps-3"><span>Add City</span></div>
        <div class="ms-auto">
            <a href="{{ route('admin.cities.index') }}" class="btn btn-primary">Back to List</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.cities.store') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">State</label>
                    <select name="state_id" class="form-select" required>
                        <option value="">Select State</option>
                        @foreach($states as $state)
                            <option value="{{ $state->id }}">
                                {{ $state->state_name }} ({{ $state->country->country_name }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">City Name</label>
                    <input type="text" name="city_name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Sort</label>
                    <input type="number" name="sort" class="form-control" value="0">
                </div>
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Save City</button>
            </form>
        </div>
    </div>
</main>
@endsection
