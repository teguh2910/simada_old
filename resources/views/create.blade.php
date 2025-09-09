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
            <h1 class="m-0">Create Data</h1>            
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Create Data</li>
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
                <h3 class="card-title">Form Create Data</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{asset('create')}}" method="POST">
              {{ csrf_field() }}
                <div class="card-body">
                  <div class="form-group">
                    <label>Nama Project</label>
                    <input type="text" name="project" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Document Of</label>
                    <select name="kind_doc" id="" class="form-control">
                      <option value="SPTT-1">SPTT-1</option>
                      <option value="SPTT-2">SPTT-2</option>
                      <option value="SPTT-3">SPTT-3</option>  
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Part Number</label>
                    <input type="text" name="part_number" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Supplier</label>
                    <input type="text" name="supplier" class="form-control">
                  </div>                  
                  <div class="form-group">
                    <label>Due Date</label>
                    <input type="date" name="due_date" class="form-control">
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Create</button>
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