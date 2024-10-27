@extends('admin_master')
@section('content')
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Ads Settings</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{URL::to('/ads-settings')}}">Ads Settings
                                </a></li>
                        <li class="breadcrumb-item active">Ads Settings</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Ads Settings</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{url('settings-ads')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                    <div class="col-md-4">
                       <div class="card">
                        <div class="card-header">
                          <input type="radio" name="select_ads" id="admob" value="admob" <?php if(setting()->select_ads == 'admob'){echo "checked";} ?>>
                          <label for="admob">Admob</label>
                        </div>

                        <div class="card-body">
                           <div class="form-group">
                             <label for="admob_app_id">Admob App ID</label>
                             <input type="text" class="form-control" name="admob_app_id" id="admob_app_id" placeholder="Admob App ID" value="{{setting()->admob_app_id}}">
                           </div>


                           <div class="form-group">
                             <label for="admob_banner_id">Admob Banner ID</label>
                             <input type="text" class="form-control" name="admob_banner_id" id="admob_banner_id" placeholder="Admob Banner ID" value="{{setting()->admob_banner_id}}">
                           </div>

                           <div class="form-group">
                             <label for="admob_native_id">Admob Native ID</label>
                             <input type="text" class="form-control" name="admob_native_id" id="admob_native_id" placeholder="Admob Native ID" value="{{setting()->admob_native_id}}">
                           </div>


                           <div class="form-group">
                             <label for="abmob_interstial_id">Admob Interstial ID</label>
                             <input type="text" class="form-control" name="abmob_interstial_id" id="abmob_interstial_id" placeholder="Admob Interstial ID" value="{{setting()->abmob_interstial_id}}">
                           </div>


                           <div class="form-group">
                             <label for="admob_ads_unit">Admob Ads Unit</label>
                             <input type="text" class="form-control" name="admob_ads_unit" id="admob_ads_unit" placeholder="Admob Ads Unit" value="{{setting()->admob_ads_unit}}">
                           </div>


                        </div>
                       </div>
                    </div>

                    <div class="col-md-4">
                       <div class="card">
                        <div class="card-header">
                          <input type="radio" name="select_ads" id="facebook" value="facebook" <?php if(setting()->select_ads == 'facebook'){echo "checked";} ?>>
                          <label for="facebook">Facebook</label>
                        </div>

                        <div class="card-body">
                           <div class="form-group">
                             <label for="facebook_app_id">Facebook App ID</label>
                             <input type="text" class="form-control" name="facebook_app_id" id="facebook_app_id" placeholder="Facebook App ID" value="{{setting()->facebook_app_id}}">
                           </div>


                           <div class="form-group">
                             <label for="facebook_banner_id">Facebook Banner ID</label>
                             <input type="text" class="form-control" name="facebook_banner_id" id="facebook_banner_id" placeholder="Facebook Banner ID" value="{{setting()->facebook_banner_id}}">
                           </div>

                           <div class="form-group">
                             <label for="facebook_native_id">Facebook Native ID</label>
                             <input type="text" class="form-control" name="facebook_native_id" id="facebook_native_id" placeholder="Facebook Native ID" value="{{setting()->facebook_native_id}}">
                           </div>


                           <div class="form-group">
                             <label for="facebook_interstial_id">Facebook Interstial ID</label>
                             <input type="text" class="form-control" name="facebook_interstial_id" id="facebook_interstial_id" placeholder="Facebook Interstial ID" value="{{setting()->facebook_interstial_id}}">
                           </div>


                           <div class="form-group">
                             <label for="facebook_ads_unit">Facebook Ads Unit</label>
                             <input type="text" class="form-control" name="facebook_ads_unit" id="facebook_ads_unit" placeholder="Facebook Ads Unit" value="{{setting()->facebook_ads_unit}}">
                           </div>


                        </div>
                       </div>
                    </div>

                    <div class="col-md-4">
                       <div class="card">
                        <div class="card-header">
                          <input type="radio" name="select_ads" id="applovin" value="applovin" <?php if(setting()->select_ads == 'applovin'){echo "checked";} ?>>
                          <label for="applovin">Applovin</label>
                        </div>

                        <div class="card-body">
                           <div class="form-group">
                             <label for="applovin_app_id">Applovin App ID</label>
                             <input type="text" class="form-control" name="applovin_app_id" id="applovin_app_id" placeholder="Applovin App ID" value="{{setting()->applovin_app_id}}">
                           </div>


                           <div class="form-group">
                             <label for="applovin_banner_id">Applovin Banner ID</label>
                             <input type="text" class="form-control" name="applovin_banner_id" id="applovin_banner_id" placeholder="Applovin Banner ID" value="{{setting()->applovin_banner_id}}">
                           </div>

                           <div class="form-group">
                             <label for="applovin_native_id">Applovin Native ID</label>
                             <input type="text" class="form-control" name="applovin_native_id" id="applovin_native_id" placeholder="Applovin Native ID" value="{{setting()->applovin_native_id}}">
                           </div>


                           <div class="form-group">
                             <label for="applovin_interstial_id">Applovin Interstial ID</label>
                             <input type="text" class="form-control" name="applovin_interstial_id" id="applovin_interstial_id" placeholder="Applovin Interstial ID" value="{{setting()->applovin_interstial_id}}">
                           </div>


                           <div class="form-group">
                             <label for="applovin_ads_unit">Applovin Ads Unit</label>
                             <input type="text" class="form-control" name="applovin_ads_unit" id="applovin_ads_unit" placeholder="Applovin Interstial ID" value="{{setting()->applovin_ads_unit}}">
                           </div>

                           


                        </div>
                       </div>
                    </div>
                    
                    <div class="col-md-12 mt-2">
                      <div class="form-group">
                          <button type="submit" class="btn btn-success">Update</button>
                       </div>
                    </div>
                   </div>
                    <!-- /.card-body -->
                </div>
            </form>
        </div>
    </section>

 </div>
@endsection