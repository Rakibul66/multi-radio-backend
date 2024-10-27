<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Http\Requests\PasswordChangeRequest;
use App\Models\User;
use Auth;
use Hash;
class SettingController extends Controller
{
    public function appSettings()
    {
    	return view('settings.app_settings');
    }

    public function settingsApp(Request $request)
    {
    	try
    	{   

    	    $setting = setting();  

    		if($request->file('image'))
            {   
                $file = $request->file('image');
                $name = time().$file->getClientOriginalName();

                $file->move(public_path().'/defaults/', $name); 

                unlink(public_path($setting->app_logo));

                $path = 'defaults/'.$name;
            }
            else
            {
            	$path = $setting->app_logo;
            }
    		
    		$setting->app_name = $request->app_name;
    		$setting->app_logo = $path;
    		$setting->update();

    		$notification = array(
                'messege' => "Successfully app settings save",
                'alert-type' => 'success'
            );
           return Redirect()->back()->with($notification);

    	}catch(Exception $e){

            $code = $e->getCode();           
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
    }

    public function accountSettings()
    {
        return view('settings.account_settings');
    }

    public function settingsAccount(Request $request)
    {
        try
        {
            $user = Auth::user();

            if($request->file('image'))
            {   
                $file = $request->file('image');
                $name = time().Auth::user()->id.$file->getClientOriginalName();

                $file->move(public_path().'/uploads/users', $name); 

                unlink(public_path($user->image));

                $path = 'uploads/users/'.$name;
            }
            else
            {
                $path = $user->image;
            }

            $user->name = $request->name;
            $user->image = $path;
            $user->update();

            $notification = array(
                'messege' => "Successfully account settings save",
                'alert-type' => 'success'
            );
           return Redirect()->back()->with($notification);

        }catch(Exception $e){

            $code = $e->getCode();           
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
    }

    public function changePassword()
    {
        return view('settings.change_password');
    }

    public function passwordChange(Request $request)
    {
       try
       {
           
            $user = User::findorfail(Auth::user()->id);

            

            if (!Hash::check($request->current_password, $user->password)) {
    

                $notification=array(
                             'messege'=>'The current password is not matched',
                             'alert-type'=>'error'
                            );

                return redirect()->back()->with($notification);
            }

            $user->password = Hash::make($request->new_password);
            $user->update();


           $notification=array(
                             'messege'=>'Successfully your has been changed',
                             'alert-type'=>'success'
                            );

                return redirect()->back()->with($notification);

      }catch(Exception $e){
              
            $code = $e->getCode();                
        return response()->json(['message'=>"Something went wrong", 'execption_code'=>$code]);
       }
    }

    public function adsSettings()
    {
        return view('settings.ads_settings');
    }

    public function settingAds(Request $request)
    {
        adsSettings($request);
        $notification=array(
                         'messege'=>'Successfully ads information has been updated',
                         'alert-type'=>'success'
                        );

       return redirect()->back()->with($notification);
    }
}
