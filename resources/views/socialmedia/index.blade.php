@extends('admin_master')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">All Social Media</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">All Social Media</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">All  Social Media</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <a href="{{route('socialmedia.create')}}" class="btn btn-primary add-new mb-2">Add New Social Media</a>
                <div class="fetch-data table-responsive">
                    <table id="socialmedia-table" class="table table-bordered table-striped data-table">
                        <thead>
                            <tr>
                                <th>Social Media Name</th>
                                <th>Social Media URL</th>
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