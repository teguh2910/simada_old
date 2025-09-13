@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">RFQ Details</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('rfq.index') }}">List RFQ</a></li>
                        <li class="breadcrumb-item active">RFQ Details</li>
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
                            <h3 class="card-title">RFQ Information</h3>
                            <div class="card-tools">
                                <a href="{{ route('rfq.edit', $rfq->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="{{ route('rfq.index') }}" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-arrow-left"></i> Back to List
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <!-- Basic Information -->
                                <div class="col-md-6">
                                    <h5 class="border-bottom pb-2">Basic Information</h5>
                                    <table class="table table-borderless">
                                        <tr>
                                            <td><strong>Customer:</strong></td>
                                            <td>{{ $rfq->customer }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Product:</strong></td>
                                            <td>{{ $rfq->produk }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Part Number:</strong></td>
                                            <td>{{ $rfq->part_number }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Part Name:</strong></td>
                                            <td>{{ $rfq->part_name }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Standard Quantity:</strong></td>
                                            <td>{{ number_format($rfq->std_qty) }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Quantity/Month:</strong></td>
                                            <td>{{ number_format($rfq->qty_month) }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>PIC:</strong></td>
                                            <td>{{ $rfq->pic_name }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Supplier:</strong></td>
                                            <td>{{ $rfq->suppliers_formatted }}</td>
                                        </tr>
                                    </table>
                                </div>

                                <!-- Timeline Information -->
                                <div class="col-md-6">
                                    <h5 class="border-bottom pb-2">Timeline Information</h5>
                                    <table class="table table-borderless">
                                        <tr>
                                            <td><strong>Drawing Time:</strong></td>
                                            <td>{{ $rfq->drawing_time ? $rfq->drawing_time->format('Y-m-d') : '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>OTS Target:</strong></td>
                                            <td>{{ $rfq->OTS_Target ? $rfq->OTS_Target->format('Y-m-d') : '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>OTOP Target:</strong></td>
                                            <td>{{ $rfq->OTOP_target ? $rfq->OTOP_target->format('Y-m-d') : '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>SOP:</strong></td>
                                            <td>{{ $rfq->SOP ? $rfq->SOP->format('Y-m-d') : '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Due Date:</strong></td>
                                            <td>
                                                <span
                                                    class="badge badge-{{ $rfq->due_date && $rfq->due_date->isPast() ? 'danger' : 'success' }}">
                                                    {{ $rfq->due_date ? $rfq->due_date->format('Y-m-d') : '-' }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Created At:</strong></td>
                                            <td>{{ $rfq->created_at->format('Y-m-d H:i:s') }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Updated At:</strong></td>
                                            <td>{{ $rfq->updated_at->format('Y-m-d H:i:s') }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <!-- Note Section -->
                            @if ($rfq->note)
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <h5 class="border-bottom pb-2">Note</h5>
                                        <div class="alert alert-light">
                                            {{ $rfq->note }}
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Files Section -->
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h5 class="border-bottom pb-2">Attached Files</h5>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h6 class="card-title mb-0">
                                                        <i class="fas fa-file-image text-info"></i> Drawing File
                                                    </h6>
                                                </div>
                                                <div class="card-body text-center">
                                                    @if ($rfq->drawing_file)
                                                        <p class="mb-2">{{ basename($rfq->drawing_file) }}</p>
                                                        <a href="{{ Storage::url($rfq->drawing_file) }}" target="_blank"
                                                            class="btn btn-info btn-sm">
                                                            <i class="fas fa-eye"></i> View File
                                                        </a>
                                                    @else
                                                        <p class="text-muted">No file uploaded</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h6 class="card-title mb-0">
                                                        <i class="fas fa-file-excel text-success"></i> Excel Term File
                                                    </h6>
                                                </div>
                                                <div class="card-body text-center">
                                                    @if ($rfq->excel_term_file)
                                                        <p class="mb-2">{{ basename($rfq->excel_term_file) }}</p>
                                                        <a href="{{ Storage::url($rfq->excel_term_file) }}" target="_blank"
                                                            class="btn btn-success btn-sm">
                                                            <i class="fas fa-eye"></i> View File
                                                        </a>
                                                    @else
                                                        <p class="text-muted">No file uploaded</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h6 class="card-title mb-0">
                                                        <i class="fas fa-file-alt text-warning"></i> Loading Capacity File
                                                    </h6>
                                                </div>
                                                <div class="card-body text-center">
                                                    @if ($rfq->loading_capacity_file)
                                                        <p class="mb-2">{{ basename($rfq->loading_capacity_file) }}</p>
                                                        <a href="{{ Storage::url($rfq->loading_capacity_file) }}"
                                                            target="_blank" class="btn btn-warning btn-sm">
                                                            <i class="fas fa-eye"></i> View File
                                                        </a>
                                                    @else
                                                        <p class="text-muted">No file uploaded</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="{{ route('rfq.edit', $rfq->id) }}" class="btn btn-warning">
                                        <i class="fas fa-edit"></i> Edit RFQ
                                    </a>
                                </div>
                                <div class="col-md-6 text-right">
                                    <form action="{{ route('rfq.destroy', $rfq->id) }}" method="POST"
                                        style="display: inline;"
                                        onsubmit="return confirm('Are you sure you want to delete this RFQ?')">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-trash"></i> Delete RFQ
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
