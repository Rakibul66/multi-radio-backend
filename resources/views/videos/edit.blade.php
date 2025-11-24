@extends('admin_master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Video</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{URL::to('/videos')}}">All Video
                                </a></li>
                        <li class="breadcrumb-item active">Edit Video</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Edit Video</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{route('videos.update',$video->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="card-body">
                    <div class="row"> 

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="title">Title <span class="required">*</span></label>
                                <input type="text" name="title" class="form-control" id="title"
                                    placeholder="Title" required="" value="{{old('title',$video->title)}}">
                                @error('title')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="category_id">Select Category <span class="required">*</span></label>
                                <select class="form-control select2bs4" name="category_id" id="category_id" required>
                                    <option value="" selected="" disabled="">Select Category</option>
                                    @foreach(categories() as $category)
                                     <option value="{{$category->id}}" <?php if($video->category_id == $category->id){echo "selected";} ?>>{{$category->category_name}}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="video_url">Youtube Video URL <span class="required">*</span></label>
                                <input type="url" name="video_url" class="form-control" id="video_url"
                                    placeholder="Youtube Video URL" required="" value="{{old('video_url',$video->video_url)}}">
                                @error('video_url')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="is_top">Is top <span class="required">*</span></label>
                                <select class="form-control select2bs4" name="is_top" id="is_top" required="">
                                    <option value="" selected="" disabled="">Choose Option</option>
                                    <option value="Yes" <?php if($video->is_top == 'Yes'){echo "selected";} ?>>Yes</option>
                                    <option value="No" <?php if($video->is_top == 'No'){echo "selected";} ?>>No</option>
                                </select>
                                @error('is_top')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="status">Select Status <span class="required">*</span></label>
                                <select class="form-control select2bs4" name="status" id="status" required="">
                                    <option value="" selected="" disabled="">Select Status</option>
                                    <option value="Active" <?php if($video->status == 'Active'){echo "selected";} ?>>Active</option>
                                    <option value="Inactive" <?php if($video->status == 'Inactive'){echo "selected";} ?>>Inactive</option>
                                </select>
                                @error('status')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                          <div class="form-group">
                          	<label for="description">Description</label>
                          	<textarea name="description" id="description">{!!old('description',$video->description)!!}</textarea>
                          	@error('description')
                                <span class="alert alert-danger">{{ $message }}</span>
                            @enderror
                          </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input name="image" type="file" id="image" accept="image/*" class="dropify" data-height="150" data-default-file="{{URL::to($video->image)}}"/>
                                @error('image')
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