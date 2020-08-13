@extends('layouts.app')
@section('content')
<div class="row">
        <div class="col-lg-12">
            <h2 class="text-center">Add Meal</h2>
        </div>
        <div class="col-lg-12 text-center" style="margin-top:10px;margin-bottom: 10px;">
            <a class="btn btn-primary" href="{{ route('meals.index') }}"> Back</a>
        </div>
</div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

<h2>Ajout d'un produit alimentaire</h2>

<form class="generic-form" action="{{ route('meals.store') }}" method="POST" enctype="multipart/form-data">
	@csrf

	
									<!-- FIELDSET CARACTERISTIQUES-->
	<fieldset>
		<legend>Caracteristiques</legend>
		<ul>
			<li>
				<label>Nom :</label>
				<input type="text" name="Name" value="{{ old('Name')}}">
			</li>
			<li>
				<label>Photo : </label>
				<input type="file" name="Photo" />
			</li>
			<li>
				<label>Description :</label>
				<textarea name="Description">{{ old('Description') }}</textarea>
			</li>
			
		</ul>
		<p>Merci de renomer le fichier de la photo avec le nom de l'aliment avant de l'envoyer</p>
	</fieldset>
                  				      <!-- FIELDSET APROVISIONNEMENT-->
	<fieldset>
		<legend>Approvisionnement</legend>
		<ul>
			<li>
				<label>Stock initial :</label>
				<input type="text" name="QuantityInStock" size="20" value="{{ old('QuantityInStock') }}">
			</li>
			<li>
				<label>Prix d'achat  :</label>
				<input type="text" name="BuyPrice" size="30" value="{{ old('BuyPrice') }}">
				<label>  €</label>
			</li>
			<li>
				<label>Prix de vente  :</label>
				<input type="text" name="SalePrice" size="30" value="{{ old('SalePrice') }}">
				<label>  €</label>
			</li>
		</ul>
		
	</fieldset>

	<ul>
        <li>
            <input class="button button-primary" type="submit" value="ajouter">
            <a class="button button-cancel small">Annuler</a>
        </li>
    </ul>
</form>

                  <!--************* AFFICHAGE DES MEALS *******************-->


 	
@endsection
