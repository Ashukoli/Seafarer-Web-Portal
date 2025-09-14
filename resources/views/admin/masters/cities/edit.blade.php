@extends('layouts.admin.app')

@section('content')
<main class="page-content">
    <div class="page-breadcrumb mb-3">
        <div class="breadcrumb-title pe-3">Masters</div>
        <div class="ps-3"><span>Edit City</span></div>
        <div class="ms-auto">
            <a href="{{ route('admin.cities.index') }}" class="btn btn-primary">Back to List</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.cities.update', $city->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">State</label>
                    <select name="state_id" class="form-select" required>
                        @foreach($states as $state)
                            <option value="{{ $state->id }}"
                                {{ $state->id == $city->state_id ? 'selected' : '' }}>
                                {{ $state->state_name }} ({{ $state->country->country_name }})
                            </option>
                        @endforeach
                    </select>
                    @error('state_id')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">City Name</label>
                    <input type="text" name="city_name" value="{{ old('city_name', $city->city_name) }}"
                           class="form-control @error('city_name') is-invalid @enderror" required>
                    @error('city_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Sort</label>
                    <input type="number" name="sort" value="{{ old('sort', $city->sort) }}"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="1" {{ $city->status ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ !$city->status ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Update City</button>
            </form>
        </div>
    </div>
</main>
@endsection
