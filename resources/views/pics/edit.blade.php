@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit PIC</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('pics.index') }}">PICs</a></li>
                        <li class="breadcrumb-item active">Edit</li>
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
                            <h3 class="card-title">Edit PIC: {{ $pic->name }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{ route('pics.update', $pic->id) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}

                                <div class="form-group">
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('name')) is-invalid @endif"
                                        id="name" name="name" value="{{ old('name', $pic->name) }}" required>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email"
                                        class="form-control @if ($errors->has('email')) is-invalid @endif"
                                        id="email" name="email" value="{{ old('email', $pic->email) }}">
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('phone')) is-invalid @endif"
                                        id="phone" name="phone" value="{{ old('phone', $pic->phone) }}">
                                    @if ($errors->has('phone'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="position">Position</label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('position')) is-invalid @endif"
                                        id="position" name="position" value="{{ old('position', $pic->position) }}">
                                    @if ($errors->has('position'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('position') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="department">Department</label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('department')) is-invalid @endif"
                                        id="department" name="department"
                                        value="{{ old('department', $pic->department) }}">
                                    @if ($errors->has('department'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('department') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="is_active" name="is_active"
                                            value="1" {{ old('is_active', $pic->is_active) ? 'checked' : '' }}>
                                        <label for="is_active" class="custom-control-label">
                                            Active
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Update PIC
                                    </button>
                                    <a href="{{ route('pics.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-times"></i> Cancel
                                    </a>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
