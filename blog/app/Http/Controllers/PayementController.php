<?php

namespace App\Http\Controllers;
use Gloudemans\Shoppingcart\Facades\Cart;

use Stripe\Stripe;
use Stripe\PaymentIntent;
use Illuminate\Http\Request;

use Illuminate\Support\Arr;//ce l'helper pour les tableau en laravel
use App\User;



class PayementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        if (Cart::count()<= 0){
            return redirect()->route('meals.index');
        }
        //consernat payement en utilise stripe en utilise method round parsque cart::total() return une chaine
        Stripe::setApiKey('sk_test_TdaoZ6TUQSusgauNjhXPLwqk00c7D1AWJP');
        $intent = PaymentIntent::create([
            'amount' => round(Cart::total()),//converti la chaine cart::total()en float
            'currency' => 'eur',
        ]);

       $clientSecret = Arr::get($intent,'client_secret');//utilise methode arr de laravel

        return view('payement.index', [
            'clientSecret' => $clientSecret
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        Cart::destroy();
        $data = $request->json()->all();
        return $data['paymentIntent'];
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
    }
}
