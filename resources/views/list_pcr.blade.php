@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">List PCR</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">List PCR</li>
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
                <h3 class="card-title">PCR Data</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="list-pcr-table" class="table table-bordered table-striped">
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
                    @if(isset($data) && is_array($data))
                      @foreach($data as $item)
                      <tr>
                        <td>{{ $item['Pur PIC'] ?? '' }}</td>
                        <td>{{ $item['Department'] ?? '' }}</td>
                        <td>{{ $item['Reg Numb'] ?? '' }}</td>
                        <td>{{ $item['Status'] ?? '' }}</td>    
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
        #list-pcr-table th:nth-child(1), #list-pcr-table td:nth-child(1) { width: 120px !important; min-width: 120px !important; }
        #list-pcr-table th:nth-child(2), #list-pcr-table td:nth-child(2) { width: 100px !important; min-width: 100px !important; }
        #list-pcr-table th:nth-child(3), #list-pcr-table td:nth-child(3) { width: 140px !important; min-width: 140px !important; }
        #list-pcr-table th:nth-child(4), #list-pcr-table td:nth-child(4) { width: 100px !important; min-width: 100px !important; }
        #list-pcr-table th:nth-child(5), #list-pcr-table td:nth-child(5) { width: 80px !important; min-width: 80px !important; }
        #list-pcr-table th:nth-child(6), #list-pcr-table td:nth-child(6) { width: 180px !important; min-width: 180px !important; }
        #list-pcr-table th:nth-child(7), #list-pcr-table td:nth-child(7) { width: 120px !important; min-width: 120px !important; }
        #list-pcr-table th:nth-child(8), #list-pcr-table td:nth-child(8) { width: 150px !important; min-width: 150px !important; }
        #list-pcr-table th:nth-child(9), #list-pcr-table td:nth-child(9) { width: 120px !important; min-width: 120px !important; }
        #list-pcr-table th:nth-child(10), #list-pcr-table td:nth-child(10) { width: 500px !important; min-width: 300px !important; }
        #list-pcr-table th:nth-child(11), #list-pcr-table td:nth-child(11) { width: 120px !important; min-width: 120px !important; }
        #list-pcr-table th:nth-child(12), #list-pcr-table td:nth-child(12) { width: 100px !important; min-width: 100px !important; }
        #list-pcr-table th:nth-child(13), #list-pcr-table td:nth-child(13) { width: 100px !important; min-width: 100px !important; }
        #list-pcr-table th:nth-child(14), #list-pcr-table td:nth-child(14) { width: 100px !important; min-width: 100px !important; }
        #list-pcr-table th:nth-child(15), #list-pcr-table td:nth-child(15) { width: 100px !important; min-width: 100px !important; }
        #list-pcr-table th:nth-child(16), #list-pcr-table td:nth-child(16) { width: 100px !important; min-width: 100px !important; }
      `)
      .appendTo('head');

    $("#list-pcr-table").DataTable({
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
    }).buttons().container().appendTo('#list-pcr-table_wrapper .col-md-6:eq(0)');
  });
</script>
@endsection
