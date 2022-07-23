<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Provider;
use App\Models\Category;
use App\Http\Requests\StoreProvider;
use App\Http\Requests\UpdateProvider;
use Illuminate\Support\Facades\DB;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(Provider $providers, Category $categories){
        $this->categories = $categories;
        $this->providers = $providers;
    }
    public function index()
    {
        //
        $providers = Provider::all();
        return view( 'providers.index', compact( 'providers' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = $this->categories->getList();
        return view( 'providers.create', compact('categories') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProvider $request)
    {
        //
        $provider = new Provider();
        $provider->name = $request['name'];
        $provider->description = $request['description'];
        $provider->price = $request['price'];
        $provider->category_id = $request['category_id'];
        $provider->save();
        return redirect( route( 'provider.index' ) )->with( 'msg', 'Provider Added Successfully' );
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
        $provider = Provider::findOrFail($id);
        $categories = $this->categories->getList();
        return view( 'providers.edit', compact( 'provider','categories' ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProvider $request, $id)
    {
        //
        DB::beginTransaction();
        $provider = Provider::find($id);
        $provider->name = $request->name;
        $provider->description = $request->description;
        $provider->category_id =$request->category_id;
        $provider->price = $request->price;
        $provider->save();
        DB::commit();
        // dd($provider);
        $message = ('provider updated successfully');
        return redirect(route( 'provider.index' ) )->with( 'msg', 'provider Updated Successfully' );
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
        DB :: table( 'providers' )->where( 'id', $id )->delete();
        return redirect( route( 'provider.index' ) )->with( 'rmv', 'Provider Deleted Successfully' );
    }



    public function Inactive($id)
    {
        Provider::find($id)->update(['status' => 0]);
        return redirect()->back()->with( 'rmv', 'User has been Inactive' );
    }
    public function Active($id)
    {
        Provider::find($id)->update(['status' => 1]);
        return redirect()->back()->with( 'msg', 'User has been Active' );
    }


    public function changeProviderStatus(Request $request)
    {
        $providers = Provider::find($request->provider_id);
        $providers->status = $request->status;
        $providers->save();
        return redirect( route( 'providers.index' ) )->with( 'msg', 'Provider Status Updated Successfully' );
    }
}
