@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">List Customers</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">List Customers</li>
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
                            <h3 class="card-title">Customer Data</h3>
                            <div class="card-tools">
                                <a href="{{ route('customers.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> Create Customer
                                </a>
                                <a href="{{ route('imports.index') }}" class="btn btn-success btn-sm">
                                    <i class="fas fa-upload"></i> Import Excel
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if (isset($customers) && count($customers) > 0)
                                <table id="list-customers-table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Customer Name</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($customers as $customer)
                                            <tr>
                                                <td>{{ $customer->name }}</td>
                                                <td>
                                                    @if ($customer->is_active)
                                                        <span class="badge badge-success">Active</span>
                                                    @else
                                                        <span class="badge badge-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="{{ route('customers.show', $customer->id) }}"
                                                            class="btn btn-info btn-sm">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('customers.edit', $customer->id) }}"
                                                            class="btn btn-warning btn-sm">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('customers.destroy', $customer->id) }}"
                                                            method="POST" style="display: inline;">
                                                            {{ csrf_field() }}
                                                            {{ method_field('DELETE') }}
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Are you sure you want to delete this customer?')">
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
                                    {{ $customers->links() }}
                                </div>
                            @else
                                <div class="alert alert-info">
                                    <h5><i class="icon fas fa-info"></i> No Customers Found</h5>
                                    No customers have been created yet. <a href="{{ route('customers.create') }}">Create
                                        the first customer</a>.
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
    @if (isset($customers) && count($customers) > 0)
        <script>
            $(document).ready(function() {
                // Only initialize DataTable if table exists
                if ($('#list-customers-table').length) {
                    $("#list-customers-table").DataTable({
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
                    }).buttons().container().appendTo('#list-customers-table_wrapper .col-md-6:eq(0)');
                }
            });
        </script>
    @endif
@endsection
