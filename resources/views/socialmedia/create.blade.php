@extends('admin_master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add Social Media</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{URL::to('/socialmedia')}}">All Countries
                                </a></li>
                        <li class="breadcrumb-item active">Add Social Media</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Add Social Media</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{route('socialmedia.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="social_media_name">Social Media Name <span class="required">*</span></label>
                                <input type="text" name="social_media_name" class="form-control" id="social_media_name"
                                    placeholder="Country Name" required="" value="{{old('social_media_name')}}">
                                @error('social_media_name')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="social_media_url">Social Media Url <span class="required">*</span></label>
                                <input type="text" name="social_media_url" class="form-control" id="social_media_url"
                                    placeholder="Country Name" required="" value="{{old('social_media_url')}}">
                                @error('social_media_url')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group w-100 px-2">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </form>
        </div>
    </section>
</div>
@endsection