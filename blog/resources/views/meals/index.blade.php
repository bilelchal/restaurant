@extends('layouts.app')
@section('content')

<div class="row">

<div class="col-lg-12 text-center" style="margin-top:10px;margin-bottom: 10px;">
    <a class="btn btn-success " href="{{ route('meals.create') }}"> Ajoute Meal</a>
</div>
</div>
@if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
@endif


<!-- Liste des aliments -->
<table class="generic-table meal-list">
    <caption>Carte du restaurant</caption>
    <tbody>
    	<?php foreach($meals as $meal):?>
    		<tr>

    			<td><img src="{{ asset('images/meals') }}/<?=$meal['Photo']?>"></td>
    			<td>
    				<h5><?=$meal['Name']?></h5>
    				<p><?=$meal['Description']?></p>    				
    			</td>

    			<td><?=number_format($meal['SalePrice'],2)?>€</td>

                <td>
                        <form action="{{ route('meals.destroy',$meal->Id) }}" method="POST">

                            <a class="btn btn-info" href="{{ route('meals.show',$meal->Id) }}">Show</a>
                            <a class="btn btn-primary" href="{{ route('meals.edit',$meal->Id) }}">Edit</a>

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                </td>
                <td>
                    <form action="{{ route('cart.store') }}" method="POST" >
                             @csrf
                            <input type="hidden" name="Id" value="{{ $meal->Id }}">
                            

                        <button type="submit" class="btn btn-dark">Ajoute au panier</button>

                    </form>
                </td>
    			
    		</tr>
        <?php endforeach;?>
    </tbody>
</table>
<div class="row d-flex">
{{ $meals->links()}}
</div>


@endsection
