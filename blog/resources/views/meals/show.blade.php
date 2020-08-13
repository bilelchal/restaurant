@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h2 class="text-center">Show meal</h2>
        </div>
        <div class="col-lg-12 text-center" style="margin-top:10px;margin-bottom: 10px;">
            <a class="btn btn-primary" href="{{ route('meals.index') }}"> Back</a>
        </div>
    </div>

    <div class="row">
    <div class="col-xs-4 col-sm-4 col-md-4">
    	<img src="{{ asset('images/meals') }}/<?=$meal['Photo']?>">

   	</div>

   	<div class="col-xs-8 col-sm-8 col-md-8">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $meal->Name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description:</strong>
                {{ $meal->Description }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Quantity In Stock:</strong>
                {{ $meal->QuantityInStock }}
            </div>
        </div>
    </div>
    </div>
@endsection