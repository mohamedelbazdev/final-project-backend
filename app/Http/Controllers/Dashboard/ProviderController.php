<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Provider;
use App\Models\Category;
use App\Models\User;
use App\Http\Requests\StoreProvider;
use App\Http\Requests\UpdateProvider;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image as Image;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(Provider $providers, Category $categories , User $users){
        $this->categories = $categories;
        $this->providers = $providers;
        $this->users = $users;
    }
    public function index()
    {
        //
        $providers = Provider::latest()->get();
        // $providers = User::Provider()->latest()->get();
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
        $data[ 'name' ] = $request->name;
        $data[ 'email' ] =  $request->email;
        $data[ 'mobile' ] =  $request->mobile;
        $data[ 'password' ] = \Hash::make( $request->password );
        $data[ 'role_id' ] = 2;
        $position = $request->map;
        $mycoords = explode( ',', $position );
        $data[ 'lat' ] = $mycoords[ 0 ];
        $data[ 'lng' ] = $mycoords[ 1 ];

        $image = $request->image;
        if ( $image ) {
            $image_one = uniqid() . '.' . $image->getClientOriginalExtension();
            Image::make( $image )->resize( 500, 300 )->save( 'images/Usrimg/' . $image_one );
            $data[ 'image' ] = 'images/Usrimg/' . $image_one;
                      }
          
        $user=User::create($data);
        $provider = new Provider();
        $provider->user_id = $user->id;
        $provider->description = $request['description'];
        $provider->price = $request['price'];
        $provider->category_id = $request['category_id'];

        $notification = array(
            'message' => 'providers Data Inserted Successfully',
            'alert-type' => 'success'
        );
        $provider->save();
        return redirect( route( 'provider.index' ) )->with( $notification );
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
        $user_id =Provider::findOrFail($id)->user_id;
        $user = DB::table( 'users' )->where( 'id', $user_id )->first();
        $categories = $this->categories->getList();
        return view( 'providers.edit', compact( 'provider','categories','user' ) );
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
        $user_id =Provider::findOrFail($id)->user_id;
        $data[ 'name' ] = $request->name;
        $data[ 'email' ] =  $request->email;
        $data[ 'mobile' ] =  $request->mobile;
        $data[ 'password' ] = \Hash::make( $request->password );
        $data[ 'role_id' ] = 2;
        $position = $request->map;
        $mycoords = explode( ',', $position );
        $data[ 'lat' ] = $mycoords[ 0 ];
        $data[ 'lng' ] = $mycoords[ 1 ];
        $oldimage = $request->oldimage;
        $image = $request->image;
        if ( $image ) {
            $image_one = uniqid() . '.' . $image->getClientOriginalExtension();
            Image::make( $image )->resize( 500, 300 )->save( 'images/Usrimg/' . $image_one );
            $data[ 'image' ] = 'images/Usrimg/' . $image_one;
            // image/postimg/343434.png
            
          $user=User::where( 'id', $user_id )->update( $data );
            unlink( $oldimage );
        }
            else {
                $data[ 'image' ] = $oldimage;
              $user= User::where( 'id', $user_id )->update( $data );
            }
        $user = User::find($id) ; 
        $provider = Provider::find($id);
        $provider->user_id = $user->id;
        $provider->description = $request->description;
        $provider->category_id =$request->category_id;
        $provider->price = $request->price;
        $provider->save();
        DB::commit();
        // dd($provider);
        $notification = array(
            'message' => 'Provider Data Updated Successfully',
            'alert-type' => 'success'
        );
        
        return redirect(route( 'provider.index' ) )->with($notification);
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
        $notification = array(
            'message' => 'provider Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect( route( 'provider.index' ) )->with(  $notification );
    }



    public function Inactive($id)
    {
        $user_id =Provider::findOrFail($id)->user_id;
        User::where( 'id', $user_id )->update(['status' => 0]);
        $notification = array(
            'message' => 'provider status updated',
            'alert-type' => 'success'
        );
        return redirect()->back()->with( $notification );
    }
    public function Active($id)
    { 
        $user_id =Provider::findOrFail($id)->user_id;
        User::where( 'id', $user_id )->update(['status' => 1]);
        $notification = array(
            'message' => 'provider status updated',
            'alert-type' => 'success'
        );
        return redirect()->back()->with( $notification );
    }


    // public function changeProviderStatus(Request $request)
    // {
    //     $providers = Provider::find($request->provider_id);
    //     $providers->status = $request->status;
    //     $providers->save();

    //     $notification = array(
    //         'message' => 'provider Deleted Successfully',
    //         'alert-type' => 'success'
    //     );
    //     return redirect( route( 'providers.index' ) )->with($notification );
    // }
}
