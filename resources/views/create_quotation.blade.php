@extends('layouts.app')

@section('title', 'Add Check Quotation')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add Check Quotation</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('quotation.index') }}">List Quotation</a></li>
                        <li class="breadcrumb-item active">Add Quotation</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Quotation Form</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{ route('quotation.store') }}" method="POST">
                                {{ csrf_field() }}

                                <!-- Supplier Information -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="supplier">Supplier Name</label>
                                            <select class="form-control select2" id="supplier" name="supplier" required
                                                style="width: 100%;">
                                                <option value="">Select Supplier</option>
                                                <option value="PT. ABC Manufacturing">PT. ABC Manufacturing</option>
                                                <option value="CV. XYZ Components">CV. XYZ Components</option>
                                                <option value="PT. Global Parts Ltd">PT. Global Parts Ltd</option>
                                                <option value="PT. Precision Engineering">PT. Precision Engineering
                                                </option>
                                                <option value="CV. Metal Works Indonesia">CV. Metal Works Indonesia
                                                </option>
                                                <option value="PT. Industrial Solutions">PT. Industrial Solutions
                                                </option>
                                                <option value="CV. Tech Components">CV. Tech Components</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="contact_person">Contact Person</label>
                                            <input type="text" class="form-control" id="contact_person"
                                                name="contact_person" required placeholder="Enter contact person name">
                                        </div>
                                    </div>
                                </div>

                                <!-- Part Information -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="part_number">Part Number</label>
                                            <input type="text" class="form-control" id="part_number" name="part_number"
                                                required placeholder="e.g., PN-12345">
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="part_name">Part Name</label>
                                            <input type="text" class="form-control" id="part_name" name="part_name"
                                                required placeholder="Enter part description">
                                        </div>
                                    </div>
                                </div>

                                <!-- Quantity and Pricing -->
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="quantity">Quantity</label>
                                            <input type="number" class="form-control" id="quantity" name="quantity"
                                                required placeholder="0" min="1">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="currency">Currency</label>
                                            <select class="form-control" id="currency" name="currency" required>
                                                <option value="IDR">IDR (Rupiah)</option>
                                                <option value="USD">USD (Dollar)</option>
                                                <option value="EUR">EUR (Euro)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="unit_price">Unit Price</label>
                                            <input type="number" class="form-control" id="unit_price" name="unit_price"
                                                required placeholder="0.00" step="0.01" min="0">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="total_price">Total Price</label>
                                            <input type="text" class="form-control" id="total_price" name="total_price"
                                                readonly placeholder="Auto calculated">
                                        </div>
                                    </div>
                                </div>

                                <!-- Dates -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="quotation_date">Quotation Date</label>
                                            <input type="date" class="form-control" id="quotation_date"
                                                name="quotation_date" required value="{{ date('Y-m-d') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="valid_until">Valid Until</label>
                                            <input type="date" class="form-control" id="valid_until"
                                                name="valid_until" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Terms and Notes -->
                                <div class="form-group">
                                    <label for="terms">Payment Terms</label>
                                    <textarea class="form-control" id="terms" name="terms" rows="2" required
                                        placeholder="e.g., 30 days payment terms, COD, etc."></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="notes">Additional Notes (Optional)</label>
                                    <textarea class="form-control" id="notes" name="notes" rows="3"
                                        placeholder="Any special requirements, conditions, or notes"></textarea>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Create Quotation</button>
                                    <a href="{{ route('quotation.index') }}" class="btn btn-secondary">Cancel</a>
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
    </section>

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

            // Set minimum valid until date to tomorrow
            var tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 1);
            var tomorrowStr = tomorrow.toISOString().split('T')[0];
            $('#valid_until').attr('min', tomorrowStr);

            // Auto calculate total price
            function calculateTotal() {
                var quantity = parseFloat($('#quantity').val()) || 0;
                var unitPrice = parseFloat($('#unit_price').val()) || 0;
                var total = quantity * unitPrice;

                if (total > 0) {
                    var currency = $('#currency').val();
                    if (currency === 'IDR') {
                        $('#total_price').val(currency + ' ' + total.toLocaleString('id-ID'));
                    } else {
                        $('#total_price').val(currency + ' ' + total.toLocaleString('en-US', {
                            minimumFractionDigits: 2
                        }));
                    }
                } else {
                    $('#total_price').val('');
                }
            }

            // Calculate on input change
            $('#quantity, #unit_price, #currency').on('input change', calculateTotal);

            // Format unit price input
            $('#unit_price').on('blur', function() {
                var value = parseFloat($(this).val());
                if (!isNaN(value)) {
                    $(this).val(value.toFixed(2));
                }
            });
        });
    </script>
@endsection
