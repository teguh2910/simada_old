@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">List Suppliers</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">List Suppliers</li>
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
                            <h3 class="card-title">Supplier Data</h3>
                            <div class="card-tools">
                                <a href="{{ route('suppliers.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> Create Supplier
                                </a>
                                <a href="{{ route('imports.index') }}" class="btn btn-success btn-sm">
                                    <i class="fas fa-upload"></i> Import Excel
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if (isset($suppliers) && count($suppliers) > 0)
                                <table id="list-suppliers-table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Supplier Name</th>
                                            <th>Customer</th>
                                            <th>PIC</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($suppliers as $supplier)
                                            <tr>
                                                <td>{{ $supplier->name }}</td>
                                                <td>{{ $supplier->customer ? $supplier->customer->name : '-' }}</td>
                                                <td>{{ $supplier->pic ?? '-' }}</td>
                                                <td>{{ $supplier->no_hp ?? '-' }}</td>
                                                <td>{{ $supplier->email ?? '-' }}</td>
                                                <td>
                                                    @if ($supplier->is_active)
                                                        <span class="badge badge-success">Active</span>
                                                    @else
                                                        <span class="badge badge-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="{{ route('suppliers.show', $supplier->id) }}"
                                                            class="btn btn-info btn-sm">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('suppliers.edit', $supplier->id) }}"
                                                            class="btn btn-warning btn-sm">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('suppliers.destroy', $supplier->id) }}"
                                                            method="POST" style="display: inline;">
                                                            {{ csrf_field() }}
                                                            {{ method_field('DELETE') }}
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Are you sure you want to delete this supplier?')">
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
                                    {{ $suppliers->links() }}
                                </div>
                            @else
                                <div class="alert alert-info text-center">
                                    <h5><i class="fas fa-info-circle"></i> No Supplier Data Available</h5>
                                    <p>No supplier records found. <a href="{{ route('suppliers.create') }}"
                                            class="btn btn-primary btn-sm ml-2">Create your first supplier</a></p>
                                </div>
                            @endif
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
    @if (isset($suppliers) && count($suppliers) > 0)
        <script>
            $(function() {
                $("#list-suppliers-table").DataTable({
                    "responsive": true,
                    "lengthChange": true,
                    "autoWidth": false,
                    "paging": false,
                    "lengthMenu": [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"]
                    ],
                    "pageLength": 25,
                    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                }).buttons().container().appendTo('#list-suppliers-table_wrapper .col-md-6:eq(0)');
            });
        </script>
    @endif
@endsection
