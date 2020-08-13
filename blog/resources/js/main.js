'use strict';

/////////////////////////////////////////////////////////////////////////////////////////
// FONCTIONS                                                                           //
/////////////////////////////////////////////////////////////////////////////////////////

function RunOrderForm()
{
	if(typeof(OrderForm)!= 'undefined')
	{
		const orderForm = new OrderForm();	

		const step = $("[data-order-step]").data("order-step");
		
		switch(step)
		{
			case 'run':
				orderForm.run();
			break;

			case 'success':
				orderForm.success();
		}

	}
}


function RunFormValidator()
{
	const formValidator = new FormValidator();

}
/////////////////////////////////////////////////////////////////////////////////////////
// CODE PRINCIPAL                                                                      //
/////////////////////////////////////////////////////////////////////////////////////////

$(function(){

	RunOrderForm();
	RunFormValidator();

});









