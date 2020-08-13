<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\User;
use App\Meal;

class OrdersController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    




    public function create()
    {
    	$meal = new Meal();
        $meals = $meal->all();
    	return view('order/create',compact('meals'));

    }

    


    public function show()
    {
    	$orders = Order::paginate(5);
    return view('order/show',compact('orders'));



    }



}
