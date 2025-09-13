@extends('layouts.admin.app')

@section('content')
<main class="page-content">
    <!-- Breadcrumb -->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Masters</div>
        <div class="ps-3">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active">Edit Country</li>
            </ol>
        </div>
        <div class="ms-auto">
            <a href="{{ route('admin.countries.index') }}" class="btn btn-primary">Back to List</a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h6 class="mb-0 text-uppercase">Edit Country</h6>
                    <hr>
                    <form method="POST" action="{{ route('admin.countries.update', $country->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Country Name</label>
                            <input type="text" name="country_name"
                                   class="form-control @error('country_name') is-invalid @enderror"
                                   value="{{ old('country_name', $country->country_name) }}" required>
                            @error('country_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sort</label>
                            <input type="number" name="sort"
                                   class="form-control"
                                   value="{{ old('sort', $country->sort) }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Update Country</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
