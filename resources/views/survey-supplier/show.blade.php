@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">View Survey to Supplier</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('survey-supplier.index') }}">List Survey to
                                Supplier</a></li>
                        <li class="breadcrumb-item active">View Survey to Supplier</li>
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
                            <h3 class="card-title">Survey to Supplier Details</h3>
                            <div class="card-tools">
                                <a href="{{ route('survey-supplier.edit', $surveySupplier->id) }}"
                                    class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="{{ route('survey-supplier.index') }}" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-arrow-left"></i> Back
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Link Form</th>
                                    <td><a href="{{ $surveySupplier->link_form }}"
                                            target="_blank">{{ $surveySupplier->link_form }}</a></td>
                                </tr>
                                <tr>
                                    <th>File</th>
                                    <td>
                                        @if ($surveySupplier->file)
                                            <a href="{{ Storage::url($surveySupplier->file) }}" target="_blank"
                                                class="btn btn-sm btn-primary">Download File</a>
                                        @else
                                            No file uploaded
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Supplier</th>
                                    <td>
                                        @if ($surveySupplier->id_supplier)
                                            {{ $surveySupplier->supplier->name ?? 'N/A' }}
                                        @else
                                            <span class="badge badge-info">All Suppliers</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Due Date</th>
                                    <td>{{ $surveySupplier->due_date }}</td>
                                </tr>
                                <tr>
                                    <th>Created At</th>
                                    <td>{{ $surveySupplier->created_at->format('Y-m-d H:i:s') }}</td>
                                </tr>
                                <tr>
                                    <th>Updated At</th>
                                    <td>{{ $surveySupplier->updated_at->format('Y-m-d H:i:s') }}</td>
                                </tr>
                            </table>
                        </div>
                        <!-- /.card-body -->
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
