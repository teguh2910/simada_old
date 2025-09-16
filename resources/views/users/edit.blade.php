@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit User</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
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
                <div class="col-md-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">User Information</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('users.update', $user->id) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="card-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="list-unstyled">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="form-group">
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ old('name', $user->name) }}" placeholder="Enter full name" required>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ old('email', $user->email) }}" placeholder="Enter email address" required>
                                </div>

                                <div class="form-group">
                                    <label for="password">New Password (leave blank to keep current)</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Enter new password">
                                </div>

                                <div class="form-group">
                                    <label for="password_confirmation">Confirm New Password</label>
                                    <input type="password" class="form-control" id="password_confirmation"
                                        name="password_confirmation" placeholder="Confirm new password">
                                </div>

                                <div class="form-group">
                                    <label for="dept">Department</label>
                                    <input type="text" class="form-control" id="dept" name="dept"
                                        value="{{ old('dept', $user->dept) }}" placeholder="Enter department">
                                </div>

                                <div class="form-group">
                                    <label for="npk">NPK</label>
                                    <input type="text" class="form-control" id="npk" name="npk"
                                        value="{{ old('npk', $user->npk) }}" placeholder="Enter NPK">
                                </div>

                                <div class="form-group">
                                    <label for="jabatan">Jabatan (Position)</label>
                                    <select class="form-control" id="jabatan" name="jabatan">
                                        <option value="">Select Position</option>
                                        <option value="manager"
                                            {{ old('jabatan', $user->jabatan) == 'manager' ? 'selected' : '' }}>Manager
                                        </option>
                                        <option value="supervisor"
                                            {{ old('jabatan', $user->jabatan) == 'supervisor' ? 'selected' : '' }}>
                                            Supervisor</option>
                                        <option value="staff"
                                            {{ old('jabatan', $user->jabatan) == 'staff' ? 'selected' : '' }}>Staff
                                        </option>
                                        <option value="intern"
                                            {{ old('jabatan', $user->jabatan) == 'intern' ? 'selected' : '' }}>Intern
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update User</button>
                                <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
