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
            <h1 class="m-0">Dashboard SPTT</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
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
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                  <div class="inner">
                    <h3>{{$outs}}</h3>
    
                    <p>Outstanding</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-file"></i>
                  </div>
                  <a href="{{asset('/')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3>{{$draft}}</h3>
    
                    <p>Draft</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-file"></i>
                  </div>
                  <a href="{{asset('/draft')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3>{{$final}}</h3>
    
                    <p>Final</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-file"></i>
                  </div>
                  <a href="{{asset('/final')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                  <div class="inner">
                    <h3>{{$overd}}</h3>

                    <p>OverDueDate</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-file"></i>
                  </div>
                  <a href="{{asset('/overdue')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
        </div>

        <!-- PCR Dashboard Section -->
        <div class="row mt-4">
          <div class="col-12">
            <h3 class="mb-3">PCR Dashboard</h3>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>{{$pcrTotal}}</h3>
                <p>Total PCR</p>
              </div>
              <div class="icon">
                <i class="fas fa-list"></i>
              </div>
              <a href="{{asset('/list-pcr')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$pcrFinish}}</h3>
                <p>Finish</p>
              </div>
              <div class="icon">
                <i class="fas fa-check"></i>
              </div>
              <a href="{{asset('/list-pcr')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3>{{$pcrCancel}}</h3>
                <p>Cancel</p>
              </div>
              <div class="icon">
                <i class="fas fa-times"></i>
              </div>
              <a href="{{asset('/list-pcr')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$pcrOnHold}}</h3>
                <p>On Hold</p>
              </div>
              <div class="icon">
                <i class="fas fa-pause"></i>
              </div>
              <a href="{{asset('/list-pending-pcr')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$pcrStage0}}</h3>
                <p>Stage 0 Progress</p>
              </div>
              <div class="icon">
                <i class="fas fa-play"></i>
              </div>
              <a href="{{asset('/list-pending-pcr')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>{{$pcrStage1}}</h3>
                <p>Stage 1 Progress</p>
              </div>
              <div class="icon">
                <i class="fas fa-forward"></i>
              </div>
              <a href="{{asset('/list-pending-pcr')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$pcrStage2}}</h3>
                <p>Stage 2 Progress</p>
              </div>
              <div class="icon">
                <i class="fas fa-fast-forward"></i>
              </div>
              <a href="{{asset('/list-pending-pcr')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-dark">
              <div class="inner">
                <h3>{{$pcrStage3}}</h3>
                <p>Stage 3 Progress</p>
              </div>
              <div class="icon">
                <i class="fas fa-step-forward"></i>
              </div>
              <a href="{{asset('/list-pending-pcr')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  
@endsection