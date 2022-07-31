<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Stripe;

class PaymentController extends Controller
{

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

       $stripeToken = $data['id'];
       Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
       $stripe = Stripe\Charge::create ([
           "amount" => 100 * 100,
           "currency" => "usd",
           "source" => $stripeToken,
           "description" => "Test payment from itsolutionstuff.com."
       ]);

       return $this->apiResponse('successfully', $stripe);

   }
}
