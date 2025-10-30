@extends('admin_master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Music</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{URL::to('/musics')}}">All Music
                                </a></li>
                        <li class="breadcrumb-item active">Edit Music</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit Music</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{route('musics.update',$music->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="card-body">
                    <div class="row"> 

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="title">Title <span class="required">*</span></label>
                                <input type="text" name="title" class="form-control" id="title"
                                    placeholder="Title" required="" value="{{old('title',$music->title)}}">
                                @error('title')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="status">Select Status <span class="required">*</span></label>
                                <select class="form-control select2bs4" name="status" id="status" required="">
                                    <option value="" selected="" disabled="">Select Status</option>
                                    <option value="Active" <?php if($music->status == 'Active'){echo "selected";} ?>>Active</option>
                                    <option value="Inactive" <?php if($music->status == 'Inactive'){echo "selected";} ?>>Inactive</option>
                                </select>
                                @error('status')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                          <div class="form-group">
                          	<label for="description">Description</label>
                          	<textarea name="description" id="description">{!!old('description',$music->description)!!}</textarea>
                          	@error('description')
                                <span class="alert alert-danger">{{ $message }}</span>
                            @enderror
                          </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input name="image" type="file" id="image" accept="image/*" class="dropify" data-height="150" data-height="200" data-default-file="{{URL::to($music->image)}}"/>
                                @error('image')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="file">Audo File <span class="required">*</span></label>
                                <input name="file" class="dropify" data-height="150" type="file" id="file" data-height="200" data-default-file="{{URL::to($music->file)}}" />
                                @error('file')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group w-100 px-2">
                            <button type="submit" class="btn btn-success">Save Changes</button>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </form>
        </div>
    </section>
</div>
@endsection