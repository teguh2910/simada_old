@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Today's Leave Requests</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('leave_requests.index') }}">Leave Requests</a></li>
                        <li class="breadcrumb-item active">Today's Leave Requests</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-calendar-day"></i> Today's Leave Requests
                                <small class="text-muted">({{ \Carbon\Carbon::now()->format('l, F d, Y') }})</small>
                            </h3>
                            <div class="card-tools">
                                <a href="{{ route('leave_requests.index') }}" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-arrow-left"></i> All Requests
                                </a>
                                <a href="{{ route('leave_requests.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> Request Leave
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if (isset($todayLeaves) && count($todayLeaves) > 0)
                                <div class="row">
                                    @foreach ($todayLeaves as $leave)
                                        <div class="col-md-6 col-lg-4">
                                            <div
                                                class="card card-outline @if ($leave->status == 'approved') card-success @else card-warning @endif">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center">
                                                        <div class="mr-3">
                                                            <i
                                                                class="fas fa-user-circle fa-3x @if ($leave->status == 'approved') text-success @else text-warning @endif"></i>
                                                        </div>
                                                        <div>
                                                            <h5 class="card-title mb-1">{{ $leave->user->name }}</h5>
                                                            <p class="card-text text-muted mb-1">
                                                                <i class="fas fa-calendar"></i>
                                                                {{ $leave->leave_date->format('M d, Y') }}
                                                            </p>
                                                            <p class="card-text small text-truncate"
                                                                style="max-width: 200px;">
                                                                {{ \Illuminate\Support\Str::limit($leave->reason, 60) }}
                                                            </p>
                                                            <p class="mb-0">
                                                                @if ($leave->status == 'approved')
                                                                    <span class="badge badge-success">Approved</span>
                                                                @elseif($leave->status == 'pending')
                                                                    <span class="badge badge-warning">Pending</span>
                                                                @else
                                                                    <span
                                                                        class="badge badge-secondary">{{ ucfirst($leave->status) }}</span>
                                                                @endif
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer p-2">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <small class="text-muted">
                                                            @if ($leave->status == 'approved')
                                                                <i class="fas fa-check"></i> Approved
                                                                {{ $leave->approved_at->diffForHumans() }}
                                                                @if ($leave->approver)
                                                                    by {{ $leave->approver->name }}
                                                                @endif
                                                            @else
                                                                <i class="fas fa-clock"></i> Submitted
                                                                {{ $leave->created_at->diffForHumans() }}
                                                            @endif
                                                        </small>
                                                        @if (Auth::user()->jabatan == 'manager')
                                                            <form
                                                                action="{{ route('leave_requests.destroy', $leave->id) }}"
                                                                method="POST" style="display: inline;">
                                                                {{ csrf_field() }}
                                                                {{ method_field('DELETE') }}
                                                                <button type="submit" class="btn btn-danger btn-sm"
                                                                    onclick="return confirm('Are you sure you want to delete this leave request? This action cannot be undone.')"
                                                                    title="Delete">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="mt-4">
                                    <div class="alert alert-info">
                                        <h5><i class="icon fas fa-info"></i> Summary</h5>
                                        <p class="mb-0">Total leave requests for today:
                                            <strong>{{ count($todayLeaves) }}</strong>
                                            @php
                                                $approvedCount = $todayLeaves->where('status', 'approved')->count();
                                                $pendingCount = $todayLeaves->where('status', 'pending')->count();
                                            @endphp
                                            @if ($approvedCount > 0)
                                                <span class="badge badge-success">{{ $approvedCount }} Approved</span>
                                            @endif
                                            @if ($pendingCount > 0)
                                                <span class="badge badge-warning">{{ $pendingCount }} Pending</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            @else
                                <div class="text-center py-5">
                                    <i class="fas fa-calendar-check fa-4x text-success mb-3"></i>
                                    <h4 class="text-success">No Leave Requests Today</h4>
                                    <p class="text-muted">No leave requests have been submitted for today.</p>
                                    <a href="{{ route('leave_requests.index') }}" class="btn btn-primary">
                                        <i class="fas fa-list"></i> View All Leave Requests
                                    </a>
                                </div>
                            @endif
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
