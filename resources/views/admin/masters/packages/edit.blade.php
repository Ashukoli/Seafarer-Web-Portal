{{-- filepath: resources/views/admin/masters/packages/edit.blade.php --}}
@extends('layouts.admin.app')

@section('title', 'Edit Package')

@section('content')
<main class="page-content professional-bg">
    <div class="container-fluid px-4">

        {{-- Breadcrumbs --}}
        <div class="row mb-4">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 bg-transparent p-0">
                        <li class="breadcrumb-item">Masters</li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page"><b>Edit Package</b></li>
                    </ol>
                </nav>
                <a href="{{ route('admin.packages.index') }}" class="btn btn-primary">List of Packages</a>
            </div>
        </div>

        {{-- Card/Form --}}
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="mb-3 fw-bold">EDIT PACKAGE</h5>
                        <hr>
                        <form action="{{ route('admin.packages.update', $package->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="package_name" class="form-label">Package Name <span class="text-danger">*</span></label>
                                <input type="text" name="package_name" id="package_name" class="form-control" value="{{ old('package_name', $package->package_name) }}" required>
                                @error('package_name')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="package_count" class="form-label">Package Count</label>
                                <input type="number" name="package_count" id="package_count" class="form-control" value="{{ old('package_count', $package->package_count) }}" required>
                                @error('package_count')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="active" {{ (old('status', $package->status) == 'active') ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ (old('status', $package->status) == 'inactive') ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('status')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-success w-100">Update Package</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>
@endsection