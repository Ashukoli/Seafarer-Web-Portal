{{-- filepath: resources/views/admin/company/show.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-start mb-3">
        <div>
            <h3>{{ $company->company_name }}</h3>
            <p class="mb-0 text-muted">{{ $company->company_email }}</p>
        </div>
        <div>
            <a href="{{ route('admin.company.edit', $company->id) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('admin.company.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-3">
                    @if(!empty($company->company_logo))
                        <img src="{{ asset('theme/assets/images/company_logo/'.$company->company_logo) }}" class="img-fluid" alt="logo">
                    @endif
                </div>
                <div class="col-md-9">
                    <p><strong>Contact:</strong> {{ ($company->company_contact_country_code ?? '') . ' ' . ($company->company_contact_no ?? '') }}</p>
                    <p><strong>Website:</strong> {{ $company->website }}</p>
                    <p><strong>RPSL:</strong> {{ $company->rpsl_number }} @if($company->rpsl_expiry) (Expiry: {{ $company->rpsl_expiry }}) @endif</p>
                    <p><strong>Type / Account:</strong> {{ $company->company_type }} / {{ $company->account_type }}</p>
                    <p><strong>Area:</strong> {{ $company->area }}</p>
                    <p><strong>Address:</strong> {{ $company->address }}</p>
                    <p><strong>Directors:</strong><br>{{ nl2br(e($company->directors)) }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Optional: show subadmins --}}
    <div class="card">
        <div class="card-header">Subadmins</div>
        <div class="card-body p-0">
            @php $subs = \App\Models\CompanySubadmin::where('company_id', $company->id)->get(); @endphp
            @if($subs->isEmpty())
                <div class="p-3">No subadmins found.</div>
            @else
                <ul class="list-group list-group-flush">
                    @foreach($subs as $s)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong>{{ $s->name ?? $s->designation }}</strong><br>
                            <small class="text-muted">{{ $s->email }} {{ $s->country_code }} {{ $s->mobile }}</small>
                        </div>
                    </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
@endsection
