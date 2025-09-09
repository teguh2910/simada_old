@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">List Pending PCR</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">List Pending PCR</li>
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
                <h3 class="card-title">Pending PCR Data</h3>
                <div class="card-tools">
                  <span class="badge badge-warning">Filtered by Status: On Hold, Stage 0-3 Progress</span>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="list-pending-pcr-table" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>Pur PIC</th>
                      <th>Department</th>
                      <th>Reg Numb</th>
                      <th>Status</th>
                      <th>Coy</th>
                      <th>Supplier</th>
                      <th>Classification</th>
                      <th>Problem</th>
                      <th>Type of activity</th>
                      <th>Activity Description</th>
                      <th>Part Name</th>
                      <th>Part No</th>
                      <th>Product</th>
                      <th>Model</th>
                      <th>Plan SVP</th>
                      <th>Act SVP</th>
                    </tr>
                    </thead>
                  <tbody>
                    @if(isset($filteredData) && is_array($filteredData))
                      @foreach($filteredData as $item)
                      <tr>
                        <td>{{ $item['Pur PIC'] ?? '' }}</td>
                        <td>{{ $item['Department'] ?? '' }}</td>
                        <td>{{ $item['Reg Numb'] ?? '' }}</td>
                        <td>
                          <span class="badge
                            @if($item['Status'] == 'On Hold') badge-warning
                            @elseif($item['Status'] == 'Stage 0 Progress') badge-info
                            @elseif($item['Status'] == 'Stage 1 Progress') badge-primary
                            @elseif($item['Status'] == 'Stage 2 Progress') badge-success
                            @elseif($item['Status'] == 'Stage 3 Progress') badge-dark
                            @else badge-secondary
                            @endif">
                            {{ $item['Status'] ?? '' }}
                          </span>
                        </td>
                        <td>{{ $item['Coy'] ?? '' }}</td>
                        <td>{{ $item['Supplier'] ?? '' }}</td>
                        <td>{{ $item['Classification'] ?? '' }}</td>
                        <td>{{ $item['Problem'] ?? '' }}</td>
                        <td>{{ $item['Type of activity'] ?? '' }}</td>
                        <td>{{ $item['Activity Description'] ?? '' }}</td>
                        <td>{{ $item['Part Name'] ?? '' }}</td>
                        <td>{{ $item['Part No'] ?? '' }}</td>
                        <td>{{ $item['Product'] ?? '' }}</td>
                        <td>{{ $item['Model'] ?? '' }}</td>
                        <td>{{ $item['Plan SVP'] ?? '' }}</td>
                        <td>{{ $item['Act SVP'] ?? '' }}</td>
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
  $(function () {
    // Add custom CSS for column widths
    $('<style>')
      .html(`
        #list-pending-pcr-table th:nth-child(1), #list-pending-pcr-table td:nth-child(1) { width: 120px !important; min-width: 120px !important; }
        #list-pending-pcr-table th:nth-child(2), #list-pending-pcr-table td:nth-child(2) { width: 100px !important; min-width: 100px !important; }
        #list-pending-pcr-table th:nth-child(3), #list-pending-pcr-table td:nth-child(3) { width: 140px !important; min-width: 140px !important; }
        #list-pending-pcr-table th:nth-child(4), #list-pending-pcr-table td:nth-child(4) { width: 120px !important; min-width: 120px !important; }
        #list-pending-pcr-table th:nth-child(5), #list-pending-pcr-table td:nth-child(5) { width: 80px !important; min-width: 80px !important; }
        #list-pending-pcr-table th:nth-child(6), #list-pending-pcr-table td:nth-child(6) { width: 180px !important; min-width: 180px !important; }
        #list-pending-pcr-table th:nth-child(7), #list-pending-pcr-table td:nth-child(7) { width: 120px !important; min-width: 120px !important; }
        #list-pending-pcr-table th:nth-child(8), #list-pending-pcr-table td:nth-child(8) { width: 150px !important; min-width: 150px !important; }
        #list-pending-pcr-table th:nth-child(9), #list-pending-pcr-table td:nth-child(9) { width: 120px !important; min-width: 120px !important; }
        #list-pending-pcr-table th:nth-child(10), #list-pending-pcr-table td:nth-child(10) { width: 300px !important; min-width: 300px !important; }
        #list-pending-pcr-table th:nth-child(11), #list-pending-pcr-table td:nth-child(11) { width: 120px !important; min-width: 120px !important; }
        #list-pending-pcr-table th:nth-child(12), #list-pending-pcr-table td:nth-child(12) { width: 100px !important; min-width: 100px !important; }
        #list-pending-pcr-table th:nth-child(13), #list-pending-pcr-table td:nth-child(13) { width: 100px !important; min-width: 100px !important; }
        #list-pending-pcr-table th:nth-child(14), #list-pending-pcr-table td:nth-child(14) { width: 100px !important; min-width: 100px !important; }
        #list-pending-pcr-table th:nth-child(15), #list-pending-pcr-table td:nth-child(15) { width: 100px !important; min-width: 100px !important; }
        #list-pending-pcr-table th:nth-child(16), #list-pending-pcr-table td:nth-child(16) { width: 100px !important; min-width: 100px !important; }
      `)
      .appendTo('head');

    $("#list-pending-pcr-table").DataTable({
      "responsive": false,
      "lengthChange": true,
      "autoWidth": false,
      "scrollX": true,
      "scrollCollapse": true,
      "paging": true,
      "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
      "pageLength": 10,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
      "initComplete": function() {
        // Force column adjustment after CSS is applied
        setTimeout(() => {
          this.api().columns.adjust();
        }, 100);
      }
    }).buttons().container().appendTo('#list-pending-pcr-table_wrapper .col-md-6:eq(0)');
  });
</script>
@endsection
