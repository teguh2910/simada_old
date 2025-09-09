@extends('layouts.app')


@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Revise Document</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Revise Document</li>
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
                <h3 class="card-title">Form Revise Document</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{asset('revise/'.$id)}}" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}
                <div class="card-body">                  
                    <div class="form-group">
                        <label>Project</label>
                        <select name="project" id="" class="form-control">
                          @foreach($doc as $row)  
                          <option value="{{$row->project}}">{{$row->project}}</option> 
                          @endforeach                 
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Due Date</label>
                        <input type='date' value="{{$row->due_date}}" name="due_date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Supplier</label>
                        <select name="supplier" id="" class="form-control">
                          @foreach($doc as $row)  
                          <option value="{{$row->supplier}}">{{$row->supplier}}</option> 
                          @endforeach                 
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Part Number</label>
                        <select name="part_number" id="" class="form-control">
                          @foreach($doc as $row)  
                          <option value="{{$row->part_number}}">{{$row->part_number}}</option> 
                          @endforeach                 
                        </select>
                    </div>
                    <input type="hidden" name='id_document' value="{{$row->id}}">
                    <div class="form-group">
                    <label>Document Of</label>
                    <select name="kinds_doc" id="" class="form-control">
                      @foreach($doc as $row)  
                      <option value="{{$row->kinds_doc}}">{{$row->kinds_doc}}</option> 
                      @endforeach                 
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Document</label>
                    <select name="doc_file" id="" class="form-control">                                           
                      @foreach($doc as $row)  
                      <option value="{{$row->documents}}">{{$row->documents}}</option> 
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Document</label>
                    <input type="file" name="file" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Status Revise</label>                    
                    <select name="revise" id="" class="form-control">
                      <option value="1">R-1</option>
                      <option value="2">R-2</option>
                      <option value="3">R-3</option>
                      <option value="4">R-4</option>
                      <option value="5">R-5</option>
                      <option value="6">R-6</option>
                      <option value="7">R-7</option>
                      <option value="8">R-8</option>
                      <option value="9">R-9</option>
                      <option value="10">R-10</option>
                      <option value="11">R-11</option>
                      <option value="12">R-12</option>                                        
                    </select>
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