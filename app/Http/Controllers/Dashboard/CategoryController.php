<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\StoreCategory;
use App\Http\Requests\UpdateCategory;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image as Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        $categories = Category::all();
        return view( 'categories.index', compact( 'categories' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view( 'categories.create' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(StoreCategory $request)
    {
        //
        $category = new Category();
        $category->name = $request->input( 'name' );
        $image = $request->image;
        if ( $image ) {
            $image_one = uniqid() . '.' . $image->getClientOriginalExtension();
            Image::make( $image )->save( 'images/Catimg/' . $image_one );
            $category[ 'image' ] = 'images/Catimg/' . $image_one;}
            $notification = array(
                'message' => 'Category Data Inserted Successfully',
                'alert-type' => 'success'
            );
        $category->save();
        return redirect( route( 'category.index' ) )->with( $notification );

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
        $category = Category::findOrFail($id);
        return view( 'categories.edit', compact( 'category' ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCategory $request
     * @param int $id
     * @return Application|RedirectResponse|Redirector
     */
    public function update(UpdateCategory $request, $id)
    {
        //
        $category = Category::find( $id );
        $category->name = $request->name;
        $image = $request->image;
        if ( $image ) {
            $image_one = uniqid() . '.' . $image->getClientOriginalExtension();
            Image::make( $image )->save( 'images/Catimg/' . $image_one );
            $category[ 'image' ] = 'images/Catimg/' . $image_one;}
        $category->update();
        $notification = array(
            'message' => 'Category Data  Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect( route( 'category.index' ) )->with( $notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy(int $id)
    {
        //
        DB::beginTransaction();
        $users = User::whereHas('providers', function($query) use($id){
            $query->where('category_id', $id);
        })->delete();

        DB :: table( 'categories' )->where( 'id', $id )->delete();

        DB::commit();
        $notification = array(
            'message' => 'category Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect( route( 'category.index' ) )->with( $notification );
    }
}
