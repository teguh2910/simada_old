@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Import Master Data</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Import Master Data</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i> Success!</h5>
                    {{ Session::get('success') }}
                </div>
            @endif

            @if (Session::has('error'))
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                    {{ Session::get('error') }}
                </div>
            @endif

            <div class="row">
                <!-- Customers Import -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Import Customers</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('imports.customers') }}" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="customers_file">Select Excel File</label>
                                    <input type="file" class="form-control" id="customers_file" name="file"
                                        accept=".xlsx,.xls,.csv" required>
                                    <small class="form-text text-muted">Supported formats: .xlsx, .xls, .csv (Max:
                                        2MB)</small>
                                </div>
                                <button type="submit" class="btn btn-primary">Import Customer</button>
                                <a href="{{ route('customers.index') }}" class="btn btn-secondary">View Customer</a>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Products Import -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Import Products</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('imports.products') }}" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="products_file">Select Excel File</label>
                                    <input type="file" class="form-control" id="products_file" name="file"
                                        accept=".xlsx,.xls,.csv" required>
                                    <small class="form-text text-muted">Supported formats: .xlsx, .xls, .csv (Max:
                                        2MB)</small>
                                </div>
                                <button type="submit" class="btn btn-primary">Import Products</button>
                                <a href="{{ route('products.index') }}" class="btn btn-secondary">View Products</a>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Suppliers Import -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Import Suppliers</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('imports.suppliers') }}" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="suppliers_file">Select Excel File</label>
                                    <input type="file" class="form-control" id="suppliers_file" name="file"
                                        accept=".xlsx,.xls,.csv" required>
                                    <small class="form-text text-muted">Supported formats: .xlsx, .xls, .csv (Max:
                                        2MB)</small>
                                </div>
                                <button type="submit" class="btn btn-primary">Import Suppliers</button>
                                <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">View Suppliers</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Instructions Card -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Import Instructions</h3>
                        </div>
                        <div class="card-body">
                            <h5>Excel File Format Requirements:</h5>
                            <ul>
                                <li>The first row should contain column headers</li>
                                <li>Supported formats: .xlsx, .xls, .csv</li>
                                <li>Maximum file size: 2MB</li>
                                <li>All required fields must be present in the Excel file</li>
                                <li><strong>Download sample templates below to see the correct format</strong></li>
                            </ul>

                            <h5>Sample Templates:</h5>
                            <div class="row">
                                <div class="col-md-12">
                                    <p><a href="{{ asset('templates/customers_template.csv') }}"
                                            class="btn btn-sm btn-outline-primary" download><i class="fas fa-download"></i>
                                            Customers Template</a>
                                        <a href="{{ asset('templates/products_template.csv') }}"
                                            class="btn btn-sm btn-outline-primary" download><i class="fas fa-download"></i>
                                            Products Template</a>
                                        <a href="{{ asset('templates/suppliers_template.csv') }}"
                                            class="btn btn-sm btn-outline-primary" download><i
                                                class="fas fa-download"></i> Suppliers Template</a>
                                    </p>
                                </div>
                            </div>

                            <h5>Column Headers for Each Master Data:</h5>
                            <div class="row">
                                <div class="col-md-12">
                                    <h6>Customers:</h6>
                                    <code>name, is_active (optional)</code>

                                    <h6>Products:</h6>
                                    <code>name, is_active (optional)</code>

                                    <h6>Suppliers:</h6>
                                    <code>name, customer (optional), customer_id (optional), pic (optional), no_hp
                                        (optional), email (optional), presdir (optional), alamat (optional), no_telp
                                        (optional), is_active (optional)</code>
                                    <br><small class="text-muted">Note: Use either 'customer' (customer name) or
                                        'customer_id' (customer ID) to assign suppliers to customers. Leave both empty for
                                        suppliers without customer assignment.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
