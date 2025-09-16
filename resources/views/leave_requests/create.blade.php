@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Request Leave</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('leave_requests.index') }}">Leave Requests</a></li>
                        <li class="breadcrumb-item active">Request Leave</li>
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
                            <h3 class="card-title">Submit Leave Request</h3>
                        </div>
                        <!-- /.card-header -->
                        <form action="{{ route('leave_requests.store') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="card-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="form-group">
                                    <label for="leave_date">Leave Date <span class="text-danger">*</span></label>
                                    <input type="date"
                                        class="form-control @if ($errors->has('leave_date')) is-invalid @endif"
                                        id="leave_date" name="leave_date" value="{{ old('leave_date') }}"
                                        min="{{ date('Y-m-d') }}" required>
                                    @if ($errors->has('leave_date'))
                                        <div class="invalid-feedback">{{ $errors->first('leave_date') }}</div>
                                    @endif
                                    <small class="form-text text-muted">Select the date you want to take leave</small>
                                </div>

                                <div class="form-group">
                                    <label for="reason">Reason for Leave <span class="text-danger">*</span></label>
                                    <textarea class="form-control @if ($errors->has('reason')) is-invalid @endif" id="reason" name="reason"
                                        rows="4" placeholder="Please provide a detailed reason for your leave request..." required>{{ old('reason') }}</textarea>
                                    @if ($errors->has('reason'))
                                        <div class="invalid-feedback">{{ $errors->first('reason') }}</div>
                                    @endif
                                    <small class="form-text text-muted">Maximum 1000 characters</small>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit Request</button>
                                <a href="{{ route('leave_requests.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
