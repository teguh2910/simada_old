@extends('layouts.app')


@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
          <button type="button" class="close" data-dismiss="alert">×</button>	
            <strong>{{ $message }}</strong>
        </div>
      @endif
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <a href="{{asset('/upload_stock')}}" class="btn btn-md btn-primary">Upload Data</a>
            <h1 class="m-0">Rundown Stock</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Rundown Stock</li>              
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
          <!-- /.col-md-12 -->
          <div class="col-md-12">
          <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <center><h1>Update Per Bulan Desember 2023</h1></center>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Supplier</th>
                    <th>P/N Before</th>
                    <th>P/N After</th>
                    <th>Activity</th>
                    <th>Part Name</th>
                    <th>Shortage</th>
                    <th></th>                    
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($data as $item)
                  <tr class="bg-default">
                    <td>{{$item->id_stock}}</td>
                    <td>{{$item->supplier}}</td>
                    <td>{{$item->pn_before}}</td>
                    <td>{{$item->pn_after}}</td>
                    <td>{{$item->activity}}</td>
                    <td>{{$item->part_name}}</td>
                    <td>@php
                        $stok1 = $item->stock;      
                        $forecasts = [$item->fc_4,$item->fc_5,$item->fc_6,$item->fc_7,$item->fc_8,$item->fc_9,$item->fc_10,$item->fc_11,$item->fc_12,$item->fc_1,$item->fc_2,$item->fc_3];
                        $incomings = [$item->incoming_supplier_4,$item->incoming_supplier_5,$item->incoming_supplier_6,$item->incoming_supplier_7,$item->incoming_supplier_8,$item->incoming_supplier_9,$item->incoming_supplier_10,$item->incoming_supplier_11,$item->incoming_supplier_12,$item->incoming_supplier_1,$item->incoming_supplier_2,$item->incoming_supplier_3];
                        $grs = [$item->gr_aisin_4,$item->gr_aisin_5,$item->gr_aisin_6,$item->gr_aisin_7,$item->gr_aisin_8,$item->gr_aisin_9,$item->gr_aisin_10,$item->gr_aisin_11,$item->gr_aisin_12,$item->gr_aisin_1,$item->gr_aisin_2,$item->gr_aisin_3];
                        $balances = [$stok1];
                        for ($i = 0; $i < 12; $i++) {
                        $forecast = $forecasts[$i];
                        $incoming = $incomings[$i];
                        $gr = $grs[$i];
                        $balance = $balances[$i] + $incoming - $forecast;
                        
                        // Store the balance in an array for future reference
                        $balances[] = $balance;

                        //echo "Balance after month " . ($i + 4) . ": $balance\n";
                        // Check if balance is less than 0
                        if ($balance < 0) {
                            echo ($i + 4)."-2023";
                            break; // Exit the loop if balance is less than 0
                        }
                      }
                    @endphp</td>
                    <td><a href="{{asset('stock/'.$item->id_stock)}}" class="btn btn-sm btn-success">View Stock</a></td>                    
                  </tr>                  
                  @endforeach
                  </tbody>                  
                </table>
                <hr>
                </div>
              <!-- /.card-body -->
            </div>
            </div>
            <!-- /.col-md-12 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  
@endsection