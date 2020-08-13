@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h2 class="text-center">Edit Meal</h2>
        </div>
        <div class="col-lg-12 text-center" style="margin-top:10px;margin-bottom: 10px;">
            <a class="btn btn-primary" href="{{ route('meals.index') }}"> Back</a>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('meals.update',$meal->Id) }}" method="POST">
        @csrf
        @method('PUT')

        <fieldset>
        <legend>Caracteristiques</legend>
        <ul>
            <li>
                <label>Nom :</label>
                <input type="text" name="Name" value="{{ $meal->Name }}">
            </li>
            <li>
                <label>Photo : </label>
                <input type="file" name="Photo" />
            </li>
            <li>
                <label>Description :</label>
                <textarea name="Description">{{ $meal->Description }}</textarea>
            </li>
            
        </ul>
        <p>Merci de renomer le fichier de la photo avec le nom de l'aliment avant de l'envoyer</p>
    </fieldset>

    <fieldset>
        <legend>Approvisionnement</legend>
        <ul>
            <li>
                <label>Stock initial :</label>
                <input type="text" name="QuantityInStock" size="20" value="{{ $meal->QuantityInStock }}">
            </li>
            <li>
                <label>Prix d'achat  :</label>
                <input type="text" name="BuyPrice" size="30" value="{{ $meal->BuyPrice }}">
                <label>  €</label>
            </li>
            <li>
                <label>Prix de vente  :</label>
                <input type="text" name="SalePrice" size="30" value="{{ $meal->SalePrice }}">
                <label>  €</label>
            </li>
        </ul>
        
    </fieldset>
    <ul>
        <li>
            <input class="button button-primary" type="submit" value="Edite">
            <a class="button button-cancel small">Annuler</a>
        </li>
    </ul>

    </form>
@endsection