@extends('layouts.app')


@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard SPTT</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
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
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $outs }}</h3>

                            <p>Outstanding</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <a href="{{ asset('/') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $draft }}</h3>

                            <p>Draft</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-edit"></i>
                        </div>
                        <a href="{{ asset('/draft') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $final }}</h3>

                            <p>Final</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <a href="{{ asset('/final') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $overd }}</h3>

                            <p>OverDueDate</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <a href="{{ asset('/overdue') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- PCR Dashboard Section -->
            <div class="row mt-4">
                <div class="col-12">
                    <h3 class="mb-3">PCR Dashboard</h3>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>{{ $pcrTotal }}</h3>
                            <p>Total PCR</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-list"></i>
                        </div>
                        <a href="{{ asset('/list-pcr') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $pcrFinish }}</h3>
                            <p>Finish</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-check"></i>
                        </div>
                        <a href="{{ asset('/list-pcr') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-secondary">
                        <div class="inner">
                            <h3>{{ $pcrCancel }}</h3>
                            <p>Cancel</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-times"></i>
                        </div>
                        <a href="{{ asset('/list-pcr') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $pcrOnHold }}</h3>
                            <p>On Hold</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-pause"></i>
                        </div>
                        <a href="{{ asset('/list-pending-pcr') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $pcrStage0 }}</h3>
                            <p>Stage 0 Progress</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-play"></i>
                        </div>
                        <a href="{{ asset('/list-pending-pcr') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>{{ $pcrStage1 }}</h3>
                            <p>Stage 1 Progress</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-forward"></i>
                        </div>
                        <a href="{{ asset('/list-pending-pcr') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $pcrStage2 }}</h3>
                            <p>Stage 2 Progress</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-fast-forward"></i>
                        </div>
                        <a href="{{ asset('/list-pending-pcr') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-dark">
                        <div class="inner">
                            <h3>{{ $pcrStage3 }}</h3>
                            <p>Stage 3 Progress</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-step-forward"></i>
                        </div>
                        <a href="{{ asset('/list-pending-pcr') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Leave Monitoring Section -->
            <div class="row mt-4">
                <div class="col-12">
                    <h3 class="mb-3">Leave Monitoring</h3>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $todayLeavesCount ?? 0 }}</h3>
                            <p>On Leave Today</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-calendar-day"></i>
                        </div>
                        <a href="{{ route('leave_requests.today') }}" class="small-box-footer">View Details <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $pendingLeavesCount ?? 0 }}</h3>
                            <p>Pending Approval</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <a href="{{ route('leave_requests.index') }}" class="small-box-footer">Review Now <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $approvedLeavesCount ?? 0 }}</h3>
                            <p>Approved This Month</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-check"></i>
                        </div>
                        <a href="{{ route('leave_requests.index') }}" class="small-box-footer">View All <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>{{ $totalLeavesCount ?? 0 }}</h3>
                            <p>Total Requests</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-list"></i>
                        </div>
                        <a href="{{ route('leave_requests.index') }}" class="small-box-footer">Manage All <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- User Management Section -->
            <div class="row mt-4">
                <div class="col-12">
                    <h3 class="mb-3">User Management</h3>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>{{ $totalUsersCount ?? 0 }}</h3>
                            <p>Total Users</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="{{ route('users.index') }}" class="small-box-footer">Manage Users <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $activeUsersCount ?? 0 }}</h3>
                            <p>Active Users</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <a href="{{ route('users.index') }}" class="small-box-footer">View Active <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $mimUsersCount ?? 0 }}</h3>
                            <p>MIM Department</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <a href="{{ route('users.index') }}" class="small-box-footer">View MIM Users <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $nplUsersCount ?? 0 }}</h3>
                            <p>NPL Department</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-industry"></i>
                        </div>
                        <a href="{{ route('users.index') }}" class="small-box-footer">View NPL Users <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Today's Leave Details -->
            @if (isset($todayLeaves) && count($todayLeaves) > 0)
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">
                                    <i class="fas fa-users"></i> Today's Leave Requests
                                    <small class="text-muted">({{ \Carbon\Carbon::now()->format('l, F d, Y') }})</small>
                                </h5>
                                <div class="card-tools">
                                    <a href="{{ route('leave_requests.today') }}" class="btn btn-sm btn-outline-primary">
                                        View All
                                    </a>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th>Employee</th>
                                                <th>Reason</th>
                                                <th>Status</th>
                                                <th>Approved By</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($todayLeaves->take(5) as $leave)
                                                <tr>
                                                    <td>
                                                        <strong>{{ $leave->user->name }}</strong>
                                                    </td>
                                                    <td>{{ \Illuminate\Support\Str::limit($leave->reason, 50) }}</td>
                                                    <td>
                                                        @if ($leave->status == 'approved')
                                                            <span class="label label-success">Approved</span>
                                                        @elseif($leave->status == 'pending')
                                                            <span class="label label-warning">Pending</span>
                                                        @else
                                                            <span
                                                                class="label label-default">{{ ucfirst($leave->status) }}</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $leave->approver ? $leave->approver->name : 'N/A' }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
