@extends('layouts.app')
@section('content')
<div class="row">
        <div class="col-lg-12">
            <h2 class="text-center">Add Booking</h2>
        </div>
        <div class="col-lg-12 text-center" style="margin-top:10px;margin-bottom: 10px;">
            <a class="btn btn-primary" href="{{ route('meals.index') }}"> Back</a>
        </div>
</div>

       
<form class="generic-form" action="{{ route('booking.store') }}" method="POST">
 	      @csrf

    <fieldset>
 		<legend>RESERVATION D'UNE TABLE</legend>
 	
 	<ul>
         <li>
                <label for="reservation">Date de resérvation :</label>
                <select id="reservation" name="reservationDay" >
                    <?php for($day = 1; $day <= 31; $day++): ?>
                        <option value="<?= $day ?>"><?= $day ?></option>
                    <?php endfor; ?>
                </select>

                <span> / </span>

                <select name="reservationMonth">
                    <option value="1">Janvier</option>
                    <option value="2">Février</option>
                    <option value="3">Mars</option>
                    <option value="4">Avril</option>
                    <option value="5">Mai</option>
                    <option value="6">Juin</option>
                    <option value="7">Juillet</option>
                    <option value="8">Août</option>
                    <option value="9">Septembre</option>
                    <option value="10">Octobre</option>
                    <option value="11">Novembre</option>
                    <option value="12">Décembre</option>
                </select>
                <span> / </span>
                <select name="reservationYear">
                    <?php for($year = 2020; $year <= 2023; $year++): ?>
                        <option value="<?= $year; ?>"><?= $year; ?></option>
                    <?php endfor; ?>
                </select>

                à :

                <select name="reservationHour">
                    <?php for($hour = 12; $hour <= 23; $hour++): ?>
                        <option value="<?= $hour; ?>"><?= $hour; ?></option>
                    <?php endfor; ?>
                </select>

                <select name="reservationMinute">
                    <option value="00">00</option>
                    <option value="15">15</option>
                    <option value="30">30</option>
                    <option value="45">45</option>                    
                </select>


            </li>
                        <!--SELECT :NOMBRE DE COUVERT-->
            <li>
                <label>Nombre de couvert(s) :</label>
                <select id="nbCouvert" name="nombreCouvert" >
                    <?php for($i = 1; $i <= 8; $i++): ?>
                        <option value="<?= $i ?>"><?= $i ?></option>
                    <?php endfor; ?>
                </select>
            </li>
    	</ul>
    </fieldset>
    <ul>
        <li>
            <input class="button button-primary" type="submit" value="Réserver">
            <a class="button button-cancel small" href="{{ route('meals.index') }}">Annuler</a>
        </li>
    </ul>
</form>

@endsection
