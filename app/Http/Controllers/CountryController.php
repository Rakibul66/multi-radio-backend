<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use Auth;
use DataTables;
class CountryController extends Controller
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
                $countries = Country::latest()->select('*');
                return DataTables::of($countries)
                    ->addIndexColumn()

                    ->addColumn('status', function($row){
                        return '<label class="switch"><input class="' . ($row->status == 'Active' ? 'active-country' : 'decline-country') . '" id="status-country-update"  type="checkbox" ' . ($row->status == 'Active' ? 'checked' : '') . ' data-id="'.$row->id.'"><span class="slider round"></span></label>';
                    })
                    ->addColumn('action', function ($row) {
                        $btn = "";
                        $btn .= '&nbsp;';
                        $btn .= ' <a href="' . route('countries.show', $row->id) . '" class="btn btn-primary btn-sm action-button edit-product-country"><i class="fa fa-edit"></i></a>';
                        $btn .= '&nbsp;';
                        $btn .= ' <a href="#" class="btn btn-danger btn-sm delete-country action-button" data-id="' . $row->id . '"><i class="fa fa-trash"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['status','action']) 
                    ->make(true);
            }
            return view('countries.index');

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
        return view('countries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCountryRequest $request)
    {
        try
        {    
            if($request->file('image'))
            {   
                $file = $request->file('image');
                $name = time().countCountry().$file->getClientOriginalName(); 
                $file->move(public_path().'/uploads/country/', $name); 
                $path = 'uploads/country/'.$name;
            }
            $country = new Country();
            $country->user_id = Auth::user()->id;
            $country->country_name = $request->country_name;
            $country->status = $request->status;
            $country->image = $path;
            $country->save();

             $notification = array(
                'messege' => "Successfully a country has been added",
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
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        return view('countries.edit', compact('country'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCountryRequest $request, Country $country)
    {
        try
        {    
            if($request->file('image'))
            {   
                $file = $request->file('image');
                $name = time().countCountry().$file->getClientOriginalName(); 
                $file->move(public_path().'/uploads/country/', $name); 
                unlink(public_path($country->image));
                $path = 'uploads/country/'.$name;
            }
            else
            {
                $path = $country->image;

            }
            $country->country_name = $request->country_name;
            $country->status = $request->status;
            $country->image = $path;
            $country->update();

             $notification = array(
                'messege' => "Successfully the country has been added",
                'alert-type' => 'success'
            );
         return redirect('/countries')->with($notification);

        }catch(Exception $e){

            $code = $e->getCode();           
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        try
        {
            unlink(public_path($country->image));
            $country->delete();
            return response()->json(['success'=>true, 'message'=>'Successfully the country has been deleted']);
        }catch(Exception $e){

            $code = $e->getCode();           
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
    }
}
