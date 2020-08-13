<?php

namespace App\Http\Controllers;
use App\Meal;

use Illuminate\Http\Request;


class MealsController extends Controller
{
    //
    public function index()
    {
    	$meals = Meal::paginate(5);
    return view('meals.index',compact('meals'));



    }

    public function create()
    {
        $meal = new Meal();
    	return view('meals.create',compact('meal'));

    }



    public function store()
    {

        $data = request()->validate([

            'Name' =>'required|min:3',
            'Photo' => 'sometimes|image|max:5000',
            'Description' => 'required',
            'QuantityInStock' => 'required',
            'BuyPrice' => 'required',
            'SalePrice' => 'required',

        ]);

        $PhotoPath = request('Photo')->store('uploads','public');
        $PhotoName = request('Photo')->getclientOriginalName();
       $meal = Meal::create([
                'Name' => $data['Name'],
                'Photo' => $PhotoName,
                'Description' => $data['Description'],
                'QuantityInStock' => $data['QuantityInStock'],
                'BuyPrice' => $data['BuyPrice'],
                'SalePrice' => $data['SalePrice'],




       ]);

        $this->storeImage($meal);
        

    return redirect()->route('meals.index')->with('success','Meal created successfully.');
      
    } 



    public function show(Meal $meal)
    {
        return view('meals.show',compact('meal'));
    }


    public function edit(Meal $meal)
    {
        return view('meals.edit',compact('meal'));
    }

    public function update(Request $request, Meal $meal)
    {
        $request->validate([
            'Name' =>'required|min:3',
            'Photo' => 'sometimes|image|max:5000',
            'Description' => 'required',
            'QuantityInStock' => 'required',
            'BuyPrice' => 'required',
            'SalePrice' => 'required',
            


        ]);

        $meal->update($request->all());

        $this->storeImage($meal);

        return redirect()->route('meals.index')->with('success','Meal updated successfully.');
    }


    public function destroy(Meal $meal)
    {
        $meal->delete();
        return redirect()->route('meals.index')->with('success','Meal deleted successfully.');
    }

//function storeImage pour Upload de fichiers images sous dossier storage app public avatars
    private function storeImage(Meal $meal)
    {
        if(request('Photo'))
        {
            $meal->update([
                'Photo' => request('Photo')->store('avatars','public'),
            ]);
        }
    }
}
