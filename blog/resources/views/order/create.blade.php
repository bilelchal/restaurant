@extends('layouts.app')
@section('content')

<h2><i class="fa fa-shopping-cart"></i> Passer une commande</h2>

<form data-order-step="run" action="#" method="POST" id="order-form" class="generic-form">
    <!-- Champ caché stockant le prix de vente du produit alimentaire sélectionné -->
     	      @csrf

    <input type="hidden" name="salePrice">

    

    <fieldset id="taille-image">
        <legend>Ajouter un article</legend>
        <ul>
            <li>
                <label for="meal">Nom:</label>
                <select name="meal" id="meal">
                	<?php foreach($meals as $meal):?>
                		<option value="<?=$meal['Id']?>"><?=$meal['Name']?></option>
                	<?php endforeach;?>

    
                </select>
                <article id="meal-details" class="meal-details no-left-label">
                        <img src="#" alt="Photo de produit">
                        <p></p>
                        <span>Prix: <strong></strong></span>
                </article>

            </li>
            <li>
                <label for="quantity">Quantité:</label>
                <input type="text" id="quantity" class="quantity" maxlength="2" name="quantity">
                <strong id="alert"></strong>
            </li>
            <li>
                <button class="button button-primary no-left-label" type="submit" >Ajouter AU PANIER</button>
            </li>
        </ul>
    </fieldset>

    <fieldset>
        <legend>Récapitulatif de la commande</legend>
        <section id="order-summary"></section>
    </fieldset>
</form>
<ul class="link-list">
    <li>
        <button id="validate-order" class="button button-primary" disabled>Valider la commande</button>
        <a class="button button-cancel small" href="{{ route('meals.index') }}">Annuler</a>
    </li>
</ul>




<script src="{{ asset('js/classes/BasketSession.class.js') }}"></script>
<script src="{{ asset('js/classes/OrderForm.class.js') }}"></script>
@endsection
