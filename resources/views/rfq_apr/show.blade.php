@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">RFQ APR Details</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('rfq-apr.index') }}">List RFQ APR</a></li>
                        <li class="breadcrumb-item active">RFQ APR #{{ $rfqApr->id }}</li>
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
                            <h3 class="card-title">RFQ APR Information</h3>
                            <div class="card-tools">
                                <a href="{{ route('rfq-apr.edit', $rfqApr->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="{{ route('rfq-apr.index') }}" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-list"></i> Back to List
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td><strong>ID:</strong></td>
                                            <td>{{ $rfqApr->id }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Spec RM:</strong></td>
                                            <td>{{ $rfqApr->spec_rm }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Periode:</strong></td>
                                            <td>{{ $rfqApr->periode }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Due Date:</strong></td>
                                            <td>{{ $rfqApr->due_date ? $rfqApr->due_date->format('Y-m-d') : 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>PIC:</strong></td>
                                            <td>{{ $rfqApr->pic_name }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Supplier:</strong></td>
                                            <td>{{ $rfqApr->suppliers_formatted }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Status:</strong></td>
                                            <td>
                                                <span
                                                    class="badge badge-{{ $rfqApr->status == 'draft' ? 'secondary' : ($rfqApr->status == 'approved' ? 'success' : 'warning') }}">
                                                    {{ ucfirst($rfqApr->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td><strong>Note:</strong></td>
                                            <td>{{ $rfqApr->note ?: 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Created At:</strong></td>
                                            <td>{{ $rfqApr->created_at ? $rfqApr->created_at->format('Y-m-d H:i:s') : 'N/A' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Updated At:</strong></td>
                                            <td>{{ $rfqApr->updated_at ? $rfqApr->updated_at->format('Y-m-d H:i:s') : 'N/A' }}
                                            </td>
                                        </tr>
                                    </table>
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
