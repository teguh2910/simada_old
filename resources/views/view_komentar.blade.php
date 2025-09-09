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
            <h1 class="m-0">List Komentar</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">List Komentar</li>
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
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Komentar</th> 
                    <th>Document Of</th>
                    <th>Document Name</th>
                    <th>Status Revise</th>  
                    <th>PIC</th>
                    <th>NPK</th>
                    <th>Dept</th>                 
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($data as $row)
                  <tr class="bg-default">                    
                    <td>{{$row->komentar}}</td>
                    <td>{{$row->kinds_doc}}</td>
                    <td>{{$row->documents}}</td>
                    <td>{{$row->revise}}</td>
                    <td>{{$row->pic_k}}</td>
                    <td>{{$row->npk_k}}</td>
                    <td>{{$row->dep_k}}</td>                                        
                  </tr>
                  @endforeach
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