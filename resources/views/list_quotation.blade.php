@extends('layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Check Quotation List</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Check Quotation</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Quotation Records</h3>
                            <div class="card-tools">
                                <a href="{{ route('quotation.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> Add Quotation
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="quotationTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Quotation #</th>
                                        <th>Supplier</th>
                                        <th>Part Details</th>
                                        <th>Quantity</th>
                                        <th>Unit Price</th>
                                        <th>Total Price</th>
                                        <th>Valid Until</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($quotationData as $quotation)
                                        <tr>
                                            <td>{{ $quotation['quotation_number'] }}</td>
                                            <td>
                                                <strong>{{ $quotation['supplier'] }}</strong><br>
                                                <small class="text-muted">{{ $quotation['contact_person'] }}</small>
                                            </td>
                                            <td>
                                                <strong>{{ $quotation['part_number'] }}</strong><br>
                                                <small>{{ $quotation['part_name'] }}</small>
                                            </td>
                                            <td>{{ number_format($quotation['quantity']) }}</td>
                                            <td>{{ $quotation['currency'] }}
                                                {{ number_format($quotation['unit_price'], 0, ',', '.') }}</td>
                                            <td><strong>{{ $quotation['currency'] }}
                                                    {{ number_format($quotation['total_price'], 0, ',', '.') }}</strong>
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($quotation['valid_until'])->format('d M Y') }}
                                            </td>
                                            <td>
                                                @if ($quotation['status'] == 'Approved')
                                                    <span class="badge badge-success">{{ $quotation['status'] }}</span>
                                                @elseif($quotation['status'] == 'Pending')
                                                    <span class="badge badge-warning">{{ $quotation['status'] }}</span>
                                                @elseif($quotation['status'] == 'Rejected')
                                                    <span class="badge badge-danger">{{ $quotation['status'] }}</span>
                                                @elseif($quotation['status'] == 'Under Review')
                                                    <span class="badge badge-info">{{ $quotation['status'] }}</span>
                                                @else
                                                    <span class="badge badge-secondary">{{ $quotation['status'] }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info btn-sm" title="View Details">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-warning btn-sm" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-success btn-sm" title="Approve">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-sm" title="Reject">
                                                        <i class="fas fa-times"></i>
                                                    </button>
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
    </section>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#quotationTable').DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
                "columnDefs": [{
                        "width": "10%",
                        "targets": 0
                    },
                    {
                        "width": "15%",
                        "targets": 1
                    },
                    {
                        "width": "15%",
                        "targets": 2
                    },
                    {
                        "width": "8%",
                        "targets": 3
                    },
                    {
                        "width": "10%",
                        "targets": 4
                    },
                    {
                        "width": "12%",
                        "targets": 5
                    },
                    {
                        "width": "10%",
                        "targets": 6
                    },
                    {
                        "width": "10%",
                        "targets": 7
                    },
                    {
                        "width": "10%",
                        "targets": 8,
                        "orderable": false
                    }
                ]
            }).buttons().container().appendTo('#quotationTable_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
