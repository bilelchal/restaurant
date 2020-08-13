@extends('layouts.app')
@section('extra-meta')
<!-- pour renforce la secrite quan en utilise une requete ajax au nivean de cette page index en ce mettant une nouvelle meta -->

<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection


@section('content')
<div class="row">
        
    <div class="col-lg-12 text-center" style="margin-top:10px;margin-bottom: 10px;">
        <a class="btn btn-primary" href="{{ route('meals.index') }}"> Back</a>
    </div>
</div>
@if (Cart::count()> 0)
	<h2><i class="fa fa-check"></i> Payer la commande</h2>

<fieldset>

<legend>Récapitulatif de la commande</legend>

<table class="generic-table meal-list">
     
   
    
    <tbody>
        <?php foreach(Cart::content() as $meal):?>
            <tr>
               <td>
                <img src="{{ asset('images/meals') }}/{{ $meal->model->Photo }}">
                <em>{{ $meal->model->Name }}</em>
                      

               </td>
                <td><?=number_format($meal->model->SalePrice,2) ?>€</td>
                <td>
                    <select name="qty" id="qty" class="custom-select" data-id="{{ $meal->rowId }}">
                        @for ($i = 1 ; $i < 10; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </td>
                <td>
                	<form action="{{ route('cart.destroy',$meal->rowId) }}" method="POST" >
                             @csrf
                            @method('DELETE')
                            

                        <button class="button button-cancel " type="submit" class="btn btn-dark">
                        	<i class="fa fa-trash"></i>
                        </button>

                    </form>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</fieldset>

<div>
	<fieldset>
		<legend>Détail de la commande!</legend>
		<ul class="list-unstyled mb-4 text-right">
			<li>
				<strong>Sous Total: </strong><strong>{{Cart::subtotal() }}€</strong>
			</li>
			<li>
				<strong>Taxe: </strong><strong>{{Cart::tax() }}€</strong>
			</li>
			<li>
				<strong>Total: </strong><strong>{{Cart::total() }}€</strong>
			</li>
		</ul>
	</fieldset>
</div>

<hr>
<h3>Merci de bien vouloir procéder au paiement de la commande.</h3>
	<ul class="list-unstyled mb-4">
		<li>
			<a class="btn button button-primary" href="{{ route('payement.index') }}">Passer a la caisser</a>
		</li>
	</ul>


@else
<p>votre panier est vide</p>

@endif

@endsection

@section('extra-js')
<script>
    var seclects = document.querySelectorAll('#qty');
    //transforme les selects en tableau
    Array.from(seclects).forEach((element)=> {
        element.addEventListener('change',function()
        {
            var rowId = this.getAttribute('data-id');
            var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch(
                '/panier/${rowId}',
            {
                headers: {

                         "Content-Type":"application/json",//pour force le json
                         "Accept":"application/json, test-plain",
                         "X-Requested-With":"XMLHttpRequest",
                         "X-CSRF-TOKEN":token
                            },
                
                methode:'patch',
                    body: JSON.stringgify({
                        qty = this.value // donne la valeur selection
                    })
            }).then((data) => {
                console.log(data);
            }).catch((error) => {
                console.log(error)
            })
        });

    });
</script>
@endsection
