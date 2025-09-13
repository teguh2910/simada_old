@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">List Products</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">List Products</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Product Data</h3>
                            <div class="card-tools">
                                <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> Create Product
                                </a>
                                <a href="{{ route('imports.index') }}" class="btn btn-success btn-sm">
                                    <i class="fas fa-upload"></i> Import Excel
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if (isset($products) && count($products) > 0)
                                <table id="list-products-table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr>
                                                <td>{{ $product->name }}</td>
                                                <td>
                                                    @if ($product->is_active)
                                                        <span class="badge badge-success">Active</span>
                                                    @else
                                                        <span class="badge badge-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="{{ route('products.show', $product->id) }}"
                                                            class="btn btn-info btn-sm">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('products.edit', $product->id) }}"
                                                            class="btn btn-warning btn-sm">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('products.destroy', $product->id) }}"
                                                            method="POST" style="display: inline;">
                                                            {{ csrf_field() }}
                                                            {{ method_field('DELETE') }}
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Are you sure you want to delete this product?')">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <!-- Pagination -->
                                <div class="d-flex justify-content-center">
                                    {{ $products->links() }}
                                </div>
                            @else
                                <div class="alert alert-info">
                                    <h5><i class="icon fas fa-info"></i> No Products Found</h5>
                                    No products have been created yet. <a href="{{ route('products.create') }}">Create the
                                        first product</a>.
                                </div>
                            @endif
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection

@section('scripts')
    @if (isset($products) && count($products) > 0)
        <script>
            $(document).ready(function() {
                // Only initialize DataTable if table exists
                if ($('#list-products-table').length) {
                    $("#list-products-table").DataTable({
                        "responsive": false,
                        "lengthChange": true,
                        "autoWidth": false,
                        "scrollX": true,
                        "scrollCollapse": true,
                        "paging": false, // Disable DataTable paging since we use Laravel pagination
                        "searching": true,
                        "ordering": true,
                        "info": false,
                        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                    }).buttons().container().appendTo('#list-products-table_wrapper .col-md-6:eq(0)');
                }
            });
        </script>
    @endif
@endsection
