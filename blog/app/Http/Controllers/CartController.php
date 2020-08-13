<?php

namespace App\Http\Controllers;
use App\Meal;
use App\User;
//import la facade 
use Gloudemans\Shoppingcart\Facades\Cart;

use Illuminate\Http\Request;


class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cart.index');
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
        //on cherche si meal deja ajoute au panier si nn w l'ajoute
      /*$duplicates = Cart::search(function ($cartItem, $rowId) use ($request) {
            return $cartItem->id = $request->Id;
        });

        if ($duplicates->isNotEmpty()) {
            return redirect()->route('meals.index')->with('success', 'meal deja ajoute!');
        }*/
        $meal = Meal::find($request->Id);

        Cart::add($meal->Id, $meal->Name, 1, $meal->SalePrice)
            ->associate('App\Meal');

        return redirect()->route('meals.index')->with('success', 'meal a bien ajoute!');
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
    public function update(Request $request, $rowid)
    {
        $data = $request->json()->all();

        Cart::update($rowid,$data['qty']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($rowId)
    {
        Cart::remove($rowId);
        return redirect()->route('cart.index')->with('success', 'le produit a ete supprime');

    }
}
