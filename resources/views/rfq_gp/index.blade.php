@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">List RFQ GP</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">List RFQ GP</li>
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
                            <h3 class="card-title">RFQ GP Data</h3>
                            <div class="card-tools">
                                <a href="{{ route('rfq-gp.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> Create RFQ GP
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if (isset($rfqGps) && count($rfqGps) > 0)
                                <table id="list-rfq-gp-table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Spec</th>
                                            <th>Ex-Rate</th>
                                            <th>Qty/Month</th>
                                            <th>Satuan</th>
                                            <th>Supplier</th>
                                            <th>Created At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($rfqGps as $rfqGp)
                                            <tr>
                                                <td>{{ $rfqGp->id }}</td>
                                                <td>{{ $rfqGp->spec ? str_limit($rfqGp->spec, 50) : '-' }}</td>
                                                <td>{{ $rfqGp->ex_rate ? number_format($rfqGp->ex_rate, 4) : '-' }}</td>
                                                <td>{{ $rfqGp->qty_month ? number_format($rfqGp->qty_month) : '-' }}</td>
                                                <td>{{ $rfqGp->satuan ?: '-' }}</td>
                                                <td>{{ $rfqGp->suppliers_formatted }}</td>
                                                <td>{{ $rfqGp->created_at ? $rfqGp->created_at->format('Y-m-d') : '-' }}
                                                </td>
                                                <td>
                                                    <div class="btn-group-sm">
                                                        <a href="{{ route('rfq-gp.show', $rfqGp->id) }}"
                                                            class="btn btn-info btn-xs" title="View">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('rfq-gp.edit', $rfqGp->id) }}"
                                                            class="btn btn-warning btn-xs" title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('rfq-gp.destroy', $rfqGp->id) }}"
                                                            method="POST" style="display: inline;">
                                                            {{ csrf_field() }}
                                                            {{ method_field('DELETE') }}
                                                            <button type="submit" class="btn btn-danger btn-xs"
                                                                title="Delete"
                                                                onclick="return confirm('Are you sure you want to delete this RFQ GP?')">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="alert alert-info">
                                    <h5><i class="icon fas fa-info"></i> No Data Found</h5>
                                    No RFQ GP records found. <a href="{{ route('rfq-gp.create') }}">Create the first
                                        one</a>.
                                </div>
                            @endif
                        </div>
                        <!-- /.card-body -->
                        @if (isset($rfqGps))
                            <div class="card-footer">
                                {{ $rfqGps->links() }}
                            </div>
                        @endif
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
        $(function() {
            $("#list-rfq-gp-table").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#list-rfq-gp-table_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
