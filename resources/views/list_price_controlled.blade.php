@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">List Price Controlled</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">List Price Controlled</li>
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
                            <h3 class="card-title">Price Controlled Data</h3>
                            <div class="card-tools">
                                <a href="{{ route('price-controlled.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> Add Price Control
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="list-price-controlled-table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Supplier</th>
                                        <th>Periode</th>
                                        <th>Status</th>
                                        <th>Created Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($priceControlledData) && is_array($priceControlledData))
                                        @foreach ($priceControlledData as $item)
                                            <tr>
                                                <td>{{ $item['supplier'] ?? '' }}</td>
                                                <td>{{ $item['periode'] ?? '' }}</td>
                                                <td>
                                                    @php
                                                        $statusClass = '';
                                                        switch ($item['status']) {
                                                            case 'Approve':
                                                                $statusClass = 'badge-success';
                                                                break;
                                                            case 'Wait Quotation':
                                                                $statusClass = 'badge-warning';
                                                                break;
                                                            case 'Process Approval':
                                                                $statusClass = 'badge-info';
                                                                break;
                                                            default:
                                                                $statusClass = 'badge-secondary';
                                                        }
                                                    @endphp
                                                    <span
                                                        class="badge {{ $statusClass }}">{{ $item['status'] ?? '' }}</span>
                                                </td>
                                                <td>{{ $item['created_date'] ?? '' }}</td>
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
        #list-price-controlled-table th:nth-child(1), #list-price-controlled-table td:nth-child(1) { width: 200px !important; min-width: 200px !important; }
        #list-price-controlled-table th:nth-child(2), #list-price-controlled-table td:nth-child(2) { width: 120px !important; min-width: 120px !important; }
        #list-price-controlled-table th:nth-child(3), #list-price-controlled-table td:nth-child(3) { width: 150px !important; min-width: 150px !important; }
        #list-price-controlled-table th:nth-child(4), #list-price-controlled-table td:nth-child(4) { width: 120px !important; min-width: 120px !important; }
        #list-price-controlled-table th:nth-child(5), #list-price-controlled-table td:nth-child(5) { width: 120px !important; min-width: 120px !important; }
      `)
                .appendTo('head');

            $("#list-price-controlled-table").DataTable({
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
            }).buttons().container().appendTo('#list-price-controlled-table_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
