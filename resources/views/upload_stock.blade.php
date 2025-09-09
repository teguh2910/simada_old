@extends('layouts.app')


@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Upload Stock</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Upload Stock</li>
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
          <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Form Upload Stock</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{asset('upload_stock')}}" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}
                <div class="card-body">                  
                  <div class="form-group">
                    <label>Stock (first Time)</label>
                    <input type="file" name="stock" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Forecast</label>
                    <input type="file" name="data_fc" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Incoming Supplier</label>
                    <input type="file" name="incoming_supplier" class="form-control">
                  </div>                  
                  <div class="form-group">
                    <label>GR Aisin</label>
                    <input type="file" name="gr_aisin" class="form-control">
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Upload</button>
                </div>
              </form>
            </div>
          </div>
            <!-- /.col-md-12 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  
@endsection