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
                    <h1 class="m-0">Create RFQ APR</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('rfq-apr.index') }}">List RFQ APR</a></li>
                        <li class="breadcrumb-item active">Create RFQ APR</li>
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
                            <h3 class="card-title">Create New RFQ APR</h3>
                        </div>
                        <!-- /.card-header -->
                        <form action="{{ route('rfq-apr.store') }}" method="POST">
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
                                            <label for="spec_rm">Spec RM <span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control @if ($errors->has('spec_rm')) is-invalid @endif"
                                                id="spec_rm" name="spec_rm" value="{{ old('spec_rm') }}" required>
                                            @if ($errors->has('spec_rm'))
                                                <div class="invalid-feedback">{{ $errors->first('spec_rm') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="periode">Periode <span class="text-danger">*</span></label>
                                            <select
                                                class="form-control select2 @if ($errors->has('periode')) is-invalid @endif"
                                                id="periode" name="periode" required data-placeholder="Select Periode..."
                                                style="width: 100%;">
                                                <option value="">Select Periode</option>
                                                @foreach ($periodes as $key => $value)
                                                    <option value="{{ $key }}"
                                                        {{ old('periode') == $key ? 'selected' : '' }}>
                                                        {{ $value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('periode'))
                                                <div class="invalid-feedback">{{ $errors->first('periode') }}</div>
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
                                                id="due_date" name="due_date" value="{{ old('due_date') }}" required>
                                            @if ($errors->has('due_date'))
                                                <div class="invalid-feedback">{{ $errors->first('due_date') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="id_supplier">Supplier <span class="text-danger">*</span></label>
                                            <select multiple
                                                class="form-control select2 @if ($errors->has('id_supplier')) is-invalid @endif"
                                                id="id_supplier" name="id_supplier[]" required
                                                data-placeholder="Select suppliers..." style="width: 100%;">
                                                @if (count($suppliers) > 0)
                                                    @foreach ($suppliers as $supplier)
                                                        <option value="{{ $supplier }}"
                                                            {{ in_array($supplier, old('id_supplier', [])) ? 'selected' : '' }}>
                                                            {{ $supplier }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    <!-- Test data for debugging -->
                                                    <option value="Sample Supplier A">Sample Supplier A</option>
                                                    <option value="Sample Supplier B">Sample Supplier B</option>
                                                    <option value="Sample Supplier C">Sample Supplier C</option>
                                                @endif
                                            </select>
                                            @if ($errors->has('id_supplier'))
                                                <div class="invalid-feedback">{{ $errors->first('id_supplier') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="pic">PIC (Person In Charge) <span
                                                    class="text-danger">*</span></label>
                                            <select
                                                class="form-control select2 @if ($errors->has('pic')) is-invalid @endif"
                                                id="pic" name="pic" required data-placeholder="Select PIC..."
                                                style="width: 100%;">
                                                <option value="">Select PIC</option>
                                                @if (count($pics) > 0)
                                                    @foreach ($pics as $pic)
                                                        <option value="{{ $pic->id }}"
                                                            {{ old('pic') == $pic->id ? 'selected' : '' }}>
                                                            {{ $pic->full_info }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    <!-- Test data for debugging -->
                                                    <option value="1">John Doe - Manager</option>
                                                    <option value="2">Jane Smith - Supervisor</option>
                                                    <option value="3">Bob Johnson - Coordinator</option>
                                                @endif
                                            </select>
                                            @if ($errors->has('pic'))
                                                <div class="invalid-feedback">{{ $errors->first('pic') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="note">Note</label>
                                            <textarea class="form-control @if ($errors->has('note')) is-invalid @endif" id="note" name="note"
                                                rows="3">{{ old('note') }}</textarea>
                                            @if ($errors->has('note'))
                                                <div class="invalid-feedback">{{ $errors->first('note') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Create RFQ APR
                                </button>
                                <a href="{{ route('rfq-apr.index') }}" class="btn btn-secondary">
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
                        closeOnSelect: false,
                        tags: false
                    });

                    // Initialize Select2 for PIC
                    $('#pic').select2({
                        theme: 'bootstrap4',
                        placeholder: 'Select PIC...',
                        allowClear: false,
                        width: '100%'
                    });

                    // Initialize Select2 for periode
                    $('#periode').select2({
                        theme: 'bootstrap4',
                        placeholder: 'Select Periode...',
                        allowClear: false,
                        width: '100%'
                    });

                    // Custom file input
                    if (typeof bsCustomFileInput !== 'undefined') {
                        bsCustomFileInput.init();
                    }
    </script>
@endsection
