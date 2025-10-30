<?php

namespace App\Http\Controllers;

use App\Models\Music;
use Illuminate\Http\Request;
use App\Http\Requests\StoreMusicRequest;
use App\Http\Requests\UpdateMusicRequest;
use DataTables;
use DB;

class MusicController extends Controller
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
        if($request->ajax()){
            $musics = DB::table('music')->select('*');
            return DataTables::of($musics)
                ->addIndexColumn()

                ->addColumn('status', function($row){
                    return '<label class="switch"><input class="' . ($row->status == 'Active' ? 'active-music' : 'decline-music') . '" id="status-music-update"  type="checkbox" ' . ($row->status == 'Active' ? 'checked' : '') . ' data-id="'.$row->id.'"><span class="slider round"></span></label>';
                })
                ->addColumn('action', function ($row) {
                    $btn = "";
                    $btn .= '&nbsp;';
                    $btn .= ' <a href="' . route('musics.show', $row->id) . '" class="btn btn-primary btn-sm action-button edit-product-music"><i class="fa fa-edit"></i></a>';
                    $btn .= '&nbsp;';
                    $btn .= ' <a href="#" class="btn btn-danger btn-sm delete-music action-button" data-id="' . $row->id . '"><i class="fa fa-trash"></i></a>';
                    return $btn;
                })
                ->rawColumns(['status','action']) 
                ->make(true);
        }
        return view('musics.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('musics.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMusicRequest $request)
    {
        try {
            // --- IMAGE UPLOAD ---
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $name = time() . user()->id . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/musics/images'), $name);
                $imagePath = 'uploads/musics/images/' . $name;
            } else {
                $imagePath = null;
            }

            // --- MUSIC FILE UPLOAD ---
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $name = time() . user()->id . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/musics'), $name);
                $filePath = 'uploads/musics/' . $name;
            } else {
                $filePath = null;
            }

            // --- INSERT USING QUERY BUILDER ---
            DB::table('music')->insert([
                'user_id'     => user()->id,
                'title'       => $request->title,
                'description' => $request->description,
                'status'      => $request->status,
                'file'        => $filePath,
                'image'       => $imagePath,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);

            // --- SUCCESS NOTIFICATION ---
            $notification = [
                'messege' => "Successfully a music has been added",
                'alert-type' => 'success',
            ];

            return redirect()->back()->with($notification);

        } catch (Exception $e) {
            return response()->json([
                'status'  => false,
                'code'    => $e->getCode(),
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Music  $music
     * @return \Illuminate\Http\Response
     */
    public function show(Music $music)
    {
        return view('musics.edit', compact('music'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Music  $music
     * @return \Illuminate\Http\Response
     */
    public function edit(Music $music)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Music  $music
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMusicRequest $request, Music $music)
    {
        try {
            // --- IMAGE UPLOAD + OLD DELETE ---
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $name = time() . user()->id . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/musics/images'), $name);

                // delete old image if exists
                if (!empty($music->image) && file_exists(public_path($music->image))) {
                    unlink(public_path($music->image));
                }

                $imagePath = 'uploads/musics/images/' . $name;
            } else {
                $imagePath = $music->image;
            }

            // --- MUSIC FILE UPLOAD + OLD DELETE ---
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $name = time() . user()->id . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/musics'), $name);

                // delete old file if exists
                if (!empty($music->file) && file_exists(public_path($music->file))) {
                    unlink(public_path($music->file));
                }

                $filePath = 'uploads/musics/' . $name;
            } else {
                $filePath = $music->file;
            }

            // --- UPDATE USING QUERY BUILDER ---
            DB::table('music')
                ->where('id', $music->id)
                ->update([
                    'title'       => $request->title,
                    'description' => $request->description,
                    'status'      => $request->status,
                    'file'        => $filePath,
                    'image'       => $imagePath,
                    'updated_at'  => now(),
                ]);

            // --- SUCCESS NOTIFICATION ---
            $notification = [
                'messege' => "Successfully the music has been updated",
                'alert-type' => 'success',
            ];

            return redirect('/musics')->with($notification);

        } catch (Exception $e) {
            return response()->json([
                'status'  => false,
                'code'    => $e->getCode(),
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Music  $music
     * @return \Illuminate\Http\Response
     */
    public function destroy(Music $music)
    {
        try {
            // --- DELETE MUSIC FILE IF EXISTS ---
            if (!empty($music->file) && file_exists(public_path($music->file))) {
                unlink(public_path($music->file));
            }

            // --- DELETE IMAGE FILE IF EXISTS ---
            if (!empty($music->image) && file_exists(public_path($music->image))) {
                unlink(public_path($music->image));
            }

            // --- DELETE RECORD USING QUERY BUILDER ---
            DB::table('music')->where('id', $music->id)->delete();

            return response()->json([
                'status'  => true,
                'message' => 'Successfully the music deleted',
            ]);

        } catch (Exception $e) {
            return response()->json([
                'status'  => false,
                'code'    => $e->getCode(),
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
