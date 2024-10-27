@extends('admin_master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Radio</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{URL::to('/radios')}}">All Radio
                                </a></li>
                        <li class="breadcrumb-item active">Edit Radio</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit Radio</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{route('radios.update',$radio->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="card-body">
                    <div class="row"> 

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="radio_name">Radio Name <span class="required">*</span></label>
                                <input type="text" name="radio_name" class="form-control" id="radio_name"
                                    placeholder="Radio Name" required="" value="{{old('radio_name',$radio->radio_name)}}">
                                @error('radio_name')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="category_id">Select Category <span class="required">*</span></label>
                                <select class="form-control select2bs4" name="category_id" required="">
                                   <option value="" selected="" disabled="">Select Category</option>
                                   @foreach(categories() as $category)
                                    <option value="{{$category->id}}" <?php if($radio->category_id == $category->id){echo "selected";} ?>>{{$category->category_name}}</option>
                                   @endforeach
                                </select>
                                @error('category_id')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="country_id">Select Country <span class="required">*</span></label>
                                <select class="form-control select2bs4" name="country_id" required="">
                                   <option value="" selected="" disabled="">Select Country</option>
                                   @foreach(countries() as $country)
                                    <option value="{{$country->id}}" <?php if($radio->country_id == $country->id){echo "selected";} ?>>{{$country->country_name}}</option>
                                   @endforeach
                                </select>
                                @error('country_id')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="radio_url">Radio URL <span class="required">*</span></label>
                                <input type="url" name="radio_url" class="form-control" id="radio_url"
                                    placeholder="Radio URL" required="" value="{{old('radio_url',$radio->radio_url)}}">
                                @error('radio_url')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Select Status <span class="required">*</span></label>
                                <select class="form-control select2bs4" name="status" id="status" required="">
                                    <option value="" selected="" disabled="">Select Status</option>
                                    <option value="Active" <?php if($radio->status == 'Active'){echo "selected";} ?>>Active</option>
                                    <option value="Inactive" <?php if($radio->status == 'Inactive'){echo "selected";} ?>>Inactive</option>
                                </select>
                                @error('status')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                          <div class="form-group">
                          	<label for="description">Description</label>
                          	<textarea name="description" id="description">{!!old('description',$radio->description)!!}</textarea>
                          </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="image">Image <span class="required">*</span></label>
                                <input name="image" type="file" id="image" accept="image/*" class="dropify" data-height="150" data-default-file="{{URL::to($radio->image)}}" />
                                @error('image')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror 
                            </div>
                        </div>
                        
                        <div class="form-group w-100 px-2">
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </form>
        </div>
    </section>
</div>
@endsection