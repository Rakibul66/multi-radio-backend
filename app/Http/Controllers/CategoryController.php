<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Auth;
use DataTables;
class CategoryController extends Controller
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
                $categories = Category::latest()->select('*');
                return DataTables::of($categories)
                    ->addIndexColumn()

                    ->addColumn('status', function($row){
                        return '<label class="switch"><input class="' . ($row->status == 'Active' ? 'active-category' : 'decline-category') . '" id="status-category-update"  type="checkbox" ' . ($row->status == 'Active' ? 'checked' : '') . ' data-id="'.$row->id.'"><span class="slider round"></span></label>';
                    })
                    ->addColumn('action', function ($row) {
                        $btn = "";
                        $btn .= '&nbsp;';
                        $btn .= ' <a href="' . route('categories.show', $row->id) . '" class="btn btn-primary btn-sm action-button edit-product-category"><i class="fa fa-edit"></i></a>';
                        $btn .= '&nbsp;';
                        $btn .= ' <a href="#" class="btn btn-danger btn-sm delete-category action-button" data-id="' . $row->id . '"><i class="fa fa-trash"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['status','action']) 
                    ->make(true);
            }
            return view('categories.index');

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
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        try
        {   

            if($request->file('image'))
            {   
                $file = $request->file('image');
                $name = time().countCategory().$file->getClientOriginalName();
                $file->move(public_path().'/uploads/categories/', $name); 
                $path = 'uploads/categories/'.$name;
            } 

            $category = new Category();
            $category->user_id = Auth::user()->id;
            $category->category_name = $request->category_name;
            $category->image = $path;
            $category->status = $request->status;
            $category->save();

            $notification = array(
                'messege' => "Successfully a category has been added",
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
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        try
         {  

            if($request->file('image'))
            {   
                $file = $request->file('image');
                $name = time().countCategory().$file->getClientOriginalName();
                $file->move(public_path().'/uploads/categories/', $name); 
                unlink(public_path($category->image));
                $path = 'uploads/categories/'.$name;
            }
            else
            {
                $path = $category->image;
            }

            $category->category_name = $request->category_name;
            $category->image = $path;
            $category->status = $request->status;
            $category->update();

            $notification = array(
                'messege' => "Successfully the category has been updated",
                'alert-type' => 'success'
            );
            return redirect('/categories')->with($notification);

        }catch(Exception $e){

            $code = $e->getCode();           
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        try
        {
           unlink(public_path($category->image));
           $category->delete();
           return response()->json(['success'=>true, 'message'=>'Successfully the category has been deleted']);
        }catch(Exception $e){

            $code = $e->getCode();           
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
    }
}
