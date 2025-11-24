<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use App\Http\Requests\StoreVideoRequest;
use App\Http\Requests\UpdateVideoRequest;
use DataTables;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth_check');
    }

    public function index(Request $request)
    {
        try
        {
            if($request->ajax()){
                $videos = Video::latest()->select('*');
                return DataTables::of($videos)
                    ->addIndexColumn()

                    ->addColumn('category', function($row){
                        return $row->category->category_name;
                    })

                    ->addColumn('status', function($row){
                        return '<label class="switch"><input class="' . ($row->status == 'Active' ? 'active-video' : 'decline-video') . '" id="status-video-update"  type="checkbox" ' . ($row->status == 'Active' ? 'checked' : '') . ' data-id="'.$row->id.'"><span class="slider round"></span></label>';
                    })
                    ->addColumn('action', function ($row) {
                        $btn = "";
                        $btn .= '&nbsp;';
                        $btn .= ' <a href="' . route('videos.show', $row->id) . '" class="btn btn-primary btn-sm action-button edit-product-video"><i class="fa fa-edit"></i></a>';
                        $btn .= '&nbsp;';
                        $btn .= ' <a href="#" class="btn btn-danger btn-sm delete-video action-button" data-id="' . $row->id . '"><i class="fa fa-trash"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['status','action','category']) 
                    ->make(true);
            }
            return view('videos.index');

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
        return view('videos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVideoRequest $request)
    {
        try
        {   
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $name = time() . user()->id . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/videos/images'), $name);
                $imagePath = 'uploads/videos/images/' . $name;
            } else {
                $imagePath = null;
            }

            $video = new Video();
            $video->user_id = user()->id;
            $video->category_id = $request->category_id;
            $video->title = $request->title;
            $video->video_url = $request->video_url;
            $video->yt_video_id = getYoutubeId($request->video_url);
            $video->image = $imagePath;
            $video->description = $request->description;
            $video->is_top = $request->is_top;
            $video->status = $request->status;
            $video->save();

            $notification = [
                'messege' => "Successfully a video has been added",
                'alert-type' => 'success',
            ];

            return redirect()->back()->with($notification);

        }catch(Exception $e){

            $code = $e->getCode();           
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        return view('videos.edit', compact('video'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVideoRequest $request, Video $video)
    {
        try
        {   
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $name = time() . user()->id . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/videos/images'), $name);
                if($video->image != NULL)
                {
                    unlink(public_path($video->image));
                }
                $imagePath = 'uploads/videos/images/' . $name;
            } else {
                $imagePath = $video->image;
            }

            $video->category_id = $request->category_id;
            $video->title = $request->title;
            $video->video_url = $request->video_url;
            $video->yt_video_id = getYoutubeId($request->video_url);
            $video->image = $imagePath;
            $video->description = $request->description;
            $video->is_top = $request->is_top;
            $video->status = $request->status;
            $video->update();

            $notification = [
                'messege' => "Successfully the video has been updated",
                'alert-type' => 'success',
            ];

            return redirect('/videos')->with($notification); 

        }catch(Exception $e){

            $code = $e->getCode();           
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        try
        {
            if($video->image != NULL)
            {
                unlink(public_path($video->image));
            }
            $video->delete();
            return response()->json(['status'=>true, 'message'=>'Successfully the video has been deleted']);
        }catch(Exception $e){

            $code = $e->getCode();           
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
    }
}
