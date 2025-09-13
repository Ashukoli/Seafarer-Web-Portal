@extends('layouts.admin.app')

@section('content')
<main class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Masters</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Ship Type</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{ route('admin.shiptypes.index') }}" class="btn btn-primary">List of Ship Types</a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="border p-3 rounded">
                        <h6 class="mb-0 text-uppercase">Add Ship Type</h6>
                        <hr>

                        @if(session('success'))
                            <div class="alert alert-success d-flex align-items-center" role="alert">
                                <div class="fs-3 text-success"><i class="bi bi-check-circle-fill"></i></div>
                                <div class="ms-3">
                                    <div class="text-success">{{ session('success') }}</div>
                                </div>
                            </div>
                        @endif

                        <form action="{{ route('admin.shiptypes.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Ship Name</label>
                                <input type="text" name="ship_name" class="form-control @error('ship_name') is-invalid @enderror" value="{{ old('ship_name') }}" required>
                                @error('ship_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Sort</label>
                                <input type="number" name="sort" class="form-control @error('sort') is-invalid @enderror" value="{{ old('sort', 0) }}" min="0">
                                @error('sort')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Save Ship Type</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
