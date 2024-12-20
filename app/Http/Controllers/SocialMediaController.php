<?php

namespace App\Http\Controllers;

use App\Models\SocialMedia;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSocialMediaRequest;
use DataTables;

class SocialMediaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth_check');
    }

    public function index(Request $request)
    {
        try
        {
            if($request->ajax()){
                $socialmedia = SocialMedia::latest()->select('*');
                return DataTables::of($socialmedia)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = "";
                        $btn .= '&nbsp;';
                        $btn .= ' <a href="' . route('socialmedia.show', $row->id) . '" class="btn btn-primary btn-sm action-button edit-product-country"><i class="fa fa-edit"></i></a>';
                        $btn .= '&nbsp;';
                        $btn .= ' <a href="#" class="btn btn-danger btn-sm delete-socialmedia action-button" data-id="' . $row->id . '"><i class="fa fa-trash"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['action']) 
                    ->make(true);
            }
            return view('socialmedia.index');

        }catch(Exception $e){

            $code = $e->getCode();           
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        } 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('socialmedia.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSocialMediaRequest $request)
    {
        try
        {    
            $socialmedia = new SocialMedia();
            $socialmedia->social_media_name = $request->social_media_name;
            $socialmedia->social_media_url = $request->social_media_url;
            $socialmedia->save();

             $notification = array(
                'messege' => "Successfully a Social Media has been added",
                'alert-type' => 'success'
            );
         return Redirect()->back()->with($notification);

        }catch(Exception $e){

            $code = $e->getCode();           
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SocialMedia  $socialmedia
     * @return \Illuminate\Http\Response
     */
    public function show(SocialMedia $socialmedia)
    {
        return view('socialmedia.edit', compact('socialmedia'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SocialMedia  $socialmedia
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSocialMediaRequest $request, SocialMedia $socialmedia)
    {
        try
        {    
            $socialmedia->social_media_name = $request->social_media_name;
            $socialmedia->social_media_url = $request->social_media_url;
            $socialmedia->update();

             $notification = array(
                'messege' => "Successfully the Social Media has been Updated!",
                'alert-type' => 'success'
            );
         return redirect('/socialmedia')->with($notification);

        }catch(Exception $e){

            $code = $e->getCode();           
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SocialMedia  $socialmdia
     * @return \Illuminate\Http\Response
     */
    public function destroy(SocialMedia $socialmedia)
    {
        try
        {
            $socialmedia->delete();
            return response()->json(['success'=>true, 'message'=>'Successfully the social media has been deleted']);
        }catch(Exception $e){

            $code = $e->getCode();           
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
    }
}