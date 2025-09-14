@extends('layouts.admin.app')

@section('content')
<main class="page-content">
    <div class="page-breadcrumb mb-3 d-flex align-items-center">
        <div class="breadcrumb-title pe-3">Masters</div>
        <div class="ps-3">Edit Course / Certificate</div>
        <div class="ms-auto">
            <a href="{{ route('admin.course-certificates.index') }}" class="btn btn-primary">Back to List</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.course-certificates.update', $item->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $item->name) }}" required>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Sort</label>
                    <input type="number" name="sort" class="form-control" value="{{ old('sort', $item->sort) }}">
                </div>

                <div class="mb-3">
                    <button class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection
