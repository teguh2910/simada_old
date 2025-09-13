@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">List Survey to Supplier</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">List Survey to Supplier</li>
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
                            <h3 class="card-title">Survey to Supplier Data</h3>
                            <div class="card-tools">
                                <a href="{{ route('survey-supplier.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> Add Survey
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <table id="survey-supplier-table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Link Form</th>
                                        <th>File</th>
                                        <th>Supplier</th>
                                        <th>Due Date</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($surveySuppliers as $survey)
                                        <tr>
                                            <td><a href="{{ $survey->link_form }}"
                                                    target="_blank">{{ $survey->link_form }}</a></td>
                                            <td>
                                                @if ($survey->file)
                                                    <a href="{{ Storage::url($survey->file) }}" target="_blank">Download</a>
                                                @else
                                                    No file
                                                @endif
                                            </td>
                                            <td>
                                                @if ($survey->id_supplier)
                                                    {{ $survey->supplier->name ?? 'N/A' }}
                                                @else
                                                    <span class="badge badge-info">All Suppliers</span>
                                                @endif
                                            </td>
                                            <td>{{ $survey->due_date }}</td>
                                            <td>{{ $survey->created_at->format('Y-m-d') }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('survey-supplier.show', $survey->id) }}"
                                                        class="btn btn-sm btn-info" title="View">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('survey-supplier.edit', $survey->id) }}"
                                                        class="btn btn-sm btn-warning" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('survey-supplier.destroy', $survey->id) }}"
                                                        method="POST" style="display: inline;">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="submit" class="btn btn-sm btn-danger" title="Delete"
                                                            onclick="return confirm('Are you sure?')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
        $(function() {
            $("#survey-supplier-table").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#survey-supplier-table_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
