@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">List PICs</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">List PICs</li>
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

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">PIC Data</h3>
                            <div class="card-tools">
                                <a href="{{ route('pics.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> Create PIC
                                </a>
                                <a href="{{ route('imports.index') }}" class="btn btn-success btn-sm">
                                    <i class="fas fa-upload"></i> Import Excel
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if (isset($pics) && count($pics) > 0)
                                <table id="list-pics-table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Department</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pics as $pic)
                                            <tr>
                                                <td>{{ $pic->name }}</td>
                                                <td>{{ $pic->position ?? '-' }}</td>
                                                <td>{{ $pic->department ?? '-' }}</td>
                                                <td>{{ $pic->email ?? '-' }}</td>
                                                <td>{{ $pic->phone ?? '-' }}</td>
                                                <td>
                                                    @if ($pic->is_active)
                                                        <span class="badge badge-success">Active</span>
                                                    @else
                                                        <span class="badge badge-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="{{ route('pics.show', $pic->id) }}"
                                                            class="btn btn-info btn-sm">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('pics.edit', $pic->id) }}"
                                                            class="btn btn-warning btn-sm">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('pics.destroy', $pic->id) }}" method="POST"
                                                            style="display: inline;">
                                                            {{ csrf_field() }}
                                                            {{ method_field('DELETE') }}
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Are you sure you want to delete this PIC?')">
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
                                    {{ $pics->links() }}
                                </div>
                            @else
                                <div class="alert alert-info">
                                    <h5><i class="icon fas fa-info"></i> No PICs Found!</h5>
                                    No PIC data available. <a href="{{ route('pics.create') }}">Create the first PIC</a>.
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
    <script>
        $(function() {
            $("#list-pics-table").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#list-pics-table_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
