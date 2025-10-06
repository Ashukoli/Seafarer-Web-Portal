{{-- filepath: resources/views/admin/masters/express_services/show.blade.php --}}
@extends('layouts.admin.app')

@section('title', 'Express Service Details')

@section('content')
<main class="page-content professional-bg">
    <div class="container-fluid px-4">

        {{-- Breadcrumbs --}}
       <div class="row mb-4">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="modern-breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}" class="breadcrumb-link">
                                <div class="breadcrumb-icon">
                                    <i class="bx bx-home-alt"></i>
                                </div>
                                <span class="breadcrumb-text">Dashboard</span>
                            </a>
                        </li>
                        <li class="breadcrumb-separator">
                            <i class="bx bx-chevron-right"></i>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#" class="breadcrumb-link">
                                <div class="breadcrumb-icon">
                                    <i class="bx bx-cog"></i>
                                </div>
                                <span class="breadcrumb-text">Masters</span>
                            </a>
                        </li>
                        <li class="breadcrumb-separator">
                            <i class="bx bx-chevron-right"></i>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <div class="breadcrumb-icon">
                                <i class="bx bx-package"></i>
                            </div>
                            <span class="breadcrumb-text">Express Services</span>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        {{-- Card/Details --}}
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="mb-3 fw-bold">EXPRESS SERVICE DETAILS</h5>
                        <hr>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Title:</label>
                            <div>{{ $expressService->package_title }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Description:</label>
                            <div>{{ $expressService->description }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Amount:</label>
                            <div>{{ number_format($expressService->amount, 2) }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Image:</label>
                            <div>
                                @if($expressService->image)
                                    <img src="{{ asset('storage/' . $expressService->image) }}" alt="Image" width="80" height="80" style="object-fit:cover;">
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Status:</label>
                            <div>
                                <span class="badge {{ $expressService->status === 'active' ? 'badge-success' : 'badge-danger' }}">
                                    {{ ucfirst($expressService->status) }}
                                </span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('admin.expressservices.index') }}" class="btn btn-secondary">Back to List</a>
                            <a href="{{ route('admin.expressservices.edit', $expressService->id) }}" class="btn btn-success">
                                <i class="bx bx-edit"></i>
                                Edit Express Service
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>
@endsection