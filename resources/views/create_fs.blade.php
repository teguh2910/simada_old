@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add Feasibility Study</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('fs.index') }}">List Feasibility Study</a></li>
                        <li class="breadcrumb-item active">Add Feasibility Study</li>
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
                            <h3 class="card-title">Feasibility Study Form</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{ route('fs.store') }}" method="POST">
                                {{ csrf_field() }}

                                <!-- Project Title -->
                                <div class="form-group">
                                    <label for="project_title">Project Title</label>
                                    <input type="text" class="form-control" id="project_title" name="project_title"
                                        required placeholder="Enter project title">
                                </div>

                                <!-- Description -->
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="4" required
                                        placeholder="Describe the project and its objectives"></textarea>
                                </div>

                                <div class="row">
                                    <!-- Estimated Cost -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="estimated_cost">Estimated Cost (Rp)</label>
                                            <input type="number" class="form-control" id="estimated_cost"
                                                name="estimated_cost" required placeholder="0.00" step="0.01"
                                                min="0">
                                        </div>
                                    </div>

                                    <!-- Timeline -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="timeline_months">Timeline (Months)</label>
                                            <input type="number" class="form-control" id="timeline_months"
                                                name="timeline_months" required placeholder="Enter timeline in months"
                                                min="1">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Risk Level -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="risk_level">Risk Level</label>
                                            <select class="form-control" id="risk_level" name="risk_level" required>
                                                <option value="">Select Risk Level</option>
                                                <option value="Low">Low</option>
                                                <option value="Medium">Medium</option>
                                                <option value="High">High</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Status -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select class="form-control" id="status" name="status" required>
                                                <option value="">Select Status</option>
                                                <option value="Pending">Pending</option>
                                                <option value="In Progress">In Progress</option>
                                                <option value="Completed">Completed</option>
                                                <option value="Cancelled">Cancelled</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Assigned To -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="assigned_to">Assigned To</label>
                                            <select class="form-control select2" id="assigned_to" name="assigned_to"
                                                required style="width: 100%;">
                                                <option value="">Select Person</option>
                                                <option value="John Doe">John Doe</option>
                                                <option value="Jane Smith">Jane Smith</option>
                                                <option value="Bob Johnson">Bob Johnson</option>
                                                <option value="Alice Brown">Alice Brown</option>
                                                <option value="Charlie Wilson">Charlie Wilson</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Due Date -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="due_date">Due Date</label>
                                            <input type="date" class="form-control" id="due_date" name="due_date"
                                                required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Project Type -->
                                <div class="form-group">
                                    <label for="project_type">Project Type</label>
                                    <select class="form-control" id="project_type" name="project_type" required>
                                        <option value="">Select Project Type</option>
                                        <option value="New Product Development">New Product Development</option>
                                        <option value="Process Improvement">Process Improvement</option>
                                        <option value="Cost Reduction">Cost Reduction</option>
                                        <option value="Quality Enhancement">Quality Enhancement</option>
                                        <option value="Technology Upgrade">Technology Upgrade</option>
                                        <option value="Market Expansion">Market Expansion</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>

                                <!-- Additional Notes -->
                                <div class="form-group">
                                    <label for="notes">Additional Notes (Optional)</label>
                                    <textarea class="form-control" id="notes" name="notes" rows="3"
                                        placeholder="Any additional notes or requirements"></textarea>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Create Feasibility Study</button>
                                    <a href="{{ route('fs.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
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

@section('js')
    <script>
        $(document).ready(function() {
            // Initialize Select2 for assigned_to
            $('#assigned_to').select2({
                theme: 'bootstrap4',
                placeholder: 'Select person...',
                allowClear: true,
                width: '100%'
            });

            // Set minimum due date to tomorrow
            var tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 1);
            var tomorrowStr = tomorrow.toISOString().split('T')[0];
            $('#due_date').attr('min', tomorrowStr);
        });
    </script>
@endsection
