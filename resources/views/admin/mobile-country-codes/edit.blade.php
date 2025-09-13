@extends('layouts.admin.app')

@section('content')
<main class="page-content">
    <div class="page-breadcrumb mb-3">
        <div class="breadcrumb-title pe-3">Masters</div>
        <div class="ps-3"><span>Edit Mobile Country Code</span></div>
        <div class="ms-auto">
            <a href="{{ route('admin.mobile-country-codes.index') }}" class="btn btn-primary">Back to List</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.mobile-country-codes.update', $code->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Country Name</label>
                    <input type="text" name="country_name"
                           class="form-control @error('country_name') is-invalid @enderror"
                           value="{{ old('country_name', $code->country_name) }}" required>
                    @error('country_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Country Code</label>
                    <input type="text" name="country_code"
                           class="form-control @error('country_code') is-invalid @enderror"
                           value="{{ old('country_code', $code->country_code) }}">
                    @error('country_code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Dial Code</label>
                    <input type="text" name="dial_code"
                           class="form-control @error('dial_code') is-invalid @enderror"
                           value="{{ old('dial_code', $code->dial_code) }}" placeholder="+91" required>
                    @error('dial_code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="1" {{ old('status', $code->status) == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status', $code->status) == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
        </div>
    </div>
</main>
@endsection
