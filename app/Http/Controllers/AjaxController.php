<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Country;
use App\Models\Radio;
use App\Models\Music;
use App\Models\Video;
use DB;

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

    public function musicStatusUpdate(Request $request)
    {
        try
        {
            DB::table('music')->where('id',$request->music_id)->update([
                'status' => $request->status
            ]);
            return response()->json(['success'=>true, 'message'=>'Succfully the status has been updated']);
        }catch(Exception $e){

            $code = $e->getCode();           
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
    }

    public function videoStatusUpdate(Request $request)
    {
        try
        {
            $video = Video::findorfail($request->video_id);
            $video->status = $request->status;
            $video->update();
            return response()->json(['success'=>true, 'message'=>'Succfully the status has been updated']);
        }catch(Exception $e){

            $code = $e->getCode();           
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
    }
}
