{{-- filepath: resources/views/admin/company/index.blade.php --}}
@extends('layouts.admin.app')

@section('content')
<main class="page-content professional-bg">
    <div class="container">
        <!-- Enhanced Breadcrumb with Dashboard -->
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
                        <li class="breadcrumb-item active" aria-current="page">
                            <div class="breadcrumb-icon">
                                <i class="bx bx-buildings"></i>
                            </div>
                            <span class="breadcrumb-text">Companies</span>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="modern-professional-card">
            <div class="card-header modern-header">
                <div class="header-content">
                    <div class="header-icon">
                        <i class="bx bx-buildings"></i>
                    </div>
                    <div class="header-text">
                        <h5 class="header-title">Companies Management</h5>
                        <p class="header-subtitle">Manage company accounts and permissions</p>
                    </div>
                </div>
                <div class="header-actions">
                    <a href="{{ route('admin.company.register.step', 1) }}" class="modern-btn modern-btn-white">
                        <i class="bx bx-plus"></i>
                        <span>Add Company</span>
                    </a>
                </div>
            </div>

            <div class="card-body modern-body">
                @if(session('success'))
                    <div class="modern-alert modern-alert-success mb-4">
                        <div class="alert-icon">
                            <i class="bx bx-check-circle"></i>
                        </div>
                        <div class="alert-content">
                            <strong>Success!</strong>
                            {{ session('success') }}
                        </div>
                    </div>
                @endif

                <!-- Enhanced Search Filter -->
                <div class="search-filter-section">
                    <form method="GET" action="{{ route('admin.company.index') }}" class="modern-search-form">
                        <div class="search-row">
                            <div class="search-input-group">
                                <div class="search-icon">
                                    <i class="bx bx-search"></i>
                                </div>
                                <input type="text"
                                       name="search"
                                       class="modern-search-input"
                                       placeholder="Search companies by name..."
                                       value="{{ request('search') }}">
                            </div>
                            <div class="search-actions">
                                <button type="submit" class="modern-btn modern-btn-primary">
                                    <i class="bx bx-search"></i>
                                    <span>Search</span>
                                </button>
                                <a href="{{ route('admin.company.index') }}" class="modern-btn modern-btn-outline-secondary">
                                    <i class="bx bx-refresh"></i>
                                    <span>Reset</span>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Modern Data Table -->
                <div class="modern-table-container">
                    <div class="table-responsive">
                        <table class="modern-data-table">
                            <thead>
                                <tr>
                                    <th class="table-header-logo">Logo</th>
                                    <th class="table-header-company">Company Details</th>
                                    <th class="table-header-activity">Activity Stats</th>
                                    <th class="table-header-admin">Admin Access</th>
                                    <th class="table-header-actions">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($companies as $company)
                                <tr class="table-row">
                                    <td class="table-cell-logo">
                                        <div class="company-logo-wrapper">
                                            @if(!empty($company->company_logo))
                                                <img src="{{ asset('theme/assets/images/company_logo/' . $company->company_logo) }}"
                                                     alt="{{ $company->company_name }} Logo"
                                                     class="company-logo">
                                            @else
                                                <div class="logo-placeholder">
                                                    <i class="bx bx-building"></i>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="table-cell-company">
                                        <div class="company-info">
                                            <h6 class="company-name">{{ $company->company_name }}</h6>
                                            <p class="last-login">
                                                <i class="bx bx-time"></i>
                                                {{ $company->last_login ? $company->last_login->format('d M Y, h:i A') : 'Never Logged In' }}
                                            </p>
                                        </div>
                                    </td>
                                    <td class="table-cell-activity">
                                        <div class="activity-stats">
                                            <div class="stat-item">
                                                <span class="stat-value">{{ $company->resume_viewed ?? 0 }}</span>
                                                <span class="stat-label">Viewed</span>
                                            </div>
                                            <div class="stat-item">
                                                <span class="stat-value">{{ $company->resume_downloads ?? 0 }}</span>
                                                <span class="stat-label">Downloaded</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="table-cell-admin">
                                        <div class="admin-actions">
                                            <a href="{{ route('admin.company.adminlogins', $company->id) }}"
                                            class="admin-btn admin-btn-superadmin"
                                            data-tooltip="View Admin Logins">
                                                <i class="bx bx-user"></i>
                                                <span>Admin Logins</span>
                                            </a>
                                        </div>
                                    </td>
                                    <td class="table-cell-actions">
                                        <div class="action-buttons">
                                            <a href="{{ route('admin.company.edit', $company->id) }}"
                                               class="action-btn action-btn-edit"
                                               data-tooltip="Edit Company">
                                                <i class="bx bx-edit"></i>
                                            </a>
                                            {{-- Add Follow-Up button --}}
                                            <a href="{{ route('admin.company.followups.create', ['company_id' => $company->id]) }}"
                                               class="action-btn action-btn-add"
                                               data-tooltip="Add Follow-Up">
                                                <i class="bx bx-phone-call"></i>
                                            </a>
                                            <form action="{{ route('admin.company.destroy', $company->id) }}"
                                                  method="POST"
                                                  style="display:inline;"
                                                  onsubmit="return confirm('Are you sure you want to delete this company?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="action-btn action-btn-delete"
                                                        data-tooltip="Delete Company">
                                                    <i class="bx bx-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr class="empty-row">
                                    <td colspan="5" class="empty-cell">
                                        <div class="empty-state">
                                            <div class="empty-icon">
                                                <i class="bx bx-buildings"></i>
                                            </div>
                                            <h6 class="empty-title">No Companies Found</h6>
                                            <p class="empty-message">
                                                @if(request('search'))
                                                    No companies match your search criteria.
                                                @else
                                                    Get started by adding your first company.
                                                @endif
                                            </p>
                                            @if(!request('search'))
                                                <a href="{{ route('admin.company.register.step', 1) }}" class="modern-btn modern-btn-primary">
                                                    <i class="bx bx-plus"></i>
                                                    <span>Add First Company</span>
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Modern Pagination -->
                @if($companies->hasPages())
                    <div class="modern-pagination-wrapper">
                        {{ $companies->withQueryString()->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</main>
@endsection

