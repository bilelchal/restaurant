'Use strict';

class BasketSession
{

	constructor()
	{
		this.Items = null ;
		this.load();
	}

	load()
	{
		this.Items = loadDataFromDomStorage('panier');

		if(this.Items == null)
		{
			this.Items = [];
		}
	}


	save()
	{
		saveDataToDomStorage('panier',this.Items)
	}


	add(mealId,name,quantity,salePrice)
	{

		if(isNaN(quantity) || !isInteger(quantity))
		{
			$('#alert').text('La quantité doit être un entier')
			return;
		}

		if(parseInt(quantity) <= 0)
		{
			$('#alert').text('La quantité doit être supérieure à zero!')
			return;	
		}

		/*Version1
		for(let i=0; i< this.Items.length ; i++)
		{
			if(this.Items[i].mealId == mealId)
			{
				this.Items[i].quantity += quantity;	
				save();
				return;
			}
		}

		this.Items.push
		(
			{
				mealId:mealId,name:name,quantity:quantity,salePrice:salePrice
			}
		);
		save();
		*/

		//V2
		let meal;

		if(meal = this.Items.find(function(elt){return elt.mealId == mealId}))
		{

			meal.quantity = parseInt(meal.quantity) + parseInt(quantity);
			this.save();
			return;
		}
		
		this.Items.push
		(
			{
				mealId:mealId,name:name,quantity:parseInt(quantity),salePrice:parseFloat(salePrice)
			}
		);
		this.save();
	}


	remove(mealId)
	{
		for(let i=0; i<this.Items.length; i++)
		{
			if(this.Items[i].mealId == mealId)
			{
				this.Items.splice(i,1);					
				this.save();
				return true;
			}
		}

		return false;
	}


	clear()
	{
		this.Items = null;
		this.save();
	}

	isEmpty()
	{
		if(this.Items.length == 0)
		{
			return true;
		}

		return false;
	}

} 