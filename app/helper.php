<?php
 use App\Models\Category;
 use App\Models\Country;
 use App\Models\Radio;
 use App\Models\Setting;
 use App\Models\Schedule;
 use App\Models\SocialMedia;
 use App\Models\Podcast;


 function countCategory()
 {
 	$count = Category::count();
 	$count+=1;
 	return $count;
 }

 function countCountry()
 {
 	$count = Country::count();
 	$count+=1;
 	return $count;
 }

 function countSchedule()
 {
 	$count = Schedule::count();
 	$count+=1;
 	return $count;
 }

 function countRadio()
 {
 	$count = Radio::count();
 	$count+=1;
 	return $count;
 }

 function categories()
 {
 	$categories = Category::where('status','Active')->latest()->get();
 	return $categories;
 }

 function countries()
 {
 	$countries = Country::where('status','Active')->latest()->get();
 	return $countries;
 }

 function socialMedia()
 {
 	$socialMedia = SocialMedia::latest()->get();
 	return $socialMedia;
 }

 function schedule()
 {
 	$schedule = Schedule::latest()->get();
 	return $schedule;
 }

 function podcast()
 {
 	$podcast = Podcast::latest()->get();
 	return $podcast;
 }

 function setting()
 {
 	 $setting = Setting::find(1);
 	 return $setting;
 }

 function adsSettings($request)
{   
    $setting = Setting::findorfail(1);
    $setting->select_ads = $request->select_ads;
    $setting->admob_app_id = $request->admob_app_id;
    $setting->admob_banner_id = $request->admob_banner_id;
    $setting->admob_native_id = $request->admob_native_id;
    $setting->abmob_interstial_id = $request->abmob_interstial_id;
    $setting->abmob_interstial_id = $request->abmob_interstial_id;
    $setting->admob_ads_unit = $request->admob_ads_unit;

    $setting->facebook_app_id = $request->facebook_app_id;
    $setting->facebook_banner_id = $request->facebook_banner_id;
    $setting->facebook_native_id = $request->facebook_native_id;
    $setting->facebook_interstial_id = $request->facebook_interstial_id;
    $setting->facebook_interstial_id = $request->facebook_interstial_id;
    $setting->facebook_ads_unit = $request->facebook_ads_unit;

    $setting->applovin_app_id = $request->applovin_app_id;
    $setting->applovin_banner_id = $request->applovin_banner_id;
    $setting->applovin_native_id = $request->applovin_native_id;
    $setting->applovin_interstial_id = $request->applovin_interstial_id;
    $setting->applovin_ads_unit = $request->applovin_ads_unit;
    $setting->update();
}