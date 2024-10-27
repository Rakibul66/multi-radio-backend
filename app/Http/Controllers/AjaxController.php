<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Country;
use App\Models\Radio;
class AjaxController extends Controller
{
    public function categoryStatusUpdate(Request $request)
    {
    	try
    	{
    		$category = Category::findorfail($request->category_id);
    		$category->status = $request->status;
    		$category->update();
    		return response()->json(['success'=>true, 'message'=>'Succfully the status has been updated']);
    	}catch(Exception $e){

            $code = $e->getCode();           
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
    }

    public function countryStatusUpdate(Request $request)
    {
        try
        {
            $country = Country::findorfail($request->country_id);
            $country->status = $request->status;
            $country->update();
            return response()->json(['success'=>true, 'message'=>'Succfully the status has been updated']);
        }catch(Exception $e){

            $code = $e->getCode();           
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
    }

    public function radioStatusUpdate(Request $request)
    {
        try
        {
            $radio = Radio::findorfail($request->radio_id);
            $radio->status = $request->status;
            $radio->update();
            return response()->json(['success'=>true, 'message'=>'Succfully the status has been updated']);
        }catch(Exception $e){

            $code = $e->getCode();           
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
    }
}
