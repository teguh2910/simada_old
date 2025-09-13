@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">PIC Details</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('pics.index') }}">PICs</a></li>
                        <li class="breadcrumb-item active">{{ $pic->name }}</li>
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
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">PIC Information</h3>
                            <div class="card-tools">
                                <a href="{{ route('pics.edit', $pic->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="{{ route('pics.index') }}" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-list"></i> Back to List
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <dl class="row">
                                <dt class="col-sm-3">Name:</dt>
                                <dd class="col-sm-9">{{ $pic->name }}</dd>

                                <dt class="col-sm-3">Position:</dt>
                                <dd class="col-sm-9">{{ $pic->position ?? '-' }}</dd>

                                <dt class="col-sm-3">Department:</dt>
                                <dd class="col-sm-9">{{ $pic->department ?? '-' }}</dd>

                                <dt class="col-sm-3">Email:</dt>
                                <dd class="col-sm-9">
                                    @if ($pic->email)
                                        <a href="mailto:{{ $pic->email }}">{{ $pic->email }}</a>
                                    @else
                                        -
                                    @endif
                                </dd>

                                <dt class="col-sm-3">Phone:</dt>
                                <dd class="col-sm-9">{{ $pic->phone ?? '-' }}</dd>

                                <dt class="col-sm-3">Status:</dt>
                                <dd class="col-sm-9">
                                    @if ($pic->is_active)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif
                                </dd>

                                <dt class="col-sm-3">Created:</dt>
                                <dd class="col-sm-9">{{ $pic->created_at->format('d M Y H:i') }}</dd>

                                <dt class="col-sm-3">Last Updated:</dt>
                                <dd class="col-sm-9">{{ $pic->updated_at->format('d M Y H:i') }}</dd>
                            </dl>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">RFQs Assigned ({{ $pic->rfqs->count() }})</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if ($pic->rfqs->count() > 0)
                                <ul class="list-group list-group-flush">
                                    @foreach ($pic->rfqs->take(10) as $rfq)
                                        <li class="list-group-item">
                                            <a href="{{ route('rfq.show', $rfq->id) }}">
                                                {{ $rfq->part_name }} ({{ $rfq->part_number }})
                                            </a>
                                            <small
                                                class="text-muted d-block">{{ $rfq->created_at->format('d M Y') }}</small>
                                        </li>
                                    @endforeach
                                    @if ($pic->rfqs->count() > 10)
                                        <li class="list-group-item text-center">
                                            <small class="text-muted">And {{ $pic->rfqs->count() - 10 }} more...</small>
                                        </li>
                                    @endif
                                </ul>
                            @else
                                <p class="text-muted">No RFQs assigned to this PIC yet.</p>
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
