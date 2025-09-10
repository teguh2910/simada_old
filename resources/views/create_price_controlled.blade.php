@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add Price Controlled</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('price-controlled.index') }}">List Price Controlled</a>
                        </li>
                        <li class="breadcrumb-item active">Add Price Controlled</li>
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
                            <h3 class="card-title">Price Controlled Form</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{ route('price-controlled.store') }}" method="POST">
                                {{ csrf_field() }}

                                <!-- Supplier Selection -->
                                <div class="form-group">
                                    <label for="supplier">Supplier</label>
                                    <select class="form-control select2" id="supplier" name="supplier" required
                                        style="width: 100%;">
                                        <option value="">Select Supplier</option>
                                        <option value="PT. AISIN INDONESIA">PT. AISIN INDONESIA</option>
                                        <option value="PT. AISIN AUTOMOTIVE INDONESIA">PT. AISIN AUTOMOTIVE INDONESIA
                                        </option>
                                        <option value="PT. AISIN WORLD CORP">PT. AISIN WORLD CORP</option>
                                        <option value="PT. AISIN SEIKI INDONESIA">PT. AISIN SEIKI INDONESIA</option>
                                        <option value="PT. AISIN CHEMICAL INDONESIA">PT. AISIN CHEMICAL INDONESIA</option>
                                        <option value="PT. AISIN ELECTRIC INDONESIA">PT. AISIN ELECTRIC INDONESIA</option>
                                        <option value="PT. AISIN PRECISION INDONESIA">PT. AISIN PRECISION INDONESIA</option>
                                    </select>
                                </div>

                                <!-- Periode Selection -->
                                <div class="form-group">
                                    <label for="periode">Periode</label>
                                    <select class="form-control" id="periode" name="periode" required>
                                        <option value="">Select Periode</option>
                                        <option value="2025-01">January 2025</option>
                                        <option value="2025-02">February 2025</option>
                                        <option value="2025-03">March 2025</option>
                                        <option value="2025-04">April 2025</option>
                                        <option value="2025-05">May 2025</option>
                                        <option value="2025-06">June 2025</option>
                                        <option value="2025-07">July 2025</option>
                                        <option value="2025-08">August 2025</option>
                                        <option value="2025-09">September 2025</option>
                                        <option value="2025-10">October 2025</option>
                                        <option value="2025-11">November 2025</option>
                                        <option value="2025-12">December 2025</option>
                                        <option value="2026-01">January 2026</option>
                                        <option value="2026-02">February 2026</option>
                                        <option value="2026-03">March 2026</option>
                                    </select>
                                </div>

                                <!-- Status Selection -->
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="">Select Status</option>
                                        <option value="Wait Quotation">Wait Quotation</option>
                                        <option value="Process Approval">Process Approval</option>
                                        <option value="Approve">Approve</option>
                                    </select>
                                </div>

                                <!-- Additional Information -->
                                <div class="form-group">
                                    <label for="notes">Notes (Optional)</label>
                                    <textarea class="form-control" id="notes" name="notes" rows="3"
                                        placeholder="Add any additional notes or comments"></textarea>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Save Price Control</button>
                                    <a href="{{ route('price-controlled.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
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

@section('js')
    <script>
        $(document).ready(function() {
            // Initialize Select2 for supplier
            $('#supplier').select2({
                theme: 'bootstrap4',
                placeholder: 'Select supplier...',
                allowClear: true,
                width: '100%'
            });
        });
    </script>
@endsection
