@extends('layouts.admin.app')

@section('title', 'Seafarer Management')

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
                                <i class="bx bx-user"></i>
                            </div>
                            <span class="breadcrumb-text">Candidates</span>
                        </li>
                        <li class="breadcrumb-separator">
                            <i class="bx bx-chevron-right"></i>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <div class="breadcrumb-icon">
                                <i class="bx bx-user"></i>
                            </div>
                            <span class="breadcrumb-text">List of Candidates</span>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="modern-professional-card">
            <div class="card-header modern-header">
                <div class="header-content">
                    <div class="header-icon">
                        <i class="bx bx-user"></i>
                    </div>
                    <div class="header-text">
                        <h5 class="header-title">Seafarer Candidate Management</h5>
                        <p class="header-subtitle">Manage maritime professionals, review profiles, and track candidate registrations
                        </p>
                    </div>
                </div>
                <div class="header-actions">
                    <a href="{{ route('admin.candidates.create') }}" class="modern-btn modern-btn-white">
                        <i class="bx bx-plus"></i>
                        <span>Register New Candidate</span>
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
                    <form method="GET" action="{{ route('admin.candidates.index') }}" class="modern-search-form">
                        <div class="search-row">
                            <div class="search-input-group">
                                <div class="search-icon">
                                    <i class="bx bx-search"></i>
                                </div>
                                <input type="text"
                                       name="q"
                                       class="modern-search-input"
                                       placeholder="Search candidates by name, email, INDOS, passport..."
                                       value="{{ request('q') }}">
                            </div>
                            <div class="search-actions">
                                <button type="submit" class="modern-btn modern-btn-primary">
                                    <i class="bx bx-search"></i>
                                    <span>Search</span>
                                </button>
                                <a href="{{ route('admin.candidates.index') }}" class="modern-btn modern-btn-outline-secondary">
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
                                    <th>#</th>
                                    <th>Name & Email</th>
                                    <th>Reg. Date</th>
                                    <th>Age</th>
                                    <th>Mobile</th>
                                    <th>Present Rank</th>
                                    <th>Applied For</th>
                                    <th>Last Ship</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($candidates as $candidate)
                                <tr class="table-row" data-candidate-id="{{ $candidate->id }}">
                                    <td>
                                        <span class="row-number">{{ $loop->iteration + ($candidates->currentPage()-1) * $candidates->perPage() }}</span>
                                    </td>
                                    <td>
                                        <div class="company-info">
                                            <h6 class="company-name">{{ $candidate->name }}</h6>
                                            <div class="email-info">{{ $candidate->email }}</div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="date-display">
                                            <div class="date-primary">{{ $candidate->created_at->format('M d, Y') }}</div>
                                            @if(optional($candidate->resume)->date_of_availability)
                                                <div class="date-secondary">Avail: {{ \Carbon\Carbon::parse($candidate->resume->date_of_availability)->format('M d') }}</div>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        @if(optional($candidate->profile)->dob)
                                            @php
                                                $age = \Carbon\Carbon::parse($candidate->profile->dob)->age;
                                                $ageGroup = $age < 30 ? 'young' : ($age < 45 ? 'exp' : 'senior');
                                            @endphp
                                            <div class="age-badge age-{{ $ageGroup }}">{{ $age }}y</div>
                                        @else
                                            <span class="no-data">N/A</span>
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $mobile = $candidate->mobile_number ?? optional($candidate->profile)->mobile_number;
                                            $countryCode = $candidate->mobile_cc ?? optional($candidate->profile)->mobile_cc ?? '+91';
                                        @endphp
                                        @if($mobile)
                                            <div class="mobile-display">
                                                <div class="mobile-primary">{{ $countryCode }} {{ $mobile }}</div>
                                                @if(optional($candidate->profile)->whatsapp_number)
                                                    <div class="whatsapp-info">WhatsApp ✓</div>
                                                @endif
                                            </div>
                                        @else
                                            <span class="no-data">N/A</span>
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $presentRank = optional($candidate->resume)->present_rank ?
                                                optional($candidate->resume->presentRank)->rank ?? optional($candidate->presentRank)->rank
                                                : null;
                                        @endphp
                                        @if($presentRank)
                                            <div class="rank-badge">{{ $presentRank }}</div>
                                        @else
                                            <span class="no-data">N/A</span>
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $appliedRank = optional($candidate->resume)->post_applied_for ?
                                                optional(\App\Models\Rank::find($candidate->resume->post_applied_for))->rank
                                                : null;
                                        @endphp
                                        @if($appliedRank)
                                            <div class="applied-badge">{{ $appliedRank }}</div>
                                        @else
                                            <span class="no-data">N/A</span>
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $lastShip = optional($candidate->seaServiceDetails->first())->ship_name;
                                        @endphp
                                        @if($lastShip)
                                            <div class="ship-name">{{ $lastShip }}</div>
                                        @else
                                            <span class="no-data">No service</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="{{ route('admin.candidates.show', $candidate->id) }}"
                                               class="action-btn action-btn-edit"
                                               data-tooltip="View Candidate">
                                                <i class="bx bx-show"></i>
                                            </a>
                                            <a href="mailto:{{ $candidate->email }}"
                                               class="action-btn action-btn-edit"
                                               data-tooltip="Email Candidate">
                                                <i class="bx bx-envelope"></i>
                                            </a>
                                            <form action="{{ route('admin.candidates.destroy', $candidate->id) }}"
                                                  method="POST"
                                                  style="display:inline;"
                                                  onsubmit="return confirm('Delete this candidate?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="action-btn action-btn-delete"
                                                        data-tooltip="Delete Candidate">
                                                    <i class="bx bx-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr class="empty-row">
                                    <td colspan="9" class="empty-cell">
                                        <div class="empty-state">
                                            <div class="empty-icon">
                                                <i class="bx bx-user"></i>
                                            </div>
                                            <h6 class="empty-title">No Candidates Found</h6>
                                            <p class="empty-message">
                                                @if(request('q'))
                                                    No candidates match your search criteria.
                                                @else
                                                    Get started by registering your first candidate.
                                                @endif
                                            </p>
                                            @if(!request('q'))
                                                <a href="{{ route('admin.candidates.create') }}" class="modern-btn modern-btn-primary">
                                                    <i class="bx bx-plus"></i>
                                                    <span>Register First Candidate</span>
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
                @if($candidates->hasPages())
                    <div class="modern-pagination-wrapper">
                        {{ $candidates->withQueryString()->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</main>
@endsection

@push('styles')
    @stack('styles') {{-- Reuse the same CSS as company index for consistency --}}
@endpush

