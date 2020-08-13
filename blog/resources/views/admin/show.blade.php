@extends('layouts.app')
@section('content')

<fieldset>
        <legend><i class="fa fa-book"></i> Liste de users</legend>

<table class="generic-table ">	
        <thead>
            <tr>
                <th>Id </th>
                <th>name</th>
                <th>Email</th>
                <th>Admin</th>
                
            </tr>
        </thead>

		<tbody>
			<?php foreach($users as $user):?>
    		<tr>
    			<td>
    				
                    <?=$user['id']?>    			
                </td>
                <td>
                 <?=$user['name']?>   
                </td>
                <td>
                    <?=$user['email']?>
                </td>
                <td>
                    <?=$user['admin']?>

                    
                </td>
                <td>
                    <input type="checkbox" name="userid[]" value="<?=$user['id']?>" <?php if($user['admin']==1)echo 'checked';?> >
                            
                </td>

    			
	
    		</tr>
            
        
        	<?php endforeach;?>
		</tbody>


	</table>
    <div class="row d-flex">
{{ $users->links()}}
</div>

</fieldset>


@endsection
