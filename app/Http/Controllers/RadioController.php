<?php

namespace App\Http\Controllers;

use App\Models\Radio;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRadioRequest;
use App\Http\Requests\UpdateRadioRequest;
use Auth;
use DataTables;
class RadioController extends Controller
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
                $radios = Radio::latest()->select('*');
                return DataTables::of($radios)
                    ->addIndexColumn()


                    ->addColumn('category', function($row){
                        return $row->category->category_name;
                    })


                    ->addColumn('country', function($row){
                        return $row->country->country_name;
                    })

                    ->addColumn('status', function($row){
                        return '<label class="switch"><input class="' . ($row->status == 'Active' ? 'active-radio' : 'decline-radio') . '" id="status-radio-update"  type="checkbox" ' . ($row->status == 'Active' ? 'checked' : '') . ' data-id="'.$row->id.'"><span class="slider round"></span></label>';
                    })
                    ->addColumn('action', function ($row) {
                        $btn = "";
                        $btn .= '&nbsp;';
                        $btn .= ' <a href="' . route('radios.show', $row->id) . '" class="btn btn-primary btn-sm action-button edit-product-radio"><i class="fa fa-edit"></i></a>';
                        $btn .= '&nbsp;';
                        $btn .= ' <a href="#" class="btn btn-danger btn-sm delete-radio action-button" data-id="' . $row->id . '"><i class="fa fa-trash"></i></a>';
                        return $btn;
                    })->filter(function ($instance) use ($request) {

                            if ($request->get('search') != "") {
                                 $instance->where(function($w) use($request){
                                    $search = $request->get('search');
                                    $w->orWhere('radios.radio_name', 'LIKE', "%$search%");
                                });
                            }

                            if ($request->get('category_id') != "") {
                                 $instance->where(function($w) use($request){
                                    $category_id = $request->get('category_id');
                                    $w->orWhere('radios.category_id', $category_id);
                                });
                            }

                            if ($request->get('country_id') != "") {
                                 $instance->where(function($w) use($request){
                                    $country_id = $request->get('country_id');
                                    $w->orWhere('radios.country_id', $country_id);
                                });
                            }

                            if ($request->get('status') != "") {
                                 $instance->where(function($w) use($request){
                                    $status = $request->get('status');
                                    $w->orWhere('radios.status', $status);
                                });
                            }

                            
                    })
                    ->rawColumns(['status','category','country','action']) 
                    ->make(true);
            }
            return view('radios.index');

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
        return view('radios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRadioRequest $request)
    {
        try
        {   

            if($request->file('image'))
            {   
                $file = $request->file('image');
                $name = time().countCategory().$file->getClientOriginalName();
                $file->move(public_path().'/uploads/radio/', $name); 
                $path = 'uploads/radio/'.$name;
            }

            $radio = new Radio();
            $radio->user_id = Auth::user()->id;
            $radio->category_id = $request->category_id;
            $radio->country_id = $request->country_id;
            $radio->radio_name = $request->radio_name;
            $radio->radio_url = $request->radio_url;
            $radio->description = $request->description;
            $radio->status = $request->status;
            $radio->image = $path;
            $radio->save();

            $notification = array(
                'messege' => "Successfully a radio has been added",
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
     * @param  \App\Models\Radio  $radio
     * @return \Illuminate\Http\Response
     */
    public function show(Radio $radio)
    {
        return view('radios.edit', compact('radio'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Radio  $radio
     * @return \Illuminate\Http\Response
     */
    public function edit(Radio $radio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Radio  $radio
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRadioRequest $request, Radio $radio)
    {
        try
        {   

            if($request->file('image'))
            {   
                $file = $request->file('image');
                $name = time().countCategory().$file->getClientOriginalName();
                $file->move(public_path().'/uploads/radio/', $name); 
                unlink(public_path($radio->image));
                $path = 'uploads/radio/'.$name;
            }
            else
            {
                $path = $radio->image;
            }

            $radio->category_id = $request->category_id;
            $radio->country_id = $request->country_id;
            $radio->radio_name = $request->radio_name;
            $radio->radio_url = $request->radio_url;
            $radio->description = $request->description;
            $radio->status = $request->status;
            $radio->image = $path;
            $radio->update();

            $notification = array(
                'messege' => "Successfully the radio has been added",
                'alert-type' => 'success'
            );
          return redirect('/radios')->with($notification);
        }catch(Exception $e){

            $code = $e->getCode();           
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Radio  $radio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Radio $radio)
    {
        try
        {
            unlink(public_path($radio->image));
            $radio->delete();
            return response()->json(['success'=>true, 'message'=>'Successfully the radio has been deleted']);
        }catch(Exception $e){

            $code = $e->getCode();           
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        } 
    }
}
