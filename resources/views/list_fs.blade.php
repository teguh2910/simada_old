@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">List Feasibility Study</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">List Feasibility Study</li>
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
                            <h3 class="card-title">Feasibility Study Data</h3>
                            <div class="card-tools">
                                <a href="{{ route('fs.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> Add FS
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="list-fs-table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Project Title</th>
                                        <th>Description</th>
                                        <th>Estimated Cost</th>
                                        <th>Timeline</th>
                                        <th>Risk Level</th>
                                        <th>Status</th>
                                        <th>Assigned To</th>
                                        <th>Due Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($fsData) && is_array($fsData))
                                        @foreach ($fsData as $fs)
                                            <tr>
                                                <td>{{ $fs['project_title'] ?? '' }}</td>
                                                <td>
                                                    <span title="{{ $fs['description'] ?? '' }}">
                                                        @php
                                                            $description = $fs['description'] ?? '';
                                                            echo strlen($description) > 50
                                                                ? substr($description, 0, 50) . '...'
                                                                : $description;
                                                        @endphp
                                                    </span>
                                                </td>
                                                <td>Rp {{ number_format($fs['estimated_cost'] ?? 0, 0, ',', '.') }}</td>
                                                <td>{{ $fs['timeline_months'] ?? '' }} months</td>
                                                <td>
                                                    @php
                                                        $riskClass = '';
                                                        switch ($fs['risk_level']) {
                                                            case 'Low':
                                                                $riskClass = 'badge-success';
                                                                break;
                                                            case 'Medium':
                                                                $riskClass = 'badge-warning';
                                                                break;
                                                            case 'High':
                                                                $riskClass = 'badge-danger';
                                                                break;
                                                            default:
                                                                $riskClass = 'badge-secondary';
                                                        }
                                                    @endphp
                                                    <span
                                                        class="badge {{ $riskClass }}">{{ $fs['risk_level'] ?? '' }}</span>
                                                </td>
                                                <td>
                                                    @php
                                                        $statusClass = '';
                                                        switch ($fs['status']) {
                                                            case 'Completed':
                                                                $statusClass = 'badge-success';
                                                                break;
                                                            case 'In Progress':
                                                                $statusClass = 'badge-info';
                                                                break;
                                                            case 'Pending':
                                                                $statusClass = 'badge-warning';
                                                                break;
                                                            case 'Cancelled':
                                                                $statusClass = 'badge-secondary';
                                                                break;
                                                            default:
                                                                $statusClass = 'badge-light';
                                                        }
                                                    @endphp
                                                    <span class="badge {{ $statusClass }}">{{ $fs['status'] ?? '' }}</span>
                                                </td>
                                                <td>{{ $fs['assigned_to'] ?? '' }}</td>
                                                <td>{{ isset($fs['due_date']) ? \Carbon\Carbon::parse($fs['due_date'])->format('d M Y') : '' }}
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-sm btn-info"
                                                            title="View Details">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-warning"
                                                            title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-danger" title="Delete">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
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
            // Add custom CSS for column widths
            $('<style>')
                .html(`
        #list-fs-table th:nth-child(1), #list-fs-table td:nth-child(1) { width: 150px !important; min-width: 150px !important; }
        #list-fs-table th:nth-child(2), #list-fs-table td:nth-child(2) { width: 200px !important; min-width: 200px !important; }
        #list-fs-table th:nth-child(3), #list-fs-table td:nth-child(3) { width: 120px !important; min-width: 120px !important; }
        #list-fs-table th:nth-child(4), #list-fs-table td:nth-child(4) { width: 80px !important; min-width: 80px !important; }
        #list-fs-table th:nth-child(5), #list-fs-table td:nth-child(5) { width: 100px !important; min-width: 100px !important; }
        #list-fs-table th:nth-child(6), #list-fs-table td:nth-child(6) { width: 100px !important; min-width: 100px !important; }
        #list-fs-table th:nth-child(7), #list-fs-table td:nth-child(7) { width: 120px !important; min-width: 120px !important; }
        #list-fs-table th:nth-child(8), #list-fs-table td:nth-child(8) { width: 100px !important; min-width: 100px !important; }
        #list-fs-table th:nth-child(9), #list-fs-table td:nth-child(9) { width: 120px !important; min-width: 120px !important; }
      `)
                .appendTo('head');

            $("#list-fs-table").DataTable({
                "responsive": false,
                "lengthChange": true,
                "autoWidth": false,
                "scrollX": true,
                "scrollCollapse": true,
                "paging": true,
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                "pageLength": 10,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
                "initComplete": function() {
                    // Force column adjustment after CSS is applied
                    setTimeout(() => {
                        this.api().columns.adjust();
                    }, 100);
                }
            }).buttons().container().appendTo('#list-fs-table_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
