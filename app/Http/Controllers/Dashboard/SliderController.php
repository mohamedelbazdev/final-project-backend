<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image as Image;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sliders = Slider::all();
        return view( 'slider.index', compact( 'sliders' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view( 'slider.create' );

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $slider =  $this->validate( $request, [
            'title'     => 'required|min:3|regex:/(^[a-zA-Z][a-zA-Z\s]{0,20}[a-zA-Z]$)/',
            'description'     => 'required|string',
            'image'   => 'required|image|mimes:png,jpg,gif'
        ] );
        $slider = new Slider();
        $slider->title = $request->input( 'title' );
        $slider->description = $request->input( 'description' );
        $image = $request->image;
        if ( $image ) {
            $image_one = uniqid() . '.' . $image->getClientOriginalExtension();
            Image::make( $image )->resize( 500, 300 )->save( 'images/Catimg/' . $image_one );
            $slider[ 'image' ] = 'images/Catimg/' . $image_one;}
            $notification = array(
                'message' => 'slider Data Inserted Successfully',
                'alert-type' => 'success'
            );
        $slider->save();
        return redirect( route( 'slider.index' ) )->with( $notification );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $slider = Slider::findOrFail($id);
        return view( 'slider.edit', compact( 'slider' ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $slider =  $this->validate( $request, [
            'title'     => 'required|min:3|regex:/(^[a-zA-Z][a-zA-Z\s]{0,20}[a-zA-Z]$)/',
            'description'     => 'required|string',
            'image'   => 'required|image|mimes:png,jpg,gif'
        ] );

        $slider = Slider::find( $id );
        $slider->title = $request->title;
        $slider->description = $request->description;
        $image = $request->image;
        if ( $image ) {
            $image_one = uniqid() . '.' . $image->getClientOriginalExtension();
            Image::make( $image )->resize( 500, 300 )->save( 'images/Catimg/' . $image_one );
            $slider[ 'image' ] = 'images/Catimg/' . $image_one;}
        $slider->update();
        $notification = array(
            'message' => 'slider Data  Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect( route( 'slider.index' ) )->with( $notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        DB :: table( 'sliders' )->where( 'id', $id )->delete();
        $notification = array(
            'message' => 'slider Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect( route( 'slider.index' ) )->with( $notification );
    }
}
