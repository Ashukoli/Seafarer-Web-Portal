@extends('layouts.admin.app')

@section('title', 'Seafarer Management')

@section('content')
<main class="page-content professional-bg">
    <div class="container-fluid px-4">
        <!-- Enhanced Breadcrumb -->
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
                                <i class="bx bx-user-circle"></i>
                            </div>
                            <span class="breadcrumb-text">Seafarer Candidates</span>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Professional Page Header -->
        <div class="compact-header-section mb-4">
            <div class="compact-header-card">
                <div class="compact-header-content">
                    <div class="compact-header-icon">
                        <i class="bx bx-user-circle"></i>
                    </div>
                    <div class="compact-header-text">
                        <h1 class="compact-page-title">Seafarer Candidate Management</h1>
                        <p class="compact-page-subtitle">Manage maritime professionals, review profiles, and track candidate registrations</p>
                    </div>
                </div>
                <div class="compact-header-actions">
                    <a href="{{ route('admin.candidates.create') }}" class="enterprise-btn btn-success">
                        <i class="bx bx-user-plus"></i>
                        <span>Register New Candidate</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="modern-alert modern-alert-success mb-4">
                <div class="alert-icon">
                    <i class="bx bx-check-circle"></i>
                </div>
                <div class="alert-content">
                    <strong>Success!</strong>
                    <span>{{ session('success') }}</span>
                </div>
                <button type="button" class="alert-close" onclick="this.parentElement.remove()">
                    <i class="bx bx-x"></i>
                </button>
            </div>
        @endif

        @if(session('error'))
            <div class="modern-alert modern-alert-error mb-4">
                <div class="alert-icon">
                    <i class="bx bx-error-circle"></i>
                </div>
                <div class="alert-content">
                    <strong>Error!</strong>
                    <span>{{ session('error') }}</span>
                </div>
                <button type="button" class="alert-close" onclick="this.parentElement.remove()">
                    <i class="bx bx-x"></i>
                </button>
            </div>
        @endif

        <!-- Professional Search & Filter Section -->
        <div class="modern-professional-card mb-4">
            <div class="card-header modern-header">
                <div class="header-content">
                    <div class="header-icon">
                        <i class="bx bx-search-alt"></i>
                    </div>
                    <div class="header-text">
                        <h5 class="header-title">Search & Filter Candidates</h5>
                        <p class="header-subtitle">Find specific candidates using various search criteria</p>
                    </div>
                </div>
            </div>
            <div class="card-body modern-body">
                <form method="GET" class="modern-search-form">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="modern-form-group">
                                <label class="modern-form-label">
                                    <span class="label-text">Search Keywords</span>
                                </label>
                                <div class="input-container">
                                    <input type="text" name="q" value="{{ $filters['q'] ?? '' }}"
                                           class="modern-form-control"
                                           placeholder="Name, email, INDOS, passport...">
                                    <div class="input-icon">
                                        <i class="bx bx-search"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="modern-form-group">
                                <label class="modern-form-label">
                                    <span class="label-text">Rank Filter</span>
                                </label>
                                <div class="input-container">
                                    <select name="rank_id" class="modern-form-control modern-form-select">
                                        <option value="">All Ranks</option>
                                        @foreach(\App\Models\Rank::orderBy('sort')->get() as $r)
                                            <option value="{{ $r->id }}" {{ isset($filters['rank_id']) && $filters['rank_id']==$r->id ? 'selected' : '' }}>
                                                {{ $r->rank }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="validation-icon">
                                        <i class="bx bx-check-circle valid-icon"></i>
                                        <i class="bx bx-error-circle invalid-icon"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="modern-form-group">
                                <label class="modern-form-label">
                                    <span class="label-text">Age Range</span>
                                </label>
                                <div class="input-container">
                                    <select name="age_range" class="modern-form-control modern-form-select">
                                        <option value="">All Ages</option>
                                        <option value="18-25" {{ isset($filters['age_range']) && $filters['age_range']=='18-25' ? 'selected' : '' }}>18-25 years</option>
                                        <option value="26-35" {{ isset($filters['age_range']) && $filters['age_range']=='26-35' ? 'selected' : '' }}>26-35 years</option>
                                        <option value="36-45" {{ isset($filters['age_range']) && $filters['age_range']=='36-45' ? 'selected' : '' }}>36-45 years</option>
                                        <option value="46-60" {{ isset($filters['age_range']) && $filters['age_range']=='46-60' ? 'selected' : '' }}>46-60 years</option>
                                    </select>
                                    <div class="validation-icon">
                                        <i class="bx bx-check-circle valid-icon"></i>
                                        <i class="bx bx-error-circle invalid-icon"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="modern-form-group">
                                <label class="modern-form-label">
                                    <span class="label-text">&nbsp;</span>
                                </label>
                                <div class="search-actions">
                                    <button type="submit" class="enterprise-btn btn-primary">
                                        <i class="bx bx-search"></i>
                                        <span>Search</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Candidates Data Section -->
        <div class="enterprise-section">
            <div class="section-header-wrapper">
                <div class="section-header-content">
                    <div class="section-icon-badge candidates-badge">
                        <i class="bx bx-group"></i>
                    </div>
                    <div class="section-title-group">
                        <h2 class="section-primary-title">Registered Candidates</h2>
                        <p class="section-description">Complete list of maritime professionals and their profiles</p>
                    </div>
                </div>
                <div class="candidates-summary">
                    <div class="summary-stat">
                        <span class="stat-number">{{ $candidates->total() }}</span>
                        <span class="stat-label">Total Candidates</span>
                    </div>
                    <div class="summary-stat">
                        <span class="stat-number">{{ $candidates->where('status', 'active')->count() }}</span>
                        <span class="stat-label">Active Profiles</span>
                    </div>
                    <div class="summary-stat">
                        <span class="stat-number">{{ $candidates->where('created_at', '>=', now()->subDays(30))->count() }}</span>
                        <span class="stat-label">New This Month</span>
                    </div>
                </div>
            </div>

            <div class="professional-table-wrapper">
                <div class="table-container">
                    <table class="enterprise-data-table">
                        <thead class="table-header-section">
                            <tr>
                                <th class="table-header-cell no-column">
                                    <div class="header-cell-content">
                                        <i class="bx bx-hash header-icon"></i>
                                        <span>#</span>
                                    </div>
                                </th>
                                <th class="table-header-cell id-column">
                                    <div class="header-cell-content">
                                        <i class="bx bx-id-card header-icon"></i>
                                        <span>ID & Documents</span>
                                    </div>
                                </th>
                                <th class="table-header-cell dates-column">
                                    <div class="header-cell-content">
                                        <i class="bx bx-calendar header-icon"></i>
                                        <span>Registration Date</span>
                                    </div>
                                </th>
                                <th class="table-header-cell name-column">
                                    <div class="header-cell-content">
                                        <i class="bx bx-user header-icon"></i>
                                        <span>Name & Details</span>
                                    </div>
                                </th>
                                <th class="table-header-cell age-column">
                                    <div class="header-cell-content">
                                        <i class="bx bx-time header-icon"></i>
                                        <span>Age</span>
                                    </div>
                                </th>
                                <th class="table-header-cell mobile-column">
                                    <div class="header-cell-content">
                                        <i class="bx bx-phone header-icon"></i>
                                        <span>Mobile</span>
                                    </div>
                                </th>
                                <th class="table-header-cell rank-column">
                                    <div class="header-cell-content">
                                        <i class="bx bx-crown header-icon"></i>
                                        <span>Present Rank</span>
                                    </div>
                                </th>
                                <th class="table-header-cell applied-column">
                                    <div class="header-cell-content">
                                        <i class="bx bx-target-lock header-icon"></i>
                                        <span>Applied For</span>
                                    </div>
                                </th>
                                <th class="table-header-cell ship-column">
                                    <div class="header-cell-content">
                                        <i class="bx bx-ship header-icon"></i>
                                        <span>Last Ship</span>
                                    </div>
                                </th>
                                <th class="table-header-cell actions-column">
                                    <div class="header-cell-content">
                                        <i class="bx bx-cog header-icon"></i>
                                        <span>Actions</span>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="table-body-section">
                            @forelse($candidates as $candidate)
                                <tr class="table-data-row" data-candidate-id="{{ $candidate->id }}">
                                    <td class="table-data-cell no-cell">
                                        <div class="number-display">
                                            <span class="row-number">{{ $loop->iteration + ($candidates->currentPage()-1) * $candidates->perPage() }}</span>
                                        </div>
                                    </td>
                                    <td class="table-data-cell id-cell">
                                        <div class="id-display">
                                            <div class="id-info">
                                                <div class="candidate-id">
                                                    <span class="id-label">ID:</span>
                                                    <span class="id-value">{{ str_pad($candidate->id, 4, '0', STR_PAD_LEFT) }}</span>
                                                </div>
                                                <div class="indos-info">
                                                    <span class="indos-label">INDOS:</span>
                                                    <span class="indos-value">{{ optional($candidate->resume)->indos_number ?? 'N/A' }}</span>
                                                </div>
                                            </div>
                                            <div class="view-resume-link">
                                                <a href="{{ route('admin.candidates.show', $candidate->id) }}" class="resume-link">
                                                    <i class="bx bx-file-blank"></i>
                                                    <span>View Resume</span>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="table-data-cell dates-cell">
                                        <div class="dates-display">
                                            <div class="registration-date">
                                                <div class="date-primary">{{ $candidate->created_at->format('M d, Y') }}</div>
                                                <div class="date-secondary">{{ $candidate->created_at->format('D') }}</div>
                                            </div>
                                            @if(optional($candidate->resume)->date_of_availability)
                                                <div class="availability-date">
                                                    <small class="availability-label">Available:</small>
                                                    <small class="availability-value">{{ \Carbon\Carbon::parse($candidate->resume->date_of_availability)->format('M d, Y') }}</small>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="table-data-cell name-cell">
                                        <div class="name-display">
                                            <div class="candidate-avatar">
                                                <i class="bx bx-user-circle"></i>
                                            </div>
                                            <div class="name-info">
                                                <div class="primary-name">{{ $candidate->name }}</div>
                                                <div class="profile-name">
                                                    {{ optional($candidate->profile)->first_name }} {{ optional($candidate->profile)->last_name }}
                                                </div>
                                                <div class="email-info">{{ $candidate->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="table-data-cell age-cell">
                                        <div class="age-display">
                                            @if(optional($candidate->profile)->dob)
                                                @php
                                                    $age = \Carbon\Carbon::parse($candidate->profile->dob)->age;
                                                    $ageGroup = $age < 30 ? 'young' : ($age < 45 ? 'experienced' : 'senior');
                                                @endphp
                                                <div class="age-badge age-{{ $ageGroup }}">
                                                    <span class="age-number">{{ $age }}</span>
                                                    <span class="age-label">years</span>
                                                </div>
                                            @else
                                                <span class="no-data-text">N/A</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="table-data-cell mobile-cell">
                                        <div class="mobile-display">
                                            @php
                                                $mobile = $candidate->mobile_number ?? optional($candidate->profile)->mobile_number;
                                                $countryCode = $candidate->mobile_cc ?? optional($candidate->profile)->mobile_cc ?? '+91';
                                            @endphp
                                            @if($mobile)
                                                <div class="mobile-info">
                                                    <div class="mobile-primary">{{ $countryCode }} {{ $mobile }}</div>
                                                    @if(optional($candidate->profile)->whatsapp_number)
                                                        <div class="whatsapp-info">
                                                            <i class="bx bxl-whatsapp"></i>
                                                            <small>WhatsApp available</small>
                                                        </div>
                                                    @endif
                                                </div>
                                            @else
                                                <span class="no-data-text">N/A</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="table-data-cell rank-cell">
                                        <div class="rank-display">
                                            @php
                                                $presentRank = optional($candidate->resume)->present_rank ?
                                                    optional($candidate->resume->presentRank)->rank ?? optional($candidate->presentRank)->rank
                                                    : null;
                                            @endphp
                                            @if($presentRank)
                                                <div class="rank-badge">
                                                    <i class="bx bx-crown"></i>
                                                    <span class="rank-name">{{ $presentRank }}</span>
                                                </div>
                                            @else
                                                <span class="no-data-text">N/A</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="table-data-cell applied-cell">
                                        <div class="applied-display">
                                            @php
                                                $appliedRank = optional($candidate->resume)->post_applied_for ?
                                                    optional(\App\Models\Rank::find($candidate->resume->post_applied_for))->rank
                                                    : null;
                                            @endphp
                                            @if($appliedRank)
                                                <div class="applied-badge">
                                                    <i class="bx bx-target-lock"></i>
                                                    <span class="applied-name">{{ $appliedRank }}</span>
                                                </div>
                                            @else
                                                <span class="no-data-text">N/A</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="table-data-cell ship-cell">
                                        <div class="ship-display">
                                            @php
                                                $lastShip = optional($candidate->seaServiceDetails->first())->ship_name;
                                            @endphp
                                            @if($lastShip)
                                                <div class="ship-badge">
                                                    <i class="bx bx-ship"></i>
                                                    <span class="ship-name">{{ $lastShip }}</span>
                                                </div>
                                            @else
                                                <span class="no-data-text">No sea service</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="table-data-cell actions-cell">
                                        <div class="action-buttons-group">
                                            <a href="{{ route('admin.candidates.show', $candidate->id) }}"
                                               class="action-button view-button"
                                               data-tooltip="View Profile">
                                                <i class="bx bx-show"></i>
                                            </a>
                                            <button class="action-button email-button"
                                                    data-tooltip="Send Email"
                                                    onclick="sendEmail('{{ $candidate->email }}')">
                                                <i class="bx bx-envelope"></i>
                                            </button>
                                            <form action="{{ route('admin.candidates.destroy', $candidate->id) }}"
                                                  method="POST"
                                                  style="display:inline;"
                                                  onsubmit="return confirm('Are you sure you want to delete this candidate? This action cannot be undone.')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="action-button delete-button"
                                                        data-tooltip="Delete Candidate">
                                                    <i class="bx bx-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr class="empty-state-row">
                                    <td colspan="10" class="empty-state-cell">
                                        <div class="professional-empty-state">
                                            <div class="empty-state-icon candidates-empty-icon">
                                                <i class="bx bx-user-circle"></i>
                                            </div>
                                            <h3 class="empty-state-title">No Candidates Found</h3>
                                            <p class="empty-state-message">No seafarer candidates match your search criteria. Try adjusting your filters or register new candidates.</p>
                                            <a href="{{ route('admin.candidates.create') }}" class="enterprise-btn btn-success">
                                                <i class="bx bx-user-plus"></i>
                                                <span>Register First Candidate</span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Modern Pagination -->
            @if($candidates->hasPages())
                <div class="modern-pagination-wrapper">
                    <div class="pagination-info">
                        <span class="pagination-text">
                            Showing {{ $candidates->firstItem() ?? 0 }} to {{ $candidates->lastItem() ?? 0 }}
                            of {{ $candidates->total() }} candidates
                        </span>
                    </div>
                    <div class="pagination-controls">
                        {{ $candidates->withQueryString()->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</main>
@endsection

@push('styles')
<style>
/* Professional Design Variables */
:root {
    --primary-color: #4f46e5;
    --primary-hover: #4338ca;
    --primary-light: #f0f4ff;
    --success-color: #059669;
    --success-hover: #047857;
    --success-light: #f0fdf9;
    --warning-color: #d97706;
    --warning-hover: #b45309;
    --warning-light: #fffbeb;
    --danger-color: #dc2626;
    --danger-hover: #b91c1c;
    --danger-light: #fef2f2;
    --info-color: #0891b2;
    --info-hover: #0e7490;
    --info-light: #f0f9ff;
    --secondary-color: #64748b;
    --secondary-hover: #475569;
    --secondary-light: #f8fafc;
    --background-primary: #f8fafc;
    --surface-elevated: #ffffff;
    --border-primary: #e2e8f0;
    --text-primary: #0f172a;
    --text-secondary: #475569;
    --text-muted: #94a3b8;
    --shadow-subtle: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    --shadow-medium: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
    --shadow-elevated: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.1);
    --shadow-floating: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
    --border-radius-sm: 8px;
    --border-radius-md: 12px;
    --border-radius-lg: 16px;
    --transition-fast: all 0.15s ease;
    --transition-medium: all 0.25s ease;
    --spacing-xs: 0.5rem;
    --spacing-sm: 0.75rem;
    --spacing-md: 1rem;
    --spacing-lg: 1.5rem;
    --spacing-xl: 2rem;
}

.professional-bg {
    background: linear-gradient(135deg, var(--background-primary) 0%, #f1f5f9 100%);
    min-height: 100vh;
    padding: var(--spacing-xl) 0;
}

/* Modern Breadcrumb */
.modern-breadcrumb {
    display: flex;
    align-items: center;
    background: var(--surface-elevated);
    padding: var(--spacing-md) var(--spacing-lg);
    border-radius: var(--border-radius-md);
    box-shadow: var(--shadow-subtle);
    border: 1px solid var(--border-primary);
    margin: 0;
    list-style: none;
    gap: var(--spacing-sm);
    flex-wrap: wrap;
}

.breadcrumb-item {
    display: flex;
    align-items: center;
    gap: var(--spacing-xs);
}

.breadcrumb-link {
    display: flex;
    align-items: center;
    gap: var(--spacing-xs);
    text-decoration: none;
    color: var(--text-secondary);
    font-size: 0.875rem;
    font-weight: 500;
    padding: var(--spacing-xs) var(--spacing-sm);
    border-radius: var(--border-radius-sm);
    transition: var(--transition-fast);
}

.breadcrumb-link:hover {
    color: var(--primary-color);
    background: var(--primary-light);
    text-decoration: none;
}

.breadcrumb-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 20px;
    height: 20px;
    border-radius: 4px;
    background: var(--primary-light);
    color: var(--primary-color);
    font-size: 0.875rem;
}

.breadcrumb-link:hover .breadcrumb-icon {
    background: var(--primary-color);
    color: white;
}

.breadcrumb-text {
    font-weight: 500;
}

.breadcrumb-separator {
    color: var(--text-muted);
    font-size: 0.75rem;
}

.breadcrumb-item.active {
    color: var(--text-primary);
    font-weight: 600;
}

.breadcrumb-item.active .breadcrumb-icon {
    background: var(--primary-color);
    color: white;
}

/* Compact Header */
.compact-header-section {
    margin-bottom: var(--spacing-lg);
}

.compact-header-card {
    background: var(--surface-elevated);
    border-radius: var(--border-radius-md);
    box-shadow: var(--shadow-subtle);
    border: 1px solid var(--border-primary);
    padding: var(--spacing-lg);
    position: relative;
    overflow: hidden;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.compact-header-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--primary-color) 0%, var(--info-color) 100%);
}

.compact-header-content {
    display: flex;
    align-items: center;
    gap: var(--spacing-md);
    flex: 1;
}

.compact-header-icon {
    width: 48px;
    height: 48px;
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-hover) 100%);
    border-radius: var(--border-radius-sm);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    flex-shrink: 0;
}

.compact-page-title {
    margin: 0 0 0.25rem 0;
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--text-primary);
    line-height: 1.3;
}

.compact-page-subtitle {
    margin: 0;
    font-size: 0.875rem;
    color: var(--text-secondary);
    line-height: 1.4;
}

.compact-header-actions {
    flex-shrink: 0;
}

/* Modern Alert Styling */
.modern-alert {
    display: flex;
    align-items: flex-start;
    gap: var(--spacing-md);
    padding: var(--spacing-md) var(--spacing-lg);
    border-radius: var(--border-radius-sm);
    border: 1px solid;
    position: relative;
    box-shadow: var(--shadow-subtle);
    animation: slideInDown 0.3s ease-out;
}

@keyframes slideInDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.modern-alert-success {
    background: linear-gradient(135deg, rgba(5, 150, 105, 0.08) 0%, rgba(5, 150, 105, 0.05) 100%);
    border-color: rgba(5, 150, 105, 0.2);
    color: #065f46;
}

.modern-alert-error {
    background: linear-gradient(135deg, rgba(220, 38, 38, 0.08) 0%, rgba(220, 38, 38, 0.05) 100%);
    border-color: rgba(220, 38, 38, 0.2);
    color: #7f1d1d;
}

.alert-icon {
    flex-shrink: 0;
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    font-size: 1rem;
}

.modern-alert-success .alert-icon {
    background: var(--success-color);
    color: white;
}

.modern-alert-error .alert-icon {
    background: var(--danger-color);
    color: white;
}

.alert-content {
    flex: 1;
    line-height: 1.5;
}

.alert-content strong {
    font-weight: 600;
    display: inline;
    margin-right: 0.5rem;
    font-size: 0.875rem;
}

.alert-close {
    position: absolute;
    top: var(--spacing-sm);
    right: var(--spacing-md);
    background: none;
    border: none;
    color: inherit;
    cursor: pointer;
    padding: 0.25rem;
    border-radius: 4px;
    transition: var(--transition-fast);
    opacity: 0.7;
}

.alert-close:hover {
    opacity: 1;
    background: rgba(0, 0, 0, 0.1);
}

/* Modern Professional Card */
.modern-professional-card {
    background: var(--surface-elevated);
    border-radius: var(--border-radius-md);
    box-shadow: var(--shadow-elevated);
    border: 1px solid var(--border-primary);
    overflow: hidden;
    transition: var(--transition-medium);
}

.modern-professional-card:hover {
    box-shadow: var(--shadow-floating);
}

/* Maritime-themed Header Styling */
.modern-header {
    background: linear-gradient(135deg, var(--info-light) 0%, #e0f7fa 100%);
    color: var(--info-color);
    padding: var(--spacing-lg);
    border: none;
    position: relative;
    overflow: hidden;
}

.modern-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="waves" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M0 20 Q10 10 20 20 T40 20" stroke="rgba(8,145,178,0.1)" stroke-width="2" fill="none"/></pattern></defs><rect width="100" height="100" fill="url(%23waves)"/></svg>');
    opacity: 1;
}

.header-content {
    display: flex;
    align-items: center;
    gap: var(--spacing-md);
    position: relative;
    z-index: 1;
}

.header-icon {
    background: rgba(8, 145, 178, 0.15);
    padding: var(--spacing-md);
    border-radius: var(--border-radius-sm);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(8, 145, 178, 0.2);
}

.header-icon i {
    font-size: 1.5rem;
    color: var(--info-color);
}

.header-title {
    margin: 0;
    font-size: 1.25rem;
    font-weight: 700;
    letter-spacing: -0.025em;
    color: var(--info-color);
}

.header-subtitle {
    margin: 0;
    font-size: 0.875rem;
    color: var(--info-hover);
    font-weight: 400;
}

/* Body Styling */
.modern-body {
    padding: var(--spacing-lg);
    background: var(--surface-elevated);
}

/* Search Form Styling */
.modern-search-form {
    background: linear-gradient(145deg, #fafbff 0%, #f1f5f9 100%);
    border: 1px solid rgba(8, 145, 178, 0.1);
    border-radius: var(--border-radius-md);
    padding: var(--spacing-lg);
}

.modern-form-group {
    margin-bottom: 0;
    position: relative;
}

.modern-form-label {
    display: flex;
    align-items: center;
    gap: var(--spacing-xs);
    margin-bottom: var(--spacing-sm);
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--text-primary);
}

.label-text {
    color: var(--text-primary);
}

.input-container {
    position: relative;
    display: flex;
    align-items: center;
}

.modern-form-control {
    width: 100%;
    padding: var(--spacing-sm) 2.5rem var(--spacing-sm) var(--spacing-md);
    font-size: 0.875rem;
    line-height: 1.5;
    color: var(--text-primary);
    background: white;
    border: 2px solid var(--border-primary);
    border-radius: var(--border-radius-sm);
    transition: var(--transition-fast);
    box-shadow: var(--shadow-subtle);
}

.modern-form-control:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    background: white;
}

.modern-form-control::placeholder {
    color: var(--text-muted);
    opacity: 1;
}

.modern-form-select {
    appearance: none;
    background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3E%3Cpath stroke='%236B7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3E%3C/svg%3E");
    background-position: right 0.75rem center;
    background-repeat: no-repeat;
    background-size: 1.5em 1.5em;
    padding-right: 3rem;
}

.input-icon {
    position: absolute;
    right: var(--spacing-sm);
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-muted);
    pointer-events: none;
    z-index: 2;
}

.validation-icon {
    position: absolute;
    right: var(--spacing-sm);
    top: 50%;
    transform: translateY(-50%);
    pointer-events: none;
    z-index: 2;
}

.valid-icon,
.invalid-icon {
    display: none;
    font-size: 1rem;
    transition: var(--transition-fast);
}

.search-actions {
    display: flex;
    align-items: end;
    height: 100%;
}

/* Enterprise Button */
.enterprise-btn {
    display: inline-flex;
    align-items: center;
    gap: var(--spacing-xs);
    padding: 0.75rem 1.5rem;
    font-size: 0.875rem;
    font-weight: 600;
    line-height: 1;
    border-radius: var(--border-radius-sm);
    border: 2px solid;
    text-decoration: none;
    cursor: pointer;
    transition: var(--transition-fast);
    white-space: nowrap;
}

.btn-success {
    background: var(--success-color);
    color: white;
    border-color: var(--success-color);
}

.btn-success:hover {
    background: var(--success-hover);
    border-color: var(--success-hover);
    color: white;
    transform: translateY(-1px);
    box-shadow: var(--shadow-medium);
}

.btn-primary {
    background: var(--primary-color);
    color: white;
    border-color: var(--primary-color);
}

.btn-primary:hover {
    background: var(--primary-hover);
    border-color: var(--primary-hover);
    color: white;
    transform: translateY(-1px);
    box-shadow: var(--shadow-medium);
}

/* Enterprise Section */
.enterprise-section {
    background: var(--surface-elevated);
    border-radius: var(--border-radius-md);
    box-shadow: var(--shadow-elevated);
    border: 1px solid var(--border-primary);
    overflow: hidden;
    transition: var(--transition-medium);
}

.enterprise-section:hover {
    box-shadow: var(--shadow-floating);
}

.section-header-wrapper {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: var(--spacing-lg) var(--spacing-xl);
    background: linear-gradient(135deg, #f1f5f9 0%, #f8fafc 100%);
    border-bottom: 1px solid var(--border-primary);
}

.section-header-content {
    display: flex;
    align-items: center;
    gap: var(--spacing-md);
}

.section-icon-badge {
    width: 48px;
    height: 48px;
    border-radius: var(--border-radius-md);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    border: 2px solid;
}

.candidates-badge {
    background: var(--primary-light);
    color: var(--primary-color);
    border-color: rgba(79, 70, 229, 0.2);
}

.section-title-group {
    flex: 1;
}

.section-primary-title {
    margin: 0 0 0.25rem 0;
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--text-primary);
    line-height: 1.3;
}

.section-description {
    margin: 0;
    font-size: 0.875rem;
    color: var(--text-secondary);
    line-height: 1.4;
}

.candidates-summary {
    display: flex;
    gap: var(--spacing-lg);
}

.summary-stat {
    text-align: center;
}

.stat-number {
    display: block;
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--primary-color);
    line-height: 1.2;
}

.stat-label {
    display: block;
    font-size: 0.75rem;
    color: var(--text-secondary);
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-top: 0.25rem;
}

/* Professional Table */
.professional-table-wrapper {
    background: var(--surface-elevated);
}

.table-container {
    overflow-x: auto;
}

.enterprise-data-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.875rem;
}

.table-header-section {
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
}

.table-header-cell {
    padding: 1rem;
    text-align: left;
    font-weight: 700;
    color: var(--text-primary);
    font-size: 0.8125rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    border-bottom: 2px solid var(--border-primary);
    white-space: nowrap;
}

.header-cell-content {
    display: flex;
    align-items: center;
    gap: var(--spacing-xs);
}

.header-icon {
    color: var(--primary-color);
    font-size: 1rem;
}

/* Column Sizing */
.no-column { width: 6%; }
.id-column { width: 12%; }
.dates-column { width: 10%; }
.name-column { width: 18%; }
.age-column { width: 8%; }
.mobile-column { width: 12%; }
.rank-column { width: 10%; }
.applied-column { width: 10%; }
.ship-column { width: 10%; }
.actions-column { width: 8%; }

.table-body-section {
    background: var(--surface-elevated);
}

.table-data-row {
    transition: var(--transition-fast);
    border-bottom: 1px solid rgba(226, 232, 240, 0.5);
}

.table-data-row:hover {
    background: rgba(248, 250, 252, 0.8);
    transform: translateY(-1px);
    box-shadow: var(--shadow-subtle);
}

.table-data-cell {
    padding: var(--spacing-md);
    vertical-align: middle;
    color: var(--text-primary);
}

/* Number Display */
.number-display {
    display: flex;
    justify-content: center;
}

.row-number {
    width: 32px;
    height: 32px;
    background: var(--primary-light);
    color: var(--primary-color);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 0.875rem;
}

/* ID Display */
.id-display {
    display: flex;
    flex-direction: column;
    gap: var(--spacing-xs);
}

.id-info {
    display: flex;
    flex-direction: column;
    gap: 0.125rem;
}

.candidate-id,
.indos-info {
    display: flex;
    gap: 0.25rem;
    align-items: center;
    font-size: 0.8125rem;
}

.id-label,
.indos-label {
    font-weight: 600;
    color: var(--text-secondary);
    min-width: 40px;
}

.id-value,
.indos-value {
    color: var(--text-primary);
    font-weight: 500;
}

.view-resume-link {
    margin-top: 0.25rem;
}

.resume-link {
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
    color: var(--info-color);
    text-decoration: none;
    font-size: 0.75rem;
    font-weight: 500;
    padding: 0.125rem 0.375rem;
    border-radius: var(--border-radius-sm);
    background: var(--info-light);
    transition: var(--transition-fast);
}

.resume-link:hover {
    background: var(--info-color);
    color: white;
}

/* Dates Display */
.dates-display {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.registration-date {
    display: flex;
    flex-direction: column;
    gap: 0.125rem;
}

.date-primary {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--text-primary);
    line-height: 1.3;
}

.date-secondary {
    font-size: 0.75rem;
    color: var(--text-muted);
    line-height: 1.2;
}

.availability-date {
    display: flex;
    flex-direction: column;
    gap: 0.125rem;
}

.availability-label {
    color: var(--info-color);
    font-weight: 600;
    font-size: 0.75rem;
}

.availability-value {
    color: var(--text-secondary);
    font-size: 0.75rem;
}

/* Name Display */
.name-display {
    display: flex;
    align-items: center;
    gap: var(--spacing-sm);
}

.candidate-avatar {
    width: 36px;
    height: 36px;
    background: var(--primary-light);
    color: var(--primary-color);
    border-radius: var(--border-radius-sm);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    border: 2px solid rgba(79, 70, 229, 0.2);
    flex-shrink: 0;
}

.name-info {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 0.125rem;
}

.primary-name {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--text-primary);
    line-height: 1.3;
}

.profile-name {
    font-size: 0.8125rem;
    color: var(--text-secondary);
    line-height: 1.2;
}

.email-info {
    font-size: 0.75rem;
    color: var(--text-muted);
    line-height: 1.2;
    word-break: break-all;
}

/* Age Display */
.age-display {
    display: flex;
    justify-content: center;
}

.age-badge {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 0.375rem 0.5rem;
    border-radius: var(--border-radius-sm);
    font-weight: 600;
    border: 2px solid;
}

.age-young {
    background: var(--success-light);
    color: var(--success-color);
    border-color: rgba(5, 150, 105, 0.2);
}

.age-experienced {
    background: var(--warning-light);
    color: var(--warning-color);
    border-color: rgba(217, 119, 6, 0.2);
}

.age-senior {
    background: var(--secondary-light);
    color: var(--secondary-color);
    border-color: rgba(100, 116, 139, 0.2);
}

.age-number {
    font-size: 0.875rem;
    line-height: 1.2;
}

.age-label {
    font-size: 0.6875rem;
    line-height: 1.1;
}

/* Mobile Display */
.mobile-display {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.mobile-info {
    display: flex;
    flex-direction: column;
    gap: 0.125rem;
}

.mobile-primary {
    font-size: 0.875rem;
    font-weight: 500;
    color: var(--text-primary);
    line-height: 1.3;
}

.whatsapp-info {
    display: flex;
    align-items: center;
    gap: 0.25rem;
    color: var(--success-color);
    font-size: 0.75rem;
}

/* Rank Display */
.rank-display {
    display: flex;
    justify-content: center;
}

.rank-badge {
    display: flex;
    align-items: center;
    gap: 0.375rem;
    padding: 0.375rem 0.75rem;
    background: var(--warning-light);
    color: var(--warning-color);
    border-radius: var(--border-radius-sm);
    font-weight: 600;
    border: 1px solid rgba(217, 119, 6, 0.2);
    font-size: 0.8125rem;
}

/* Applied Display */
.applied-display {
    display: flex;
    justify-content: center;
}

.applied-badge {
    display: flex;
    align-items: center;
    gap: 0.375rem;
    padding: 0.375rem 0.75rem;
    background: var(--info-light);
    color: var(--info-color);
    border-radius: var(--border-radius-sm);
    font-weight: 600;
    border: 1px solid rgba(8, 145, 178, 0.2);
    font-size: 0.8125rem;
}

/* Ship Display */
.ship-display {
    display: flex;
    justify-content: center;
}

.ship-badge {
    display: flex;
    align-items: center;
    gap: 0.375rem;
    padding: 0.375rem 0.75rem;
    background: var(--secondary-light);
    color: var(--secondary-color);
    border-radius: var(--border-radius-sm);
    font-weight: 600;
    border: 1px solid var(--border-primary);
    font-size: 0.8125rem;
}

/* Action Buttons */
.action-buttons-group {
    display: flex;
    align-items: center;
    gap: var(--spacing-xs);
    justify-content: center;
}

.action-button {
    width: 36px;
    height: 36px;
    border-radius: var(--border-radius-sm);
    border: 2px solid;
    background: var(--surface-elevated);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: var(--transition-fast);
    text-decoration: none;
    font-size: 0.875rem;
}

.view-button {
    color: var(--info-color);
    border-color: rgba(8, 145, 178, 0.3);
}

.view-button:hover {
    background: var(--info-light);
    border-color: var(--info-color);
    transform: translateY(-1px);
    box-shadow: var(--shadow-medium);
}

.email-button {
    color: var(--primary-color);
    border-color: rgba(79, 70, 229, 0.3);
}

.email-button:hover {
    background: var(--primary-light);
    border-color: var(--primary-color);
    transform: translateY(-1px);
    box-shadow: var(--shadow-medium);
}

.delete-button {
    color: var(--danger-color);
    border-color: rgba(220, 38, 38, 0.3);
}

.delete-button:hover {
    background: var(--danger-light);
    border-color: var(--danger-color);
    transform: translateY(-1px);
    box-shadow: var(--shadow-medium);
}

.no-data-text {
    font-size: 0.875rem;
    color: var(--text-muted);
    font-style: italic;
}

/* Professional Empty State */
.professional-empty-state {
    text-align: center;
    padding: var(--spacing-xl) var(--spacing-md);
    max-width: 480px;
    margin: 0 auto;
}

.empty-state-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto var(--spacing-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    font-size: 2.5rem;
}

.candidates-empty-icon {
    background: var(--primary-light);
    color: var(--primary-color);
}

.empty-state-title {
    margin: 0 0 var(--spacing-md) 0;
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--text-primary);
}

.empty-state-message {
    margin: 0 0 var(--spacing-lg) 0;
    color: var(--text-secondary);
    line-height: 1.6;
    font-size: 0.9375rem;
}

/* Modern Pagination */
.modern-pagination-wrapper {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: var(--spacing-lg) var(--spacing-xl);
    border-top: 1px solid var(--border-primary);
    background: linear-gradient(135deg, #f1f5f9 0%, #f8fafc 100%);
}

.pagination-info {
    flex: 1;
}

.pagination-text {
    font-size: 0.875rem;
    color: var(--text-secondary);
    font-weight: 500;
}

.pagination-controls {
    flex-shrink: 0;
}

/* Tooltips */
[data-tooltip] {
    position: relative;
}

[data-tooltip]:hover::after {
    content: attr(data-tooltip);
    position: absolute;
    bottom: 120%;
    left: 50%;
    transform: translateX(-50%);
    background: var(--text-primary);
    color: white;
    padding: var(--spacing-xs) var(--spacing-sm);
    border-radius: var(--border-radius-sm);
    font-size: 0.75rem;
    font-weight: 500;
    white-space: nowrap;
    z-index: 1000;
    opacity: 1;
    animation: tooltipFadeIn 0.2s ease-out;
}

@keyframes tooltipFadeIn {
    from {
        opacity: 0;
        transform: translateX(-50%) translateY(4px);
    }
    to {
        opacity: 1;
        transform: translateX(-50%) translateY(0);
    }
}

/* Responsive Design */
@media (max-width: 1200px) {
    .section-header-wrapper {
        flex-direction: column;
        gap: var(--spacing-lg);
        align-items: flex-start;
    }

    .compact-header-card {
        flex-direction: column;
        align-items: flex-start;
        gap: var(--spacing-md);
    }

    .compact-header-actions {
        align-self: stretch;
    }

    .enterprise-btn {
        width: 100%;
        justify-content: center;
    }

    .candidates-summary {
        justify-content: space-around;
        width: 100%;
    }
}

@media (max-width: 768px) {
    .professional-bg {
        padding: var(--spacing-md) 0;
    }

    .compact-header-card {
        padding: var(--spacing-md);
    }

    .compact-header-content {
        gap: var(--spacing-sm);
    }

    .compact-header-icon {
        width: 40px;
        height: 40px;
        font-size: 1.25rem;
    }

    .compact-page-title {
        font-size: 1.125rem;
    }

    .table-header-cell,
    .table-data-cell {
        padding: var(--spacing-sm);
        font-size: 0.8125rem;
    }

    .name-display {
        flex-direction: column;
        align-items: flex-start;
        gap: var(--spacing-xs);
    }

    .action-buttons-group {
        flex-direction: column;
        gap: 0.25rem;
    }

    .modern-breadcrumb {
        flex-direction: column;
        align-items: flex-start;
        gap: var(--spacing-xs);
        padding: var(--spacing-sm) var(--spacing-md);
    }

    .breadcrumb-separator {
        display: none;
    }

    .breadcrumb-item {
        width: 100%;
    }

    .breadcrumb-link {
        width: 100%;
        justify-content: flex-start;
        padding: var(--spacing-xs);
    }

    .modern-pagination-wrapper {
        flex-direction: column;
        gap: var(--spacing-md);
        text-align: center;
    }

    .email-info {
        display: none;
    }

    .whatsapp-info {
        display: none;
    }

    .availability-date {
        display: none;
    }
}

/* Focus States for Accessibility */
.enterprise-btn:focus,
.action-button:focus,
.breadcrumb-link:focus,
.modern-form-control:focus {
    outline: 2px solid var(--primary-color);
    outline-offset: 2px;
}

/* Table row animation on load */
.table-data-row {
    animation: fadeInUp 0.3s ease-out;
    animation-fill-mode: both;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.table-data-row:nth-child(odd) {
    animation-delay: 0.05s;
}

.table-data-row:nth-child(even) {
    animation-delay: 0.1s;
}
</style>
@endpush

@push('scripts')
<script>
function sendEmail(email) {
    if (email) {
        window.location.href = 'mailto:' + email;
    } else {
        alert('No email address available for this candidate.');
    }
}

$(document).ready(function() {
    // Auto-hide success/error alerts after 5 seconds
    $('.modern-alert').each(function() {
        const $alert = $(this);
        setTimeout(() => {
            $alert.fadeOut(300, () => $alert.remove());
        }, 5000);
    });

    // Enhanced search functionality
    $('.modern-form-control').on('input change', function() {
        validateField($(this));
    });

    function validateField($field) {
        const isValid = $field[0].checkValidity() && $field.val().trim() !== '';

        if (isValid) {
            $field.removeClass('is-invalid').addClass('is-valid');
        } else if ($field.val().trim() !== '') {
            $field.removeClass('is-valid').addClass('is-invalid');
        } else {
            $field.removeClass('is-valid is-invalid');
        }
    }

    // Table row hover effects
    $('.table-data-row').hover(
        function() {
            $(this).addClass('hovered');
        },
        function() {
            $(this).removeClass('hovered');
        }
    );

    // Confirm delete with enhanced dialog
    $('form[action*="destroy"]').on('submit', function(e) {
        e.preventDefault();

        const candidateName = $(this).closest('.table-data-row').find('.primary-name').text();

        if (confirm(`Are you sure you want to delete candidate "${candidateName}"?\n\nThis action cannot be undone and will permanently remove all their information including:\n- Personal details\n- Documents\n- Sea service records\n- Certificates\n\nClick OK to proceed or Cancel to abort.`)) {
            this.submit();
        }
    });

    // Enhanced table responsiveness
    function adjustTableForMobile() {
        const isMobile = window.innerWidth < 768;

        if (isMobile) {
            $('.table-container').addClass('mobile-optimized');
        } else {
            $('.table-container').removeClass('mobile-optimized');
        }
    }

    // Initial check and resize listener
    adjustTableForMobile();
    $(window).resize(adjustTableForMobile);

    // Smooth scrolling for pagination
    $('.pagination a').on('click', function() {
        $('html, body').animate({
            scrollTop: $('.enterprise-section').offset().top - 100
        }, 500);
    });
});
</script>
@endpush
