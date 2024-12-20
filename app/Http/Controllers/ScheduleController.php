<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Http\Requests\StoreScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;
use Auth;
use DataTables;

class ScheduleController extends Controller
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
        try {
            if ($request->ajax()) {
                $schedules = Schedule::latest()->select('*');
                return DataTables::of($schedules)
                    ->addIndexColumn()
    
                    ->addColumn('image', function ($row) {
                        $imageUrl = $row->image; 
                        return '<img src="' . $imageUrl . '" alt="Country Image" class="img-thumbnail" style="width: 50px; height: 50px;">';
                    })
    
                    ->addColumn('action', function ($row) {
                        $btn = "";
                        $btn .= '&nbsp;';
                        $btn .= ' <a href="' . route('schedule.show', $row->id) . '" class="btn btn-primary btn-sm action-button edit-product-country"><i class="fa fa-edit"></i></a>';
                        $btn .= '&nbsp;';
                        $btn .= ' <a href="#" class="btn btn-danger btn-sm delete-schedule action-button" data-id="' . $row->id . '"><i class="fa fa-trash"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['image', 'action'])
                    ->make(true);
            }
            return view('schedule.index');
    
        } catch (Exception $e) {
            $code = $e->getCode();
            return response()->json(['message' => 'Something went wrong', 'exception_code' => $code]);
        }
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('schedule.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreScheduleRequest $request)
    {
        try
        {    
            if($request->file('image'))
            {   
                $file = $request->file('image');
                $name = time().countSchedule().$file->getClientOriginalName(); 
                $file->move(public_path().'/uploads/schedule/', $name); 
                $path = 'uploads/schedule/'.$name;
            }
            $schedule = new Schedule();
            $schedule->schedule_name= $request->schedule_name;
            $schedule->image = $path;
            $schedule->save();

             $notification = array(
                'messege' => "Successfully a schedule has been added",
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
    public function show(Schedule $schedule)
    {
        return view('schedule.edit', compact('schedule'));
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
    public function update(UpdateScheduleRequest $request, Schedule $schedule)
    {
        try
        {    
            if($request->file('image'))
            {   
                $file = $request->file('image');
                $name = time().countSchedule().$file->getClientOriginalName(); 
                $file->move(public_path().'/uploads/schedule/', $name); 
                unlink(public_path($schedule->image));
                $path = 'uploads/schedule/'.$name;
            }
            else
            {
                $path = $schedule->image;

            }
            $schedule->schedule_name = $request->schedule_name;
            $schedule->image = $path;
            $schedule->update();

             $notification = array(
                'messege' => "Successfully the schedule has been added",
                'alert-type' => 'success'
            );
         return redirect('/schedule')->with($notification);

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
    public function destroy(Schedule $schedule)
    {
        try
        {
            unlink(public_path($schedule->image));
            $schedule->delete();
            return response()->json(['success'=>true, 'message'=>'Successfully the schedule has been deleted']);
        }catch(Exception $e){

            $code = $e->getCode();           
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
    }
}
