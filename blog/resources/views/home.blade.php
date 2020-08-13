@extends('layouts.app')
@section('content')



@if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
@endif

<div class="row">
@can('create','App\User')
<div class="col-lg-12 text-center" style="margin-top:10px;margin-bottom: 10px;">
    <a class="btn btn-success " href="{{ route('meals.create') }}"> Ajoute Meal</a>
</div>
@endcan
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

                @can('create','App\User')
                <td>
                        <form action="{{ route('meals.destroy',$meal->Id) }}" method="POST">

                            <a class="btn btn-info" href="{{ route('meals.show',$meal->Id) }}">Show</a>
                            <a class="btn btn-primary" href="{{ route('meals.edit',$meal->Id) }}">Edit</a>

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                </td>
                @endcan
                
                
            </tr>
        <!-- Code HTML à écrire -->
        <?php endforeach;?>
    </tbody>
</table>
<div class="row d-flex">
{{ $meals->links()}}
</div>


@endsection
