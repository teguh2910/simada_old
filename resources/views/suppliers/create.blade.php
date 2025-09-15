@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create Supplier</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('suppliers.index') }}">List Suppliers</a></li>
                        <li class="breadcrumb-item active">Create Supplier</li>
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
                            <h3 class="card-title">Create New Supplier</h3>
                        </div>
                        <!-- /.card-header -->
                        <form action="{{ route('suppliers.store') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="card-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Supplier Name <span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control @if ($errors->has('name')) is-invalid @endif"
                                                id="name" name="name" value="{{ old('name') }}" required>
                                            @if ($errors->has('name'))
                                                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="customer_id">Customer</label>
                                            <select class="form-control @if ($errors->has('customer_id')) is-invalid @endif"
                                                id="customer_id" name="customer_id">
                                                <option value="">Select Customer (Optional)</option>
                                                @if (isset($customers))
                                                    @foreach ($customers as $customer)
                                                        <option value="{{ $customer->id }}"
                                                            {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                                            {{ $customer->name }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @if ($errors->has('customer_id'))
                                                <div class="invalid-feedback">{{ $errors->first('customer_id') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="no_hp">Phone Number (HP)</label>
                                            <input type="text"
                                                class="form-control @if ($errors->has('no_hp')) is-invalid @endif"
                                                id="no_hp" name="no_hp" value="{{ old('no_hp') }}">
                                            @if ($errors->has('no_hp'))
                                                <div class="invalid-feedback">{{ $errors->first('no_hp') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email"
                                                class="form-control @if ($errors->has('email')) is-invalid @endif"
                                                id="email" name="email" value="{{ old('email') }}">
                                            @if ($errors->has('email'))
                                                <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="presdir">President Director</label>
                                            <input type="text"
                                                class="form-control @if ($errors->has('presdir')) is-invalid @endif"
                                                id="presdir" name="presdir" value="{{ old('presdir') }}">
                                            @if ($errors->has('presdir'))
                                                <div class="invalid-feedback">{{ $errors->first('presdir') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="no_telp">Telephone Number</label>
                                            <input type="text"
                                                class="form-control @if ($errors->has('no_telp')) is-invalid @endif"
                                                id="no_telp" name="no_telp" value="{{ old('no_telp') }}">
                                            @if ($errors->has('no_telp'))
                                                <div class="invalid-feedback">{{ $errors->first('no_telp') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="is_active">Status</label>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="is_active"
                                                    name="is_active" value="1"
                                                    {{ old('is_active', true) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="is_active">
                                                    Active
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="alamat">Address</label>
                                            <textarea class="form-control @if ($errors->has('alamat')) is-invalid @endif" id="alamat" name="alamat"
                                                rows="3">{{ old('alamat') }}</textarea>
                                            @if ($errors->has('alamat'))
                                                <div class="invalid-feedback">{{ $errors->first('alamat') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Create Supplier</button>
                                <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
