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
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
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
                            <h3 class="card-title">RFQ Data</h3>
                            <div class="card-tools">
                                <a href="{{ route('rfq.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> Create RFQ
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if (isset($rfqs) && count($rfqs) > 0)
                                <table id="list-rfq-table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Customer</th>
                                            <th>Product</th>
                                            <th>Part Number</th>
                                            <th>Part Name</th>
                                            <th>Std Qty</th>
                                            <th>Qty/Month</th>
                                            <th>Drawing Time</th>
                                            <th>OTS Target</th>
                                            <th>OTOP Target</th>
                                            <th>SOP</th>
                                            <th>Due Date</th>
                                            <th>PIC</th>
                                            <th>Supplier</th>
                                            <th>Files</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($rfqs as $rfq)
                                            <tr>
                                                <td>{{ $rfq->customer ?? '' }}</td>
                                                <td>{{ $rfq->produk ?? '' }}</td>
                                                <td>{{ $rfq->part_number ?? '' }}</td>
                                                <td>{{ $rfq->part_name ?? '' }}</td>
                                                <td>{{ isset($rfq->std_qty) ? number_format($rfq->std_qty) : '' }}</td>
                                                <td>{{ isset($rfq->qty_month) ? number_format($rfq->qty_month) : '' }}</td>
                                                <td>{{ isset($rfq->drawing_time) && $rfq->drawing_time ? $rfq->drawing_time->format('Y-m-d') : '-' }}
                                                </td>
                                                <td>{{ isset($rfq->OTS_Target) && $rfq->OTS_Target ? $rfq->OTS_Target->format('Y-m-d') : '-' }}
                                                </td>
                                                <td>{{ isset($rfq->OTOP_target) && $rfq->OTOP_target ? $rfq->OTOP_target->format('Y-m-d') : '-' }}
                                                </td>
                                                <td>{{ isset($rfq->SOP) && $rfq->SOP ? $rfq->SOP->format('Y-m-d') : '-' }}
                                                </td>
                                                <td>{{ isset($rfq->due_date) && $rfq->due_date ? $rfq->due_date->format('Y-m-d') : '-' }}
                                                </td>
                                                <td>{{ $rfq->pic_name }}</td>
                                                <td>{{ $rfq->suppliers_formatted }}</td>
                                                <td>
                                                    <div class="btn-group-vertical btn-group-sm">
                                                        @if (isset($rfq->drawing_file) && $rfq->drawing_file)
                                                            <a href="{{ Storage::url($rfq->drawing_file) }}"
                                                                class="btn btn-info btn-xs" target="_blank"
                                                                title="Drawing File">
                                                                <i class="fas fa-file-image"></i>
                                                            </a>
                                                        @endif
                                                        @if (isset($rfq->excel_term_file) && $rfq->excel_term_file)
                                                            <a href="{{ Storage::url($rfq->excel_term_file) }}"
                                                                class="btn btn-success btn-xs" target="_blank"
                                                                title="Excel Term File">
                                                                <i class="fas fa-file-excel"></i>
                                                            </a>
                                                        @endif
                                                        @if (isset($rfq->loading_capacity_file) && $rfq->loading_capacity_file)
                                                            <a href="{{ Storage::url($rfq->loading_capacity_file) }}"
                                                                class="btn btn-warning btn-xs" target="_blank"
                                                                title="Loading Capacity File">
                                                                <i class="fas fa-file-alt"></i>
                                                            </a>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="{{ route('rfq.show', $rfq->id ?? 0) }}"
                                                            class="btn btn-info btn-sm" title="View">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('rfq.edit', $rfq->id ?? 0) }}"
                                                            class="btn btn-warning btn-sm" title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="{{ route('rfq.sendEmail', $rfq->id ?? 0) }}"
                                                            class="btn btn-secondary btn-sm" title="Send Email"
                                                            onclick="return confirm('Are you sure you want to send an email for this RFQ?')">
                                                            <i class="fas fa-envelope"></i>
                                                        </a>
                                                        <form action="{{ route('rfq.destroy', $rfq->id ?? 0) }}"
                                                            method="POST" style="display: inline;"
                                                            onsubmit="return confirm('Are you sure you want to delete this RFQ?')">
                                                            {{ csrf_field() }}
                                                            {{ method_field('DELETE') }}
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                title="Delete">
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
                                <div class="alert alert-info text-center">
                                    <h5><i class="fas fa-info-circle"></i> No RFQ Data Available</h5>
                                    <p>No RFQ records found. <a href="{{ route('rfq.create') }}"
                                            class="btn btn-primary btn-sm ml-2">Create your first RFQ</a></p>
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
    @if (isset($rfqs) && count($rfqs) > 0)
        <script>
            $(function() {
                // Add custom CSS for column widths
                $('<style>')
                    .html(`
        #list-rfq-table th:nth-child(1), #list-rfq-table td:nth-child(1) { width: 120px !important; min-width: 120px !important; }
        #list-rfq-table th:nth-child(2), #list-rfq-table td:nth-child(2) { width: 100px !important; min-width: 100px !important; }
        #list-rfq-table th:nth-child(3), #list-rfq-table td:nth-child(3) { width: 120px !important; min-width: 120px !important; }
        #list-rfq-table th:nth-child(4), #list-rfq-table td:nth-child(4) { width: 120px !important; min-width: 120px !important; }
        #list-rfq-table th:nth-child(5), #list-rfq-table td:nth-child(5) { width: 80px !important; min-width: 80px !important; }
        #list-rfq-table th:nth-child(6), #list-rfq-table td:nth-child(6) { width: 80px !important; min-width: 80px !important; }
        #list-rfq-table th:nth-child(7), #list-rfq-table td:nth-child(7) { width: 100px !important; min-width: 100px !important; }
        #list-rfq-table th:nth-child(8), #list-rfq-table td:nth-child(8) { width: 100px !important; min-width: 100px !important; }
        #list-rfq-table th:nth-child(9), #list-rfq-table td:nth-child(9) { width: 100px !important; min-width: 100px !important; }
        #list-rfq-table th:nth-child(10), #list-rfq-table td:nth-child(10) { width: 80px !important; min-width: 80px !important; }
        #list-rfq-table th:nth-child(11), #list-rfq-table td:nth-child(11) { width: 100px !important; min-width: 100px !important; }
        #list-rfq-table th:nth-child(12), #list-rfq-table td:nth-child(12) { width: 80px !important; min-width: 80px !important; }
        #list-rfq-table th:nth-child(13), #list-rfq-table td:nth-child(13) { width: 100px !important; min-width: 100px !important; }
        #list-rfq-table th:nth-child(14), #list-rfq-table td:nth-child(14) { width: 80px !important; min-width: 80px !important; }
        #list-rfq-table th:nth-child(15), #list-rfq-table td:nth-child(15) { width: 120px !important; min-width: 120px !important; }
      `)
                    .appendTo('head');

                // Only initialize DataTable if table exists
                if ($('#list-rfq-table').length) {
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
                        "pageLength": 25,
                        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
                        "initComplete": function() {
                            // Force column adjustment after CSS is applied
                            setTimeout(() => {
                                this.api().columns.adjust();
                            }, 100);
                        }
                    }).buttons().container().appendTo('#list-rfq-table_wrapper .col-md-6:eq(0)');
                }
            });
        </script>
    @endif
@endsection
