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
  @php
      $stok1 = $data->stock;
      // Define arrays for forecast, incoming, and gr values for each month
      $forecasts = [$data->fc_4,$data->fc_5,$data->fc_6,$data->fc_7,$data->fc_8,$data->fc_9,$data->fc_10,$data->fc_11,$data->fc_12,$data->fc_1,$data->fc_2,$data->fc_3];
      $incomings = [$data->incoming_supplier_4,$data->incoming_supplier_5,$data->incoming_supplier_6,$data->incoming_supplier_7,$data->incoming_supplier_8,$data->incoming_supplier_9,$data->incoming_supplier_10,$data->incoming_supplier_11,$data->incoming_supplier_12,$data->incoming_supplier_1,$data->incoming_supplier_2,$data->incoming_supplier_3];
      $grs = [$data->gr_aisin_4,$data->gr_aisin_5,$data->gr_aisin_6,$data->gr_aisin_7,$data->gr_aisin_8,$data->gr_aisin_9,$data->gr_aisin_10,$data->gr_aisin_11,$data->gr_aisin_12,$data->gr_aisin_1,$data->gr_aisin_2,$data->gr_aisin_3];
      $balances = [$stok1];
                        
  @endphp
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
                <table id="" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Supplier</th>
                    <th>P/N Before</th>
                    <th>P/N After</th>
                    <th>Part Name</th>
                    <th>Shortage</th>
                                        
                  </tr>
                  </thead>
                  <tbody>

                  <tr class="bg-default">
                    <td>{{$data->id_stock}}</td>
                    <td>{{$data->supplier}}</td>
                    <td>{{$data->pn_before}}</td>
                    <td>{{$data->pn_after}}</td>
                    <td>{{$data->part_name}}</td>
                    <td>@php
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
                                        
                  </tr>                  
                  
                  </tbody>                  
                </table>
                <hr>
                <table id="" class="table table-bordered table-striped">
                  <thead>
                    <tr bgcolor="green" style="font-weight: bold">
                      <th>Bulan</th>  
                      <td>Apr</td>
                      <td>May</td>
                      <td>Jun</td>
                      <td>Jul</td>
                      <td>Aug</td>
                      <td>Sep</td>
                      <td>Oct</td>
                      <td>Nov</td>
                      <td>Dec</td>
                      <td>Jan</td>
                      <td>Feb</td>
                      <td>Mar</td>                                      
                    </tr>
                    <tr>
                      @php
                        $stok1=$data->stock;
                        $forecast1=$data->fc_4;
                        $incoming1=$data->incoming_supplier_4;
                        $gr1=$data->gr_aisin_4;
                        $balance1=$stok1+$incoming1-$forecast1;

                        $forecast2=$data->fc_5;
                        $incoming2=$data->incoming_supplier_5;
                        $gr2=$data->gr_aisin_5;
                        $balance2=$balance1+$incoming2-$forecast2;
                        
                        $forecast3=$data->fc_6;
                        $incoming3=$data->incoming_supplier_6;
                        $gr3=$data->gr_aisin_6;
                        $balance3=$balance2+$incoming3-$forecast3;
                        
                        $forecast4=$data->fc_7;
                        $incoming4=$data->incoming_supplier_7;
                        $gr4=$data->gr_aisin_7;
                        $balance4=$balance3+$incoming4-$forecast4;
                        
                        $forecast5=$data->fc_8;
                        $incoming5=$data->incoming_supplier_8;
                        $gr5=$data->gr_aisin_8;
                        $balance5=$balance4+$incoming5-$forecast5;
                        
                        $forecast6=$data->fc_9;
                        $incoming6=$data->incoming_supplier_9;
                        $gr6=$data->gr_aisin_9;
                        $balance6=$balance5+$incoming6-$forecast6;
                        
                        $forecast7=$data->fc_10;
                        $incoming7=$data->incoming_supplier_10;
                        $gr7=$data->gr_aisin_10;
                        $balance7=$balance6+$incoming7-$forecast7;
                        
                        $forecast8=$data->fc_11;
                        $incoming8=$data->incoming_supplier_11;
                        $gr8=$data->gr_aisin_11;
                        $balance8=$balance7+$incoming8-$forecast8;
                        
                        $forecast9=$data->fc_12;
                        $incoming9=$data->incoming_supplier_12;
                        $gr9=$data->gr_aisin_12;
                        $balance9=$balance8+$incoming9-$forecast9;
                        
                        $forecast10=$data->fc_1;
                        $incoming10=$data->incoming_supplier_1;
                        $gr10=$data->gr_aisin_1;
                        $balance10=$balance9+$incoming10-$forecast10;
                        
                        $forecast11=$data->fc_2;
                        $incoming11=$data->incoming_supplier_2;
                        $gr11=$data->gr_aisin_2;
                        $balance11=$balance10+$incoming11-$forecast11;
                        
                        $forecast12=$data->fc_3;
                        $incoming12=$data->incoming_supplier_3;
                        $gr12=$data->gr_aisin_3;
                        $balance12=$balance11+$incoming12-$forecast12;

                      @endphp
                      
                    <th>Stock</th>  
                    <td>{{$stok1}}</td>
                    <td>{{$balance1}}</td>
                    <td>{{$balance2}}</td>
                    <td>{{$balance3}}</td>
                    <td>{{$balance4}}</td>
                    <td>{{$balance5}}</td>
                    <td>{{$balance6}}</td>
                    <td>{{$balance7}}</td>
                    <td>{{$balance8}}</td>
                    <td>{{$balance9}}</td>
                    <td>{{$balance10}}</td>
                    <td>{{$balance11}}</td>                                      
                  </tr>
                  <tr>
                    <th>Forecast</th>  
                    <td>{{$forecast1}}</td>
                    <td>{{$forecast2}}</td>
                    <td>{{$forecast3}}</td>
                    <td>{{$forecast4}}</td>
                    <td>{{$forecast5}}</td>
                    <td>{{$forecast6}}</td>
                    <td>{{$forecast7}}</td>
                    <td>{{$forecast8}}</td>
                    <td>{{$forecast9}}</td>
                    <td>{{$forecast10}}</td>
                    <td>{{$forecast11}}</td>
                    <td>{{$forecast12}}</td>
                  </tr>
                  <tr>
                    <th>Incoming Supplier</th>
                    <td>{{$incoming1}}</td>
                    <td>{{$incoming2}}</td>
                    <td>{{$incoming3}}</td>
                    <td>{{$incoming4}}</td>
                    <td>{{$incoming5}}</td>
                    <td>{{$incoming6}}</td>
                    <td>{{$incoming7}}</td>
                    <td>{{$incoming8}}</td>
                    <td>{{$incoming9}}</td>
                    <td>{{$incoming10}}</td>
                    <td>{{$incoming11}}</td>
                    <td>{{$incoming12}}</td>                     
                  </tr>
                  <tr>
                    <th>GR Aisin</th>
                    <td>{{$gr1}}</td>
                    <td>{{$gr2}}</td>
                    <td>{{$gr3}}</td>
                    <td>{{$gr4}}</td>
                    <td>{{$gr5}}</td>
                    <td>{{$gr6}}</td>
                    <td>{{$gr7}}</td>
                    <td>{{$gr8}}</td>
                    <td>{{$gr9}}</td>
                    <td>{{$gr10}}</td>
                    <td>{{$gr11}}</td>
                    <td>{{$gr12}}</td> 
                  </tr>
                  <tr>
                    <th>Balance</th>
                    <td>{{$balance1}}</td>
                    <td>{{$balance2}}</td>
                    <td>{{$balance3}}</td>
                    <td>{{$balance4}}</td>
                    <td>{{$balance5}}</td>
                    <td>{{$balance6}}</td>
                    <td>{{$balance7}}</td>
                    <td>{{$balance8}}</td>
                    <td>{{$balance9}}</td>
                    <td>{{$balance10}}</td>
                    <td>{{$balance11}}</td>
                    <td>{{$balance12}}</td> 
                  </tr>
                  </thead>
                  <tbody>
                  
                  </tbody>                  
                </table>
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