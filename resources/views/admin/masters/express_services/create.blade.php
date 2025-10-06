{{-- filepath: resources/views/admin/masters/express_services/create.blade.php --}}
@extends('layouts.admin.app')

@section('title', 'Add Express Service')

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
                        <li class="breadcrumb-item active" aria-current="page"><b>Add Express Service</b></li>
                    </ol>
                </nav>
                <a href="{{ route('admin.expressservices.index') }}" class="btn btn-primary">List of Express Services</a>
            </div>
        </div>

        {{-- Card/Form --}}
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="mb-3 fw-bold">ADD EXPRESS SERVICE</h5>
                        <hr>
                        <form action="{{ route('admin.expressservices.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="package_title" class="form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" name="package_title" id="package_title" class="form-control" value="{{ old('package_title') }}" required>
                                @error('package_title')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="amount" class="form-label">Amount <span class="text-danger">*</span></label>
                                <input type="number" name="amount" id="amount" class="form-control" value="{{ old('amount') }}" step="0.01" required>
                                @error('amount')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" name="image" id="image" class="form-control">
                                @error('image')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('status')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-success w-100">Save Express Service</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>
@endsection