@extends('layouts.app')

@section('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit RFQ</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('rfq.index') }}">List RFQ</a></li>
                        <li class="breadcrumb-item active">Edit RFQ</li>
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
                            <h3 class="card-title">Edit RFQ</h3>
                        </div>
                        <!-- /.card-header -->
                        <form action="{{ route('rfq.update', $rfq->id) }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="card-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="customer">Customer <span class="text-danger">*</span></label>
                                            <select
                                                class="form-control select2 @if ($errors->has('customer')) is-invalid @endif"
                                                id="customer" name="customer" required>
                                                <option value="">Select Customer</option>
                                                @foreach ($customers as $customer)
                                                    <option value="{{ $customer }}"
                                                        {{ old('customer', $rfq->customer) == $customer ? 'selected' : '' }}>
                                                        {{ $customer }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('customer'))
                                                <div class="invalid-feedback">{{ $errors->first('customer') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="produk">Product <span class="text-danger">*</span></label>
                                            <select
                                                class="form-control select2 @if ($errors->has('produk')) is-invalid @endif"
                                                id="produk" name="produk" required>
                                                <option value="">Select Product</option>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product }}"
                                                        {{ old('produk', $rfq->produk) == $product ? 'selected' : '' }}>
                                                        {{ $product }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('produk'))
                                                <div class="invalid-feedback">{{ $errors->first('produk') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="part_number">Part Number <span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control @if ($errors->has('part_number')) is-invalid @endif"
                                                id="part_number" name="part_number"
                                                value="{{ old('part_number', $rfq->part_number) }}" required>
                                            @if ($errors->has('part_number'))
                                                <div class="invalid-feedback">{{ $errors->first('part_number') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="part_name">Part Name <span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control @if ($errors->has('part_name')) is-invalid @endif"
                                                id="part_name" name="part_name"
                                                value="{{ old('part_name', $rfq->part_name) }}" required>
                                            @if ($errors->has('part_name'))
                                                <div class="invalid-feedback">{{ $errors->first('part_name') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="std_qty">Standard Quantity <span
                                                    class="text-danger">*</span></label>
                                            <input type="number"
                                                class="form-control @if ($errors->has('std_qty')) is-invalid @endif"
                                                id="std_qty" name="std_qty" value="{{ old('std_qty', $rfq->std_qty) }}"
                                                min="1" required>
                                            @if ($errors->has('std_qty'))
                                                <div class="invalid-feedback">{{ $errors->first('std_qty') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="qty_month">Quantity/Month <span class="text-danger">*</span></label>
                                            <input type="number"
                                                class="form-control @if ($errors->has('qty_month')) is-invalid @endif"
                                                id="qty_month" name="qty_month"
                                                value="{{ old('qty_month', $rfq->qty_month) }}" min="1" required>
                                            @if ($errors->has('qty_month'))
                                                <div class="invalid-feedback">{{ $errors->first('qty_month') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="drawing_time">Drawing Time</label>
                                            <input type="date"
                                                class="form-control @if ($errors->has('drawing_time')) is-invalid @endif"
                                                id="drawing_time" name="drawing_time"
                                                value="{{ old('drawing_time', $rfq->drawing_time ? $rfq->drawing_time->format('Y-m-d') : '') }}">
                                            @if ($errors->has('drawing_time'))
                                                <div class="invalid-feedback">{{ $errors->first('drawing_time') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="OTS_Target">OTS Target</label>
                                            <input type="date"
                                                class="form-control @if ($errors->has('OTS_Target')) is-invalid @endif"
                                                id="OTS_Target" name="OTS_Target"
                                                value="{{ old('OTS_Target', $rfq->OTS_Target ? $rfq->OTS_Target->format('Y-m-d') : '') }}">
                                            @if ($errors->has('OTS_Target'))
                                                <div class="invalid-feedback">{{ $errors->first('OTS_Target') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="OTOP_target">OTOP Target</label>
                                            <input type="date"
                                                class="form-control @if ($errors->has('OTOP_target')) is-invalid @endif"
                                                id="OTOP_target" name="OTOP_target"
                                                value="{{ old('OTOP_target', $rfq->OTOP_target ? $rfq->OTOP_target->format('Y-m-d') : '') }}">
                                            @if ($errors->has('OTOP_target'))
                                                <div class="invalid-feedback">{{ $errors->first('OTOP_target') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="SOP">SOP</label>
                                            <input type="date"
                                                class="form-control @if ($errors->has('SOP')) is-invalid @endif"
                                                id="SOP" name="SOP"
                                                value="{{ old('SOP', $rfq->SOP ? $rfq->SOP->format('Y-m-d') : '') }}">
                                            @if ($errors->has('SOP'))
                                                <div class="invalid-feedback">{{ $errors->first('SOP') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="due_date">Due Date <span class="text-danger">*</span></label>
                                            <input type="date"
                                                class="form-control @if ($errors->has('due_date')) is-invalid @endif"
                                                id="due_date" name="due_date"
                                                value="{{ old('due_date', $rfq->due_date ? $rfq->due_date->format('Y-m-d') : '') }}"
                                                required>
                                            @if ($errors->has('due_date'))
                                                <div class="invalid-feedback">{{ $errors->first('due_date') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="pic">PIC (Person In Charge) <span
                                                    class="text-danger">*</span></label>
                                            <select
                                                class="form-control select2 @if ($errors->has('pic')) is-invalid @endif"
                                                id="pic" name="pic" required>
                                                <option value="">Select PIC</option>
                                                @foreach ($pics as $picOption)
                                                    <option value="{{ $picOption->id }}"
                                                        {{ old('pic', $rfq->pic_id) == $picOption->id ? 'selected' : '' }}>
                                                        {{ $picOption->full_info }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('pic'))
                                                <div class="invalid-feedback">{{ $errors->first('pic') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="id_supplier">Supplier <span class="text-danger">*</span></label>
                                            <select
                                                class="form-control select2 @if ($errors->has('id_supplier')) is-invalid @endif"
                                                id="id_supplier" name="id_supplier[]" multiple required>
                                                @php
                                                    $selectedSuppliers = old('id_supplier', $rfq->id_supplier);
                                                    if (!is_array($selectedSuppliers)) {
                                                        $selectedSuppliers = $selectedSuppliers
                                                            ? [$selectedSuppliers]
                                                            : [];
                                                    }
                                                @endphp
                                                @foreach ($suppliers as $supplier)
                                                    <option value="{{ $supplier }}"
                                                        {{ in_array($supplier, $selectedSuppliers) ? 'selected' : '' }}>
                                                        {{ $supplier }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <small class="text-muted">You can select multiple suppliers by holding Ctrl (or
                                                Cmd on Mac) while clicking</small>
                                            @if ($errors->has('id_supplier'))
                                                <div class="invalid-feedback">{{ $errors->first('id_supplier') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="note">Note</label>
                                            <textarea class="form-control @if ($errors->has('note')) is-invalid @endif" id="note" name="note"
                                                rows="3">{{ old('note', $rfq->note) }}</textarea>
                                            @if ($errors->has('note'))
                                                <div class="invalid-feedback">{{ $errors->first('note') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <h5>File Uploads</h5>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="drawing_file">Drawing File</label>
                                            @if ($rfq->drawing_file)
                                                <div class="mb-2">
                                                    <span class="badge badge-info">Current file:
                                                        {{ basename($rfq->drawing_file) }}</span>
                                                    <a href="{{ Storage::url($rfq->drawing_file) }}" target="_blank"
                                                        class="btn btn-sm btn-outline-info ml-2">View</a>
                                                </div>
                                            @endif
                                            <input type="file"
                                                class="form-control-file @if ($errors->has('drawing_file')) is-invalid @endif"
                                                id="drawing_file" name="drawing_file" accept=".pdf,.jpg,.jpeg,.png,.dwg">
                                            <small class="text-muted">Allowed formats: PDF, JPG, JPEG, PNG, DWG (Max:
                                                10MB)</small>
                                            @if ($errors->has('drawing_file'))
                                                <div class="invalid-feedback">{{ $errors->first('drawing_file') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="excel_term_file">Excel Term File</label>
                                            @if ($rfq->excel_term_file)
                                                <div class="mb-2">
                                                    <span class="badge badge-success">Current file:
                                                        {{ basename($rfq->excel_term_file) }}</span>
                                                    <a href="{{ Storage::url($rfq->excel_term_file) }}" target="_blank"
                                                        class="btn btn-sm btn-outline-success ml-2">View</a>
                                                </div>
                                            @endif
                                            <input type="file"
                                                class="form-control-file @if ($errors->has('excel_term_file')) is-invalid @endif"
                                                id="excel_term_file" name="excel_term_file" accept=".xlsx,.xls,.csv">
                                            <small class="text-muted">Allowed formats: XLSX, XLS, CSV (Max: 10MB)</small>
                                            @if ($errors->has('excel_term_file'))
                                                <div class="invalid-feedback">{{ $errors->first('excel_term_file') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="loading_capacity_file">Loading Capacity File</label>
                                            @if ($rfq->loading_capacity_file)
                                                <div class="mb-2">
                                                    <span class="badge badge-warning">Current file:
                                                        {{ basename($rfq->loading_capacity_file) }}</span>
                                                    <a href="{{ Storage::url($rfq->loading_capacity_file) }}"
                                                        target="_blank"
                                                        class="btn btn-sm btn-outline-warning ml-2">View</a>
                                                </div>
                                            @endif
                                            <input type="file"
                                                class="form-control-file @if ($errors->has('loading_capacity_file')) is-invalid @endif"
                                                id="loading_capacity_file" name="loading_capacity_file"
                                                accept=".pdf,.xlsx,.xls,.doc,.docx">
                                            <small class="text-muted">Allowed formats: PDF, XLSX, XLS, DOC, DOCX (Max:
                                                10MB)</small>
                                            @if ($errors->has('loading_capacity_file'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('loading_capacity_file') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update RFQ</button>
                                <a href="{{ route('rfq.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
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
    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function() {
            // Initialize Select2 for single dropdown fields
            $('.select2:not([multiple])').select2({
                theme: 'bootstrap4',
                placeholder: function() {
                    return $(this).data('placeholder') || 'Select an option';
                },
                allowClear: true
            });

            // Initialize Select2 for multiple dropdown fields
            $('.select2[multiple]').select2({
                theme: 'bootstrap4',
                placeholder: 'Select suppliers',
                allowClear: true,
                closeOnSelect: false
            });
        });
    </script>
@endsection
