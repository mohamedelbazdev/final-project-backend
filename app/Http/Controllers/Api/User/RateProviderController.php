<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\RateProviderResource;
use App\Models\Provider;
use App\Models\RateProvider;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class RateProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        {
            return  RateProviderResource::collection(RateProvider::all());

        }
    }

    /**
     * @param Request $request
     * @return RateProviderResource|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function store(Request $request)
    {
        //
        $rataProvider = RateProvider::where('user_id', auth()->id())->where('provider_id',$request->provider_id)->first();
        if (!$rataProvider) {

            $data = RateProvider::create([
                'user_id' =>auth()->id(),
                // 'user_id' => 3,
                'provider_id' => $request->provider_id,
                'rate' => $request->rate,
            ]);

            $provider = Provider::whereUserId($request->provider_id)->first();

            $count = RateProvider::whereProviderId($request->post('provider_id'))->count();
            $submit = RateProvider::whereProviderId($request->post('provider_id'))->sum('rate');

            if ($provider) {
//                $all_provider_rates = 0;
//                foreach ($provider->rateprovider as $rate) {
//                    $all_provider_rates += $rate->rate;
//                }
                $provider->rate = $submit / $count;
                $provider->save();
            }

            return new RateProviderResource($data);

        } else {
            return response('The User Rating provider already', 422);
        }
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
        return (new RateProviderResource(RateProvider::findorfail($id)))->response()->setStatusCode(201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
        $data = RateProvider::findorfail($id);
        $data->update([
            'user_id' => auth()->id(),
            'provider_id' => $request->book_id,
            'rate' => $request->rate,
        ]);
        return new RateProviderResource($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
        $data = RateProvider::findorfail($id);
        $data->delete();
        return response('Data Deleted Successfully', 200);
    }
}
