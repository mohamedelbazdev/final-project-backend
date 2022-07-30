<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    use ApiResponseTrait;

    /**
     * @var Order
     */
    protected $orderModel;

    /**
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->orderModel = $order;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = validator::make($request->all(), [
            'user_id' => 'required|string',
            'provider_id' => 'required|string',
            'sender_id' => 'required|string',
            'received_id' => 'required|string',
            'description' => 'required|string',
            'amount' => 'required|string',
            'lat' => 'required|string',
            'lng' => 'required|string',
            'executed_at' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->apiResponseValidation($validator);
        }

        $order = $this->orderModel->create([
            'user_id' => Auth::id(),
            'provider_id' => $request->post('provider_id'),
            'sender_id' => Auth::id(),
            'received_id' => $request->post('received_id'),
            'description' => $request->post('description'),
            'amount' => $request->post('amount'),
            'lat' => $request->post('lat'),
            'lng' => $request->post('lat'),
            'executed_at' => $request->post('executed_at'),
        ]);

        return $this->apiResponse('successfully', $order);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
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
    }
}
