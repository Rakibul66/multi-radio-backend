<?php

namespace App\Http\Controllers;

use App\Models\Podcast;
use Illuminate\Http\Request;
use App\Http\Requests\StorePodcastRequest;
use DataTables;

class PodcastController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth_check');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try
        {
            if($request->ajax()){
                $podcast = Podcast::latest()->select('*');
                return DataTables::of($podcast)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = "";
                        $btn .= '&nbsp;';
                        $btn .= ' <a href="' . route('podcast.show', $row->id) . '" class="btn btn-primary btn-sm action-button edit-product-country"><i class="fa fa-edit"></i></a>';
                        $btn .= '&nbsp;';
                        $btn .= ' <a href="#" class="btn btn-danger btn-sm delete-podcast action-button" data-id="' . $row->id . '"><i class="fa fa-trash"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['action']) 
                    ->make(true);
            }
            return view('podcast.index');

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
        return view('podcast.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePodcastRequest $request)
    {
        try
        {    
            $podcast = new Podcast();
            $podcast->name = $request->name;
            $podcast->logo = $request->logo;
            $podcast->link = $request->link;
            $podcast->save();

             $notification = array(
                'messege' => "Successfully a Podcast has been added",
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Podcast $podcast)
    {
        return view('podcast.edit', compact('podcast'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePodcastRequest $request, Podcast $podcast)
    {
        try
        {    
            $podcast->name = $request->name;
            $podcast->logo = $request->logo;
            $podcast->link = $request->link;
            $podcast->update();

             $notification = array(
                'messege' => "Successfully the podcast has been Updated!",
                'alert-type' => 'success'
            );
         return redirect('/podcast')->with($notification);

        }catch(Exception $e){

            $code = $e->getCode();           
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Podcast $podcast)
    {
        try
        {
            $podcast->delete();
            return response()->json(['success'=>true, 'message'=>'Successfully the podcast has been deleted']);
        }catch(Exception $e){

            $code = $e->getCode();           
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
    }
}
