{{-- filepath: resources/views/admin/masters/packages/show.blade.php --}}
@extends('layouts.admin.app')

@section('title', 'Package Details')

@section('content')
<main class="page-content professional-bg">
    <div class="container-fluid px-4">
        <div class="compact-header-section mb-4">
            <div class="compact-header-card">
                <div class="compact-header-content">
                    <div class="compact-header-icon">
                        <i class="bx bx-package"></i>
                    </div>
                    <div class="compact-header-text">
                        <h1 class="compact-page-title">Package Details</h1>
                        <p class="compact-page-subtitle">View package information</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="enterprise-section p-4" style="max-width: 600px; margin: 0 auto;">
            <div class="mb-3">
                <label class="form-label fw-bold">Package Name:</label>
                <div>{{ $package->package_name }}</div>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Package Count:</label>
                <div>{{ $package->package_count }}</div>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Status:</label>
                <div>
                    <span class="badge {{ $package->status === 'active' ? 'badge-success' : 'badge-danger' }}">
                        {{ ucfirst($package->status) }}
                    </span>
                </div>
            </div>
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('admin.packages.index') }}" class="enterprise-btn btn-secondary">Back to List</a>
                <a href="{{ route('admin.packages.edit', $package->id) }}" class="enterprise-btn btn-success">
                    <i class="bx bx-edit"></i>
                    Edit Package
                </a>
            </div>
        </div>
    </div>
</main>
@endsection