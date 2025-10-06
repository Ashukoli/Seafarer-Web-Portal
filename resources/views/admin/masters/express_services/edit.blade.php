{{-- filepath: resources/views/admin/masters/express_services/edit.blade.php --}}
@extends('layouts.admin.app')

@section('title', 'Edit Express Service')

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

        {{-- Card/Form --}}
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="mb-3 fw-bold">EDIT EXPRESS SERVICE</h5>
                        <hr>
                        <form action="{{ route('admin.expressservices.update', $expressService->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="package_title" class="form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" name="package_title" id="package_title" class="form-control" value="{{ old('package_title', $expressService->package_title) }}" required>
                                @error('package_title')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="description" class="form-control">{{ old('description', $expressService->description) }}</textarea>
                                @error('description')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="amount" class="form-label">Amount <span class="text-danger">*</span></label>
                                <input type="number" name="amount" id="amount" class="form-control" value="{{ old('amount', $expressService->amount) }}" step="0.01" required>
                                @error('amount')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                @if($expressService->image)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $expressService->image) }}" alt="Image" width="80" height="80" style="object-fit:cover;">
                                    </div>
                                @endif
                                <input type="file" name="image" id="image" class="form-control">
                                @error('image')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="active" {{ (old('status', $expressService->status) == 'active') ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ (old('status', $expressService->status) == 'inactive') ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('status')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-success w-100">Update Express Service</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>
@endsection