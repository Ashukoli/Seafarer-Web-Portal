@extends('layouts.admin.app')

@section('content')
<main class="page-content">
    <div class="page-breadcrumb mb-3 d-flex align-items-center justify-content-between">
        <div>
            <div class="breadcrumb-title pe-3">Masters</div>
            <div class="ps-3"><span>Add Mobile Country Code</span></div>
        </div>
        <div>
            <a href="{{ route('admin.mobile-country-codes.index') }}" class="btn btn-primary">
                <i class="bx bx-list-ul me-1"></i> Back to List
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.mobile-country-codes.store') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Country Name</label>
                    <input type="text"
                           name="country_name"
                           value="{{ old('country_name') }}"
                           class="form-control @error('country_name') is-invalid @enderror"
                           required>
                    @error('country_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Country Code (ISO)</label>
                    <input type="text"
                           name="country_code"
                           value="{{ old('country_code') }}"
                           class="form-control @error('country_code') is-invalid @enderror"
                           placeholder="IN, US, UK"
                           required>
                    @error('country_code')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Dial Code</label>
                    <input type="text"
                           name="dial_code"
                           value="{{ old('dial_code') }}"
                           class="form-control @error('dial_code') is-invalid @enderror"
                           placeholder="+91, +1"
                           required>
                    @error('dial_code')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">
                        <i class="bx bx-save me-1"></i> Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection
