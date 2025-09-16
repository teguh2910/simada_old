@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">User Management</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">All Users</h3>
                            <div class="card-tools">
                                <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> Add New User
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if (isset($users) && count($users) > 0)
                                <div class="table-responsive">
                                    <table id="users-table" class="table table-bordered table-striped table-hover">
                                        <thead class="thead-light">
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Department</th>
                                                <th>NPK</th>
                                                <th>Jabatan</th>
                                                <th>Created At</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $index => $user)
                                                <tr>
                                                    <td class="text-center">{{ $index + 1 }}</td>
                                                    <td>
                                                        <strong>{{ $user->name }}</strong>
                                                        @if ($user->id === Auth::id())
                                                            <small class="badge badge-info">You</small>
                                                        @endif
                                                    </td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->dept ?: '<span class="text-muted">-</span>' }}</td>
                                                    <td>{{ $user->npk ?: '<span class="text-muted">-</span>' }}</td>
                                                    <td>
                                                        @if ($user->jabatan)
                                                            @if ($user->jabatan == 'manager')
                                                                <span
                                                                    class="badge badge-success">{{ ucfirst($user->jabatan) }}</span>
                                                            @elseif($user->jabatan == 'supervisor')
                                                                <span
                                                                    class="badge badge-warning">{{ ucfirst($user->jabatan) }}</span>
                                                            @elseif($user->jabatan == 'staff')
                                                                <span
                                                                    class="badge badge-primary">{{ ucfirst($user->jabatan) }}</span>
                                                            @else
                                                                <span
                                                                    class="badge badge-secondary">{{ ucfirst($user->jabatan) }}</span>
                                                            @endif
                                                        @else
                                                            <span class="text-muted">-</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $user->created_at->format('M d, Y') }}</td>
                                                    <td class="text-center">
                                                        <div class="btn-group btn-group-sm">
                                                            <a href="{{ route('users.show', $user->id) }}"
                                                                class="btn btn-info" title="View User">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                            <a href="{{ route('users.edit', $user->id) }}"
                                                                class="btn btn-warning" title="Edit User">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            @if ($user->id !== Auth::id())
                                                                <form action="{{ route('users.destroy', $user->id) }}"
                                                                    method="POST" style="display: inline;">
                                                                    {{ csrf_field() }}
                                                                    {{ method_field('DELETE') }}
                                                                    <button type="submit" class="btn btn-danger"
                                                                        onclick="return confirm('Are you sure you want to delete this user?')"
                                                                        title="Delete User">
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                </form>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <p class="text-muted">No users found.</p>
                                    <a href="{{ route('users.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> Add First User
                                    </a>
                                </div>
                            @endif
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

@section('js')
    <script>
        $(function() {
            $("#users-table").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "pageLength": 10,
                "lengthMenu": [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, "All"]
                ],
                "order": [
                    [1, "asc"]
                ], // Sort by Name column by default
                "columnDefs": [{
                        "orderable": false,
                        "targets": [0, 7]
                    }, // Disable sorting on # and Actions columns
                    {
                        "className": "text-center",
                        "targets": [0, 7]
                    } // Center align # and Actions columns
                ],
                "language": {
                    "search": "Search users:",
                    "lengthMenu": "Show _MENU_ users per page",
                    "info": "Showing _START_ to _END_ of _TOTAL_ users",
                    "infoEmpty": "No users found",
                    "infoFiltered": "(filtered from _MAX_ total users)",
                    "emptyTable": "No users available in table",
                    "zeroRecords": "No matching users found",
                    "paginate": {
                        "first": "First",
                        "last": "Last",
                        "next": "Next",
                        "previous": "Previous"
                    }
                },
                "dom": '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
                    '<"row"<"col-sm-12"tr>>' +
                    '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
                "initComplete": function() {
                    // Add custom styling to the DataTable wrapper
                    $('.dataTables_wrapper').addClass('table-responsive');
                    $('.dataTables_length select').addClass('form-control form-control-sm');
                    $('.dataTables_filter input').addClass('form-control form-control-sm');
                }
            });

            // Initialize tooltips
            $('[title]').tooltip();
        });
    </script>
@endsection
