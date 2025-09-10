@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">List RFQ</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">List RFQ</li>
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
                            <h3 class="card-title">RFQ Data</h3>
                            <div class="card-tools">
                                <a href="{{ route('rfq.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> Create RFQ
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="list-rfq-table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>RFQ Number</th>
                                        <th>RFQ Date</th>
                                        <th>Project</th>
                                        <th>Department</th>
                                        <th>Part Name</th>
                                        <th>Part Number</th>
                                        <th>Quantity</th>
                                        <th>Unit</th>
                                        <th>Description</th>
                                        <th>Suppliers</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($rfqData) && is_array($rfqData))
                                        @foreach ($rfqData as $rfq)
                                            <tr>
                                                <td>{{ $rfq['rfq_number'] ?? '' }}</td>
                                                <td>{{ $rfq['rfq_date'] ?? '' }}</td>
                                                <td>{{ $rfq['project'] ?? '' }}</td>
                                                <td>{{ $rfq['department'] ?? '' }}</td>
                                                <td>{{ $rfq['part_name'] ?? '' }}</td>
                                                <td>{{ $rfq['part_number'] ?? '' }}</td>
                                                <td>{{ $rfq['quantity'] ?? '' }}</td>
                                                <td>{{ $rfq['unit'] ?? '' }}</td>
                                                <td>{{ $rfq['description'] ?? '' }}</td>
                                                <td>
                                                    @if (isset($rfq['suppliers']) && is_array($rfq['suppliers']))
                                                        <ul class="list-unstyled">
                                                            @foreach ($rfq['suppliers'] as $supplier)
                                                                <li><small>{{ $supplier }}</small></li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge badge-{{ $rfq['status'] == 'Open' ? 'success' : 'secondary' }}">
                                                        {{ $rfq['status'] ?? '' }}
                                                    </span>
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
        #list-rfq-table th:nth-child(1), #list-rfq-table td:nth-child(1) { width: 120px !important; min-width: 120px !important; }
        #list-rfq-table th:nth-child(2), #list-rfq-table td:nth-child(2) { width: 100px !important; min-width: 100px !important; }
        #list-rfq-table th:nth-child(3), #list-rfq-table td:nth-child(3) { width: 120px !important; min-width: 120px !important; }
        #list-rfq-table th:nth-child(4), #list-rfq-table td:nth-child(4) { width: 100px !important; min-width: 100px !important; }
        #list-rfq-table th:nth-child(5), #list-rfq-table td:nth-child(5) { width: 120px !important; min-width: 120px !important; }
        #list-rfq-table th:nth-child(6), #list-rfq-table td:nth-child(6) { width: 100px !important; min-width: 100px !important; }
        #list-rfq-table th:nth-child(7), #list-rfq-table td:nth-child(7) { width: 80px !important; min-width: 80px !important; }
        #list-rfq-table th:nth-child(8), #list-rfq-table td:nth-child(8) { width: 60px !important; min-width: 60px !important; }
        #list-rfq-table th:nth-child(9), #list-rfq-table td:nth-child(9) { width: 200px !important; min-width: 200px !important; }
        #list-rfq-table th:nth-child(10), #list-rfq-table td:nth-child(10) { width: 150px !important; min-width: 150px !important; }
        #list-rfq-table th:nth-child(11), #list-rfq-table td:nth-child(11) { width: 80px !important; min-width: 80px !important; }
      `)
                .appendTo('head');

            $("#list-rfq-table").DataTable({
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
            }).buttons().container().appendTo('#list-rfq-table_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
