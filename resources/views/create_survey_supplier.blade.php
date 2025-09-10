@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add Survey to Supplier</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('survey-supplier.index') }}">List Survey to
                                Supplier</a></li>
                        <li class="breadcrumb-item active">Add Survey to Supplier</li>
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
                            <h3 class="card-title">Survey to Supplier Form</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{ route('survey-supplier.store') }}" method="POST">
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

                                <!-- Type Survey Selection -->
                                <div class="form-group">
                                    <label for="type_survey">Type Survey</label>
                                    <select class="form-control" id="type_survey" name="type_survey" required>
                                        <option value="">Select Type Survey</option>
                                        <option value="Supplier Performance">Supplier Performance</option>
                                        <option value="Quality Assessment">Quality Assessment</option>
                                        <option value="Delivery Performance">Delivery Performance</option>
                                        <option value="Cost Analysis">Cost Analysis</option>
                                        <option value="Technical Capability">Technical Capability</option>
                                        <option value="Environmental Compliance">Environmental Compliance</option>
                                        <option value="General Satisfaction">General Satisfaction</option>
                                    </select>
                                </div>

                                <!-- Due Date -->
                                <div class="form-group">
                                    <label for="due_date">Due Date</label>
                                    <input type="date" class="form-control" id="due_date" name="due_date" required>
                                </div>

                                <!-- Status Selection -->
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="">Select Status</option>
                                        <option value="Pending">Pending</option>
                                        <option value="In Progress">In Progress</option>
                                        <option value="Completed">Completed</option>
                                        <option value="Overdue">Overdue</option>
                                    </select>
                                </div>

                                <!-- Additional Information -->
                                <div class="form-group">
                                    <label for="notes">Notes (Optional)</label>
                                    <textarea class="form-control" id="notes" name="notes" rows="3"
                                        placeholder="Add any additional notes or survey details"></textarea>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Create Survey</button>
                                    <a href="{{ route('survey-supplier.index') }}" class="btn btn-secondary">Cancel</a>
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
