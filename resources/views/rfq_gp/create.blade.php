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
                    <h1 class="m-0">Create RFQ GP</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('rfq-gp.index') }}">List RFQ GP</a></li>
                        <li class="breadcrumb-item active">Create RFQ GP</li>
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
                            <h3 class="card-title">Create New RFQ GP</h3>
                        </div>
                        <!-- /.card-header -->
                        <form action="{{ route('rfq-gp.store') }}" method="POST">
                            {{ csrf_field() }}
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
                                            <label for="spec">Spec</label>
                                            <textarea class="form-control @if ($errors->has('spec')) is-invalid @endif" id="spec" name="spec"
                                                rows="3" placeholder="Enter specification details...">{{ old('spec') }}</textarea>
                                            @if ($errors->has('spec'))
                                                <div class="invalid-feedback">{{ $errors->first('spec') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="ex_rate">Ex-Rate</label>
                                            <input type="number"
                                                class="form-control @if ($errors->has('ex_rate')) is-invalid @endif"
                                                id="ex_rate" name="ex_rate" value="{{ old('ex_rate') }}" step="0.0001"
                                                min="0" placeholder="0.0000">
                                            @if ($errors->has('ex_rate'))
                                                <div class="invalid-feedback">{{ $errors->first('ex_rate') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="qty_month">Qty/Month</label>
                                            <input type="number"
                                                class="form-control @if ($errors->has('qty_month')) is-invalid @endif"
                                                id="qty_month" name="qty_month" value="{{ old('qty_month') }}"
                                                min="0" placeholder="Enter quantity per month">
                                            @if ($errors->has('qty_month'))
                                                <div class="invalid-feedback">{{ $errors->first('qty_month') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="satuan">Satuan</label>
                                            <input type="text"
                                                class="form-control @if ($errors->has('satuan')) is-invalid @endif"
                                                id="satuan" name="satuan" value="{{ old('satuan') }}"
                                                placeholder="e.g., kg, pcs, liter" maxlength="50">
                                            @if ($errors->has('satuan'))
                                                <div class="invalid-feedback">{{ $errors->first('satuan') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="id_supplier">Suppliers</label>
                                            <select multiple
                                                class="form-control select2 @if ($errors->has('id_supplier')) is-invalid @endif"
                                                id="id_supplier" name="id_supplier[]" data-placeholder="Select suppliers..."
                                                style="width: 100%;">
                                                @if (count($suppliers) > 0)
                                                    @foreach ($suppliers as $supplier)
                                                        <option value="{{ $supplier->id }}"
                                                            {{ in_array($supplier->id, old('id_supplier', [])) ? 'selected' : '' }}>
                                                            {{ $supplier->name }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    <!-- Test data for debugging -->
                                                    <option value="1">Sample Supplier A</option>
                                                    <option value="2">Sample Supplier B</option>
                                                    <option value="3">Sample Supplier C</option>
                                                @endif
                                            </select>
                                            @if ($errors->has('id_supplier'))
                                                <div class="invalid-feedback">{{ $errors->first('id_supplier') }}</div>
                                            @endif
                                            <small class="form-text text-muted">You can select multiple suppliers by holding
                                                Ctrl (or Cmd on Mac) while clicking.</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Create RFQ GP
                                </button>
                                <a href="{{ route('rfq-gp.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection

@section('js')
    <script>
        // Cache buster: <?php echo time(); ?>
        $(document).ready(function() {
                    // Initialize Select2 for suppliers
                    $('#id_supplier').select2({
                        theme: 'bootstrap4',
                        placeholder: 'Select suppliers...',
                        allowClear: true,
                        width: '100%',
                        closeOnSelect: false
                    });

                    // Custom file input
                    if (typeof bsCustomFileInput !== 'undefined') {
                        bsCustomFileInput.init();
                    }
    </script>
@endsection
