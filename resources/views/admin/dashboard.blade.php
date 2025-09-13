@extends('layouts.admin.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">Welcome, {{ Auth::user()->username ?? 'Admin' }}</h1>

            {{-- Status message (flash) --}}
            @if(session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            {{-- Quick actions / navigation --}}
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body text-center">
                            <i class="fa fa-users fa-2x text-primary mb-3"></i>
                            <h5 class="card-title">Manage Users</h5>
                            <p class="card-text text-muted">View and manage candidates, companies, and admins.</p>
                            <a href="#" class="btn btn-outline-primary btn-sm">Go</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body text-center">
                            <i class="fa fa-briefcase fa-2x text-success mb-3"></i>
                            <h5 class="card-title">Manage Jobs</h5>
                            <p class="card-text text-muted">Approve, edit, or delete job postings.</p>
                            <a href="#" class="btn btn-outline-success btn-sm">Go</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body text-center">
                            <i class="fa fa-cog fa-2x text-warning mb-3"></i>
                            <h5 class="card-title">Settings</h5>
                            <p class="card-text text-muted">Configure system preferences and roles.</p>
                            <a href="#" class="btn btn-outline-warning btn-sm">Go</a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Logout --}}
            <div class="mt-5">
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger">
                        <i class="fa fa-sign-out-alt me-2"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
