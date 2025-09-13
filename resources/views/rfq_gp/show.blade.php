@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">RFQ GP Details</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('rfq-gp.index') }}">List RFQ GP</a></li>
                        <li class="breadcrumb-item active">RFQ GP Details</li>
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
                            <h3 class="card-title">RFQ GP #{{ $rfqGp->id }}</h3>
                            <div class="card-tools">
                                <a href="{{ route('rfq-gp.edit', $rfqGp->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="{{ route('rfq-gp.index') }}" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-arrow-left"></i> Back to List
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>ID:</strong></label>
                                        <p class="form-control-plaintext">{{ $rfqGp->id }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>Created At:</strong></label>
                                        <p class="form-control-plaintext">
                                            {{ $rfqGp->created_at ? $rfqGp->created_at->format('Y-m-d H:i:s') : '-' }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>Updated At:</strong></label>
                                        <p class="form-control-plaintext">
                                            {{ $rfqGp->updated_at ? $rfqGp->updated_at->format('Y-m-d H:i:s') : '-' }}</p>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>Spec:</strong></label>
                                        <p class="form-control-plaintext">{{ $rfqGp->spec ?: '-' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>Ex-Rate:</strong></label>
                                        <p class="form-control-plaintext">
                                            {{ $rfqGp->ex_rate ? number_format($rfqGp->ex_rate, 4) : '-' }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>Qty/Month:</strong></label>
                                        <p class="form-control-plaintext">
                                            {{ $rfqGp->qty_month ? number_format($rfqGp->qty_month) : '-' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>Satuan:</strong></label>
                                        <p class="form-control-plaintext">{{ $rfqGp->satuan ?: '-' }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>Supplier:</strong></label>
                                        <p class="form-control-plaintext">
                                            {{ $rfqGp->suppliers_formatted }}</p>
                                    </div>
                                </div>
                            </div>
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
