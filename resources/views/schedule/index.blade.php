@extends('admin_master')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">All Schedules</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">All Schedules</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">All Schedules</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <a href="{{route('schedule.create')}}" class="btn btn-primary add-new mb-2">Add New Schedule</a>
                <div class="fetch-data table-responsive">
                    <table id="schedule-table" class="table table-bordered table-striped data-table">
                        <thead>
                            <tr>
                                <th>Schedule Name</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="conts"> 
                        </tbody>
                    </table>  
                </div>
         
            </div>
        </div>
    </section>
</div>
@endsection