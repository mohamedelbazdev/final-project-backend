<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Stripe;

class PaymentController extends Controller
{

  use ApiResponseTrait;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws Stripe\Exception\ApiErrorException
     */
   public function pay(Request $request){
       $validator = validator::make($request->all(), [
           'order_id' => 'required|exists:orders,id',
           'card_number' => 'required|string',
           'card_exp_month' => 'required|string',
           'card_exp_year' => 'required|string',
           'card_cvc' => 'required|string',
       ]);

       if ($validator->fails()) {
           return $this->apiResponseValidation($validator);
       }

       $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

       $data = $stripe->tokens->create([
           'card' => [
               'number' => $request->post('card_number'),
               'exp_month' => $request->post('card_exp_month'),
               'exp_year' => $request->post('card_exp_year'),
               'cvc' => $request->post('card_cvc'),
           ],
       ]);

       $order = Order::whereIdAndPaid($request->post('order_id'), '0')->whereSenderId(Auth::id())->first();

       if($data['id'] && $order){

           $stripeToken = $data['id'];
           Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
           $stripe = Stripe\Charge::create ([
               "amount" => $order['amount'],
               "currency" => "usd",
               "source" => $stripeToken,
               "description" => "Test payment from itsolutionstuff.com."
           ]);
//           return $this->apiResponse('successfully', $stripe->paid === true);

           if($stripe && $stripe->paid === true){

               $order->update(['paid' => 1]);

               Payment::create([
                   'order_id' => $order['id'],
                   'amount' => $stripe['amount'],
                   'currency' => $stripe['currency'],
                   'source' => $stripe['source']->id,
                   'description' => $stripe['description'],
                   'strip_id' => $stripe['id']
               ]);

               return $this->apiResponse('successfully', $order);
           }
           return $this->apiResponse('error charged', null, 422, 'error');
       }

       return $this->apiResponse('error in order', null, 422, 'error');
   }
}
