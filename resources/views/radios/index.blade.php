@extends('admin_master')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">All Radio</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">All Radio</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">All Radio</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <a href="{{route('radios.create')}}" class="btn btn-primary add-new mb-2">Add New Radio</a><br><br>

                <div class="card w-100">
                  <div class="card-header">
                    <h5>Filter Radio</h5>
                  </div>

                  <div class="card-body">
                     <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <select class="form-control select2bs4" id="selected_category_id">
                           <option value="" selected="" disabled="">Select Category</option>
                           @foreach(categories() as $category)
                           <option value="{{$category->id}}">{{$category->category_name}}</option>
                           @endforeach
                          </select>
                        </div>
                        
                      </div>


                      <div class="col-md-4">
                        <div class="form-group">
                          <select class="form-control select2bs4" id="selected_country_id">
                           <option value="" selected="" disabled="">Select Country</option>
                           @foreach(countries() as $country)
                           <option value="{{$country->id}}">{{$country->country_name}}</option>
                           @endforeach
                          </select>
                        </div>
                        
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">

                          <select class="form-control select2bs4" id="selected_radio_status">
                           <option value="" selected="" disabled="">Select Status</option>
                           <option value="Active">Active</option>
                           <option value="Inactive">Inactive</option>
                          </select>
                        </div>
                        
                      </div>

                      <div class="col-md-12 d-flex justify-content-center button-product-filters">

                        <button type="button" class="btn btn-primary filter-radio"><i class="fa fa-search"></i> SEARCH</button>

                        <button type="button" class="btn btn-danger reset-filter">RESET</button>
                     </div> 

                     </div>
                  </div>
                </div>

                <div class="fetch-data table-responsive">
                    <table id="radio-table" class="table table-bordered table-striped data-table">
                        <thead>
                            <tr>
                                <th>Radio Name</th>
                                <th>Category</th>
                                <th>Country</th>
                                <th>Status</th>
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