<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Country;
use App\Models\Radio;
use App\Models\socialMedia;
use App\Models\schedule;


class ApiController extends Controller
{
    public function categories()
    {
    	try
    	{
    		if(count(categories()) > 0)
    		{
    			return response()->json(['success'=>true, 'message'=>'Data found', 'total'=>count(categories()), 'data'=>categories()]);
    		}
    		return response()->json(['success'=>false, 'message'=>'No data found', 'total'=>count(categories()), 'data'=>categories()]);
    	}catch(Exception $e){

            $code = $e->getCode();           
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
    }

    public function countries()
    {
    	try
    	{
    		if(count(countries()) > 0)
    		{
    			return response()->json(['success'=>true, 'message'=>'Data found', 'total'=>count(countries()), 'data'=>countries()]);
    		}
    		return response()->json(['success'=>false, 'message'=>'No data found', 'total'=>count(countries()), 'data'=>countries()]);
    	}catch(Exception $e){

            $code = $e->getCode();           
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
    }

    public function radios(Request $request)
    {
    	try
    	{
    		$query = Radio::query();

    		if($request->has('radio_name') && !empty($request->radio_name))
    		{   

    			$search = $request->radio_name;

    			$query->where('radios.radio_name', 'LIKE', "%$search%");
    		}

    		if($request->has('country_id') && !empty($request->radios))
    		{
    			$query->where('country_id', $request->country_id);
    		}

    		if($request->has('category_id') && !empty($request->category_id))
    		{
    			$query->where('category_id', $request->category_id);
    		} 

    		$radios = $query->where('status','Active')->latest()->get();


    		if(count($radios) > 0)
    		{
    			return response()->json(['success'=>true, 'message'=>'Data found', 'total'=>count($radios), 'data'=>$radios]);
    		}
    		return response()->json(['success'=>false, 'message'=>'No data found', 'total'=>count($radios), 'data'=>$radios]);

    	}catch(Exception $e){

            $code = $e->getCode();           
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
    }

	public function socialMedia()
    {
    	try
    	{
    		if(count(socialMedia()) > 0)
    		{
    			return response()->json(['success'=>true, 'message'=>'Data found', 'total'=>count(socialMedia()), 'data'=>socialMedia()]);
    		}
    		return response()->json(['success'=>false, 'message'=>'No data found', 'total'=>count(socialMedia()), 'data'=>socialMedia()]);
    	}catch(Exception $e){

            $code = $e->getCode();           
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
    }


	public function schedule()
    {
    	try
    	{
    		if(count(schedule()) > 0)
    		{
    			return response()->json(['success'=>true, 'message'=>'Data found', 'total'=>count(schedule()), 'data'=>schedule()]);
    		}
    		return response()->json(['success'=>false, 'message'=>'No data found', 'total'=>count(schedule()), 'data'=>schedule()]);
    	}catch(Exception $e){

            $code = $e->getCode();           
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
    }

	public function podcast()
    {
    	try
    	{
    		if(count(podcast()) > 0)
    		{
    			return response()->json(['success'=>true, 'message'=>'Data found', 'total'=>count(podcast()), 'data'=>podcast()]);
    		}
    		return response()->json(['success'=>false, 'message'=>'No data found', 'total'=>count(podcast()), 'data'=>podcast()]);
    	}catch(Exception $e){

            $code = $e->getCode();           
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
    }


    public function ads()
    {
        try
        {
            
            return response()->json(['status'=>true, 'data'=>['select_ads'=>setting()->select_ads, 'admob_app_id'=>setting()->admob_app_id, 'admob_banner_id'=>setting()->admob_banner_id, 'admob_native_id'=>setting()->admob_native_id, 'abmob_interstial_id'=>setting()->abmob_interstial_id, 'admob_ads_unit'=>setting()->admob_ads_unit, 'applovin_app_id'=>setting()->applovin_app_id, 'applovin_banner_id'=>setting()->applovin_banner_id, 'applovin_native_id'=>setting()->applovin_native_id, 'applovin_interstial_id'=>setting()->applovin_interstial_id, 'applovin_ads_unit'=>setting()->applovin_ads_unit, 'facebook_app_id'=>setting()->facebook_app_id, 'facebook_banner_id'=>setting()->facebook_banner_id, 'facebook_native_id'=>setting()->facebook_native_id, 'facebook_interstial_id'=>setting()->facebook_interstial_id, 'facebook_ads_unit'=>setting()->facebook_ads_unit]]);

        }catch(Exception $e){
                      
                    $message = $e->getMessage();
          
                    $code = $e->getCode();       
          
                    $string = $e->__toString();       
                    return response()->json(['message'=>$message, 'execption_code'=>$code, 'execption_string'=>$string]);
                    exit;
        }
    }
}
