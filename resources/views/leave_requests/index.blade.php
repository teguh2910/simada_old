@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Leave Requests</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Leave Requests</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">All Leave Requests</h3>
                            <div class="card-tools">
                                <a href="{{ route('leave_requests.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> Request Leave
                                </a>
                                <a href="{{ route('leave_requests.today') }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-calendar-day"></i> Today's Leaves
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if (isset($leaveRequests) && count($leaveRequests) > 0)
                                <table id="leave-requests-table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Employee</th>
                                            <th>Leave Date</th>
                                            <th>Reason</th>
                                            <th>Status</th>
                                            <th>Requested</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($leaveRequests as $leaveRequest)
                                            <tr>
                                                <td>{{ $leaveRequest->user->name }}</td>
                                                <td>{{ $leaveRequest->leave_date->format('M d, Y') }}</td>
                                                <td>{{ \Illuminate\Support\Str::limit($leaveRequest->reason, 50) }}</td>
                                                <td>
                                                    @if ($leaveRequest->status == 'pending')
                                                        <span class="badge badge-warning">Pending</span>
                                                    @elseif ($leaveRequest->status == 'approved')
                                                        <span class="badge badge-success">Approved</span>
                                                    @else
                                                        <span class="badge badge-danger">Rejected</span>
                                                    @endif
                                                </td>
                                                <td>{{ $leaveRequest->created_at->format('M d, Y H:i') }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="{{ route('leave_requests.show', $leaveRequest->id) }}"
                                                            class="btn btn-info btn-sm" title="View">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        @if ($leaveRequest->status == 'pending' && Auth::user()->jabatan == 'manager')
                                                            <form
                                                                action="{{ route('leave_requests.approve', $leaveRequest->id) }}"
                                                                method="POST" style="display: inline;">
                                                                {{ csrf_field() }}
                                                                <button type="submit" class="btn btn-success btn-sm"
                                                                    onclick="return confirm('Are you sure you want to approve this leave request?')"
                                                                    title="Approve">
                                                                    <i class="fas fa-check"></i>
                                                                </button>
                                                            </form>
                                                            <button type="button" class="btn btn-danger btn-sm"
                                                                data-toggle="modal"
                                                                data-target="#rejectModal{{ $leaveRequest->id }}"
                                                                title="Reject">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                        @endif
                                                        @if (Auth::user()->jabatan == 'manager')
                                                            <form
                                                                action="{{ route('leave_requests.destroy', $leaveRequest->id) }}"
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
                                                </td>
                                            </tr>

                                            <!-- Reject Modal -->
                                            @if ($leaveRequest->status == 'pending' && Auth::user()->jabatan == 'manager')
                                                <div class="modal fade" id="rejectModal{{ $leaveRequest->id }}"
                                                    tabindex="-1" role="dialog">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Reject Leave Request</h5>
                                                                <button type="button" class="close" data-dismiss="modal">
                                                                    <span>&times;</span>
                                                                </button>
                                                            </div>
                                                            <form
                                                                action="{{ route('leave_requests.reject', $leaveRequest->id) }}"
                                                                method="POST">
                                                                {{ csrf_field() }}
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label for="approval_notes">Rejection Reason</label>
                                                                        <textarea class="form-control" id="approval_notes" name="approval_notes" rows="3" required></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Cancel</button>
                                                                    <button type="submit" class="btn btn-danger">Reject
                                                                        Request</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $leaveRequests->links() }}
                            @else
                                <div class="text-center py-4">
                                    <p class="text-muted">No leave requests found.</p>
                                    <a href="{{ route('leave_requests.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> Submit First Leave Request
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

@push('scripts')
    <script>
        $(function() {
            $("#leave-requests-table").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#leave-requests-table_wrapper .col-md-6:eq(0)');
        });
    </script>
@endpush
