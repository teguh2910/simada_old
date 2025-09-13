@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">List RFQ APR</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">List RFQ APR</li>
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
                            <h3 class="card-title">RFQ APR Data</h3>
                            <div class="card-tools">
                                <a href="{{ route('rfq-apr.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> Create RFQ APR
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if (isset($rfqAprs) && count($rfqAprs) > 0)
                                <table id="list-rfq-apr-table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Spec RM</th>
                                            <th>Periode</th>
                                            <th>Due Date</th>
                                            <th>PIC</th>
                                            <th>Supplier</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($rfqAprs as $rfqApr)
                                            <tr>
                                                <td>{{ $rfqApr->id }}</td>
                                                <td>{{ $rfqApr->spec_rm }}</td>
                                                <td>{{ $rfqApr->periode }}</td>
                                                <td>{{ isset($rfqApr->due_date) && $rfqApr->due_date ? $rfqApr->due_date->format('Y-m-d') : '-' }}
                                                </td>
                                                <td>{{ $rfqApr->pic_name }}</td>
                                                <td>{{ $rfqApr->suppliers_formatted }}</td>
                                                <td>
                                                    <span
                                                        class="badge badge-{{ $rfqApr->status == 'draft' ? 'secondary' : ($rfqApr->status == 'approved' ? 'success' : 'warning') }}">
                                                        {{ ucfirst($rfqApr->status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="btn-group-sm">
                                                        <a href="{{ route('rfq-apr.show', $rfqApr->id) }}"
                                                            class="btn btn-info btn-xs" title="View">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('rfq-apr.edit', $rfqApr->id) }}"
                                                            class="btn btn-warning btn-xs" title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('rfq-apr.destroy', $rfqApr->id) }}"
                                                            method="POST" style="display: inline;">
                                                            {{ csrf_field() }}
                                                            {{ method_field('DELETE') }}
                                                            <button type="submit" class="btn btn-danger btn-xs"
                                                                title="Delete"
                                                                onclick="return confirm('Are you sure you want to delete this RFQ APR?')">
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
                                    No RFQ APR data available. <a href="{{ route('rfq-apr.create') }}">Create the first
                                        one</a>.
                                </div>
                            @endif
                        </div>
                        <!-- /.card-body -->
                        @if (isset($rfqAprs))
                            <div class="card-footer">
                                {{ $rfqAprs->links() }}
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
            $('#list-rfq-apr-table').DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#list-rfq-apr-table_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
