@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Customer Details</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('customers.index') }}">List Customers</a></li>
                        <li class="breadcrumb-item active">Customer Details</li>
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
                            <h3 class="card-title">Customer Information</h3>
                            <div class="card-tools">
                                <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="{{ route('customers.index') }}" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-list"></i> Back to List
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <dl class="row">
                                <dt class="col-sm-3">Name:</dt>
                                <dd class="col-sm-9">{{ $customer->name }}</dd>

                                <dt class="col-sm-3">Code:</dt>
                                <dd class="col-sm-9">{{ $customer->code }}</dd>

                                <dt class="col-sm-3">Email:</dt>
                                <dd class="col-sm-9">{{ $customer->email ?? '-' }}</dd>

                                <dt class="col-sm-3">Phone:</dt>
                                <dd class="col-sm-9">{{ $customer->phone ?? '-' }}</dd>

                                <dt class="col-sm-3">Contact Person:</dt>
                                <dd class="col-sm-9">{{ $customer->contact_person ?? '-' }}</dd>

                                <dt class="col-sm-3">Address:</dt>
                                <dd class="col-sm-9">{{ $customer->address ?? '-' }}</dd>

                                <dt class="col-sm-3">Status:</dt>
                                <dd class="col-sm-9">
                                    @if ($customer->is_active)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif
                                </dd>

                                <dt class="col-sm-3">Created At:</dt>
                                <dd class="col-sm-9">{{ $customer->created_at->format('Y-m-d H:i:s') }}</dd>

                                <dt class="col-sm-3">Updated At:</dt>
                                <dd class="col-sm-9">{{ $customer->updated_at->format('Y-m-d H:i:s') }}</dd>
                            </dl>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Related RFQs</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if ($customer->rfqs->count() > 0)
                                <div class="list-group">
                                    @foreach ($customer->rfqs->take(5) as $rfq)
                                        <a href="{{ route('rfq.show', $rfq->id) }}"
                                            class="list-group-item list-group-item-action">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h6 class="mb-1">{{ $rfq->part_name ?? 'RFQ #' . $rfq->id }}</h6>
                                                <small>{{ $rfq->created_at->format('M d, Y') }}</small>
                                            </div>
                                            <p class="mb-1">{{ $rfq->part_number ?? '-' }}</p>
                                        </a>
                                    @endforeach
                                </div>
                                @if ($customer->rfqs->count() > 5)
                                    <div class="text-center mt-2">
                                        <a href="{{ route('rfq.index') }}?customer={{ $customer->name }}"
                                            class="btn btn-sm btn-outline-primary">
                                            View All RFQs ({{ $customer->rfqs->count() }})
                                        </a>
                                    </div>
                                @endif
                            @else
                                <p class="text-muted">No RFQs found for this customer.</p>
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
