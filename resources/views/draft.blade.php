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
            <h1 class="m-0">List Draft Document</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">List Draft Document</li>
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
                    <th>Project Name</th>
                    <th>Supplier</th>
                    <th>Part Number</th>
                    <th>Document Of</th>
                    <th>Due Date</th>
                    <th>List Document</th>
                    <th>PIC</th>
                    <th>Revise</th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($data as $row)
                  <tr class="bg-default">
                    <td>{{$row->project}}</td>
                    <td>{{$row->supplier}}</td>
                    <td>{{$row->part_number}}</td>
                    <td>{{$row->kinds_doc}}</td>
                    <td>{{$row->due_date}}</td>
                    <td>{{$row->documents}}</td>
                    <td>{{$row->pic}}</td>
                    <td>{{$row->revise}}</td>
                    <td>
                        <a href="feedback/{{$row->id_transaction}}" class="btn btn-xs btn-success">Feedback</a>
                        <a href="viewfeedback/{{$row->id_transaction}}" class="btn btn-xs btn-info">View Feedback</a>
                        <a href="{{asset('storage/'.$row->file)}}" class="btn btn-xs btn-success">View Doc</a>
                        @if(\auth::user()->dept=='MIM'||\auth::user()->dept=='NPL')
                        <a href="revise/{{$row->id_transaction}}" class="btn btn-xs btn-warning">Revise</a>
                        <a href="final/{{$row->id_transaction}}" class="btn btn-xs btn-primary">Final</a>
                        <a href="del/{{$row->id_transaction}}" onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-xs btn-danger">Del</a>
                        @else
                        <a href="feedback/{{$row->id_transaction}}"  class="btn btn-xs btn-primary">Add Feedback</a>
                        @endif
                        
                    </td>
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