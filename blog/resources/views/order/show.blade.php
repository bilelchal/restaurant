
@extends('layouts.app')
@section('content')
<h2> Panneau d'administration </h2>


<fieldset>
        <legend><i class="fa fa-book"></i> Historique des commandes</legend>

        <table class="generic-table meal-list">


    <thead>
    <tr>
      <th>Num commande </th>
      <th>Num user</th>
      <th>Date creation</th>
      <th>Date succ</th>
      <th>tva</th>
      <th>Prix tva</th>
      <th>Total</th>
    </tr>
  </thead>
   
    <tbody>
    	<?php foreach($orders as $order):?>
    		<tr>

    			<td>
    				<?=$order['Id']?>
    			</td>
    			<td>
    				<?=$order['User_Id']?>
    			</td>
    			<td>
    				<?=$order['CreationTimestamp']?>
    			</td>
    			<td>
    				<?=$order['CompleteTimestamp']?>
    			</td>
    			<td>
    				<?=$order['TaxRate']?>
    			</td>
    			<td>
    				<?=$order['TaxAmount']?>
    			</td>
    			<td>
    				<?=$order['TotalAmount']?>
    			</td>

    			
    		</tr>
        <?php endforeach;?>
    </tbody>
</table>
        
		
</fieldset>
	
          
@endsection