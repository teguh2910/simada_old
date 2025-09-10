@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create RFQ</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('rfq.index') }}">List RFQ</a></li>
                        <li class="breadcrumb-item active">Create RFQ</li>
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
                            <h3 class="card-title">RFQ Form</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{ route('rfq.store') }}" method="POST">
                                {{ csrf_field() }}

                                <!-- RFQ Basic Information -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="rfq_number">RFQ Number</label>
                                            <input type="text" class="form-control" id="rfq_number" name="rfq_number"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="rfq_date">RFQ Date</label>
                                            <input type="date" class="form-control" id="rfq_date" name="rfq_date"
                                                required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="project">Project</label>
                                            <input type="text" class="form-control" id="project" name="project"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="department">Department</label>
                                            <input type="text" class="form-control" id="department" name="department"
                                                required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="part_name">Part Name</label>
                                            <input type="text" class="form-control" id="part_name" name="part_name"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="part_number">Part Number</label>
                                            <input type="text" class="form-control" id="part_number" name="part_number"
                                                required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="quantity">Quantity</label>
                                            <input type="number" class="form-control" id="quantity" name="quantity"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="unit">Unit</label>
                                            <select class="form-control" id="unit" name="unit" required>
                                                <option value="">Select Unit</option>
                                                <option value="pcs">Pieces (pcs)</option>
                                                <option value="kg">Kilogram (kg)</option>
                                                <option value="m">Meter (m)</option>
                                                <option value="l">Liter (l)</option>
                                                <option value="set">Set</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                                </div>

                                <!-- Supplier Selection -->
                                <div class="form-group">
                                    <label for="suppliers">Supplier Selection (Select multiple suppliers)</label>
                                    <select class="form-control select2" id="suppliers" name="suppliers[]"
                                        multiple="multiple" required style="width: 100%;">
                                        <option value="PT. AISIN INDONESIA">PT. AISIN INDONESIA</option>
                                        <option value="PT. AISIN AUTOMOTIVE INDONESIA">PT. AISIN AUTOMOTIVE INDONESIA
                                        </option>
                                        <option value="PT. AISIN WORLD CORP">PT. AISIN WORLD CORP</option>
                                        <option value="PT. AISIN SEIKI INDONESIA">PT. AISIN SEIKI INDONESIA</option>
                                        <option value="PT. AISIN CHEMICAL INDONESIA">PT. AISIN CHEMICAL INDONESIA</option>
                                    </select>
                                    <small class="form-text text-muted">You can select multiple suppliers. Start typing to
                                        search.</small>
                                </div>

                                <!-- Custom Supplier Input -->
                                <div class="form-group">
                                    <label for="custom_suppliers">Or Add Custom Suppliers (Optional)</label>
                                    <textarea class="form-control" id="custom_suppliers" name="custom_suppliers" rows="2"
                                        placeholder="Enter custom supplier names, one per line"></textarea>
                                    <small class="form-text text-muted">Add any additional suppliers not in the list above.
                                        Enter one supplier per line.</small>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Create RFQ</button>
                                    <a href="{{ route('rfq.index') }}" class="btn btn-secondary">Cancel</a>
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
            // Initialize Select2 for suppliers
            $('#suppliers').select2({
                theme: 'bootstrap4',
                placeholder: 'Select suppliers...',
                allowClear: true,
                width: '100%'
            });

            // Custom validation for suppliers
            $('#suppliers').on('change', function() {
                var selectedSuppliers = $(this).val();
                var customSuppliers = $('#custom_suppliers').val().trim();

                if ((!selectedSuppliers || selectedSuppliers.length === 0) && !customSuppliers) {
                    $(this)[0].setCustomValidity(
                        'Please select at least one supplier or add custom suppliers.');
                } else {
                    $(this)[0].setCustomValidity('');
                }
            });

            // Also validate on custom suppliers change
            $('#custom_suppliers').on('input', function() {
                $('#suppliers').trigger('change');
            });
        });
    </script>
@endsection
