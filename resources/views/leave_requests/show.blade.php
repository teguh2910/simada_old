@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Leave Request Details</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('leave_requests.index') }}">Leave Requests</a></li>
                        <li class="breadcrumb-item active">Details</li>
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
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Leave Request Information</h3>
                            <div class="card-tools">
                                <a href="{{ route('leave_requests.index') }}" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-arrow-left"></i> Back to List
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Employee Name:</label>
                                        <p class="form-control-plaintext">{{ $leaveRequest->user->name }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Leave Date:</label>
                                        <p class="form-control-plaintext">
                                            {{ $leaveRequest->leave_date->format('l, F d, Y') }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status:</label>
                                        <p class="form-control-plaintext">
                                            @if ($leaveRequest->status == 'pending')
                                                <span class="badge badge-warning badge-lg">Pending Approval</span>
                                            @elseif ($leaveRequest->status == 'approved')
                                                <span class="badge badge-success badge-lg">Approved</span>
                                            @else
                                                <span class="badge badge-danger badge-lg">Rejected</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Requested Date:</label>
                                        <p class="form-control-plaintext">
                                            {{ $leaveRequest->created_at->format('M d, Y H:i') }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Reason for Leave:</label>
                                        <div class="card">
                                            <div class="card-body">
                                                {{ $leaveRequest->reason }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if ($leaveRequest->status != 'pending')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Approved/Rejected By:</label>
                                            <p class="form-control-plaintext">
                                                {{ $leaveRequest->approver ? $leaveRequest->approver->name : 'N/A' }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Decision Date:</label>
                                            <p class="form-control-plaintext">
                                                {{ $leaveRequest->approved_at ? $leaveRequest->approved_at->format('M d, Y H:i') : 'N/A' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                @if ($leaveRequest->status == 'rejected' && $leaveRequest->approval_notes)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Rejection Reason:</label>
                                                <div class="card border-danger">
                                                    <div class="card-body text-danger">
                                                        {{ $leaveRequest->approval_notes }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        </div>
                        <!-- /.card-body -->

                        @if ($leaveRequest->status == 'pending' && Auth::user()->jabatan == 'manager')
                            <div class="card-footer">
                                <form action="{{ route('leave_requests.approve', $leaveRequest->id) }}" method="POST"
                                    style="display: inline;">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-success"
                                        onclick="return confirm('Are you sure you want to approve this leave request?')">
                                        <i class="fas fa-check"></i> Approve Request
                                    </button>
                                </form>

                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                    data-target="#rejectModal">
                                    <i class="fas fa-times"></i> Reject Request
                                </button>

                                <form action="{{ route('leave_requests.destroy', $leaveRequest->id) }}" method="POST"
                                    style="display: inline;">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this leave request? This action cannot be undone.')"
                                        style="margin-left: 10px;">
                                        <i class="fas fa-trash"></i> Delete Request
                                    </button>
                                </form>
                            </div>
                        @elseif (Auth::user()->jabatan == 'manager')
                            <div class="card-footer">
                                <form action="{{ route('leave_requests.destroy', $leaveRequest->id) }}" method="POST"
                                    style="display: inline;">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this leave request? This action cannot be undone.')">
                                        <i class="fas fa-trash"></i> Delete Request
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                    <!-- /.card -->

                    <!-- Reject Modal -->
                    @if ($leaveRequest->status == 'pending' && Auth::user()->jabatan == 'manager')
                        <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Reject Leave Request</h5>
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span>&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('leave_requests.reject', $leaveRequest->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="approval_notes">Rejection Reason <span
                                                        class="text-danger">*</span></label>
                                                <textarea class="form-control" id="approval_notes" name="approval_notes" rows="3" required
                                                    placeholder="Please provide a reason for rejection..."></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-danger">Reject Request</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
