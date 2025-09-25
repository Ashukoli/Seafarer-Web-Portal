{{-- filepath: resources/views/company/subadmin/edit.blade.php --}}
@extends('layouts.company.app')
@section('content')
<main class="page-content professional-bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card mt-4">
                    <div class="card-header">
                        <h4>Edit Subadmin</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('company.subadmin.update', $subadmin->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label">First Name</label>
                                <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $subadmin->first_name) }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Last Name</label>
                                <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $subadmin->last_name) }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Designation</label>
                                <input type="text" name="designation" class="form-control" value="{{ old('designation', $subadmin->designation) }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Country Code</label>
                                <input type="text" name="country_code" class="form-control" value="{{ old('country_code', $subadmin->country_code) }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Mobile</label>
                                <input type="text" name="mobile" class="form-control" value="{{ old('mobile', $subadmin->mobile) }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $subadmin->email) }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select" required>
                                    <option value="active" {{ $subadmin->status == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ $subadmin->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                            {{-- <div class="d-flex justify-content-between">
                                <a href="{{ route('company.subadmin.list') }}" class="btn btn-secondary">Back</a>
                                <button type="submit" class="btn btn-success">Update</button>
                            </div> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
