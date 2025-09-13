@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Survey to Supplier</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('survey-supplier.index') }}">List Survey to
                                Supplier</a></li>
                        <li class="breadcrumb-item active">Edit Survey to Supplier</li>
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
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ route('survey-supplier.update', $surveySupplier->id) }}" method="POST"
                                enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="PUT">

                                <!-- Link Form -->
                                <div class="form-group">
                                    <label for="link_form">Link Form</label>
                                    <input type="url"
                                        class="form-control @if ($errors->has('link_form')) is-invalid @endif"
                                        id="link_form" name="link_form"
                                        value="{{ old('link_form', $surveySupplier->link_form) }}" required
                                        placeholder="https://example.com/survey">
                                    @if ($errors->has('link_form'))
                                        <div class="invalid-feedback">{{ $errors->first('link_form') }}</div>
                                    @endif
                                </div>

                                <!-- File Upload -->
                                <div class="form-group">
                                    <label for="file">File (Optional)</label>
                                    <input type="file" class="form-control" id="file" name="file"
                                        accept=".pdf,.doc,.docx">
                                    <small class="form-text text-muted">Allowed formats: PDF, DOC, DOCX</small>
                                    @if ($surveySupplier->file)
                                        <small class="form-text text-muted">Current file: <a
                                                href="{{ Storage::url($surveySupplier->file) }}"
                                                target="_blank">Download</a></small>
                                    @endif
                                </div>

                                <!-- Supplier Selection -->
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="all_suppliers"
                                            name="all_suppliers" value="1"
                                            {{ $surveySupplier->id_supplier == null ? 'checked' : '' }}>
                                        <label class="form-check-label" for="all_suppliers">
                                            All Suppliers
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group" id="supplier_selection_group">
                                    <label for="id_supplier">Supplier</label>
                                    <select class="form-control select2 @if ($errors->has('id_supplier')) is-invalid @endif"
                                        id="id_supplier" name="id_supplier" style="width: 100%;">
                                        <option value="">Select Supplier</option>
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}"
                                                {{ old('id_supplier', $surveySupplier->id_supplier) == $supplier->id ? 'selected' : '' }}>
                                                {{ $supplier->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('id_supplier'))
                                        <div class="invalid-feedback">{{ $errors->first('id_supplier') }}</div>
                                    @endif
                                </div>

                                <!-- Due Date -->
                                <div class="form-group">
                                    <label for="due_date">Due Date</label>
                                    <input type="date"
                                        class="form-control @if ($errors->has('due_date')) is-invalid @endif"
                                        id="due_date" name="due_date"
                                        value="{{ old('due_date', $surveySupplier->due_date) }}" required>
                                    @if ($errors->has('due_date'))
                                        <div class="invalid-feedback">{{ $errors->first('due_date') }}</div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Update Survey</button>
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
            $('#id_supplier').select2({
                theme: 'bootstrap4',
                placeholder: 'Select supplier...',
                allowClear: true,
                width: '100%'
            });

            // Handle All Suppliers checkbox
            $('#all_suppliers').change(function() {
                if ($(this).is(':checked')) {
                    $('#supplier_selection_group').hide();
                    $('#id_supplier').prop('required', false);
                    $('#id_supplier').val('').trigger('change');
                } else {
                    $('#supplier_selection_group').show();
                    $('#id_supplier').prop('required', true);
                }
            });

            // Initially hide supplier selection if all suppliers is checked
            if ($('#all_suppliers').is(':checked')) {
                $('#supplier_selection_group').hide();
                $('#id_supplier').prop('required', false);
            }
        });
    </script>
@endsection
