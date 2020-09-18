<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Stripe;

class StripePaymentController extends Controller
{
    //
    
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        return view('stripe');
    }
  
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {

        $amount = \Cart::getTotal();
      
       Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => (100 * $amount),
                "currency" => "cad",
                "source" => $request->stripeToken,
                "description" => "Test payment." 
        ]);
  
       // Session::flash('success', 'Payment successful!');
          
      //  return back();
      \Cart::clear();
      return redirect()->route('cart.index')->with('success_msg', 'Payment successful!');
    }
}
