'Use strict';


class OrderForm {

  constructor() {
    this.$form = $('#order-form');
    this.$meal = $('#meal');
    this.$mealDetails = $('#meal-details');
    this.$quantity = $('#quantity');
    this.$orderSummary = $('#order-summary');
    this.basketSession = new BasketSession();
    this.$validateOrder = $('#validate-order');

  }

  success()
  {
      this.basketSession.clear();
  }

  onSubmit(event) {

    let mealId = this.$meal.val();
    let name = $('#meal option:selected').text();
    let quantity = this.$quantity.val();
    let salePrice = $('[type=hidden]').val();

    this.basketSession.add(mealId, name, quantity, salePrice);

    this.$form.trigger('reset');
    this.$meal.trigger('change');

    this.refreshOrderSummary();
    event.preventDefault();
    //console.log(this);
  }

  onAjaxOrderSummary(basketView) {

    this.$orderSummary.html(basketView);

    if (this.basketSession.isEmpty()) {
      this.$validateOrder.attr('disabled', true);
    } else {
      this.$validateOrder.attr('disabled', false);
    }

  }



  refreshOrderSummary() {
    let dataFields = { 'meals': this.basketSession.Items };
    $.post(getRequestUrl() + '/basket', dataFields, this.onAjaxOrderSummary.bind(this));
  }

  run() {
    this.$meal.on('change', this.onChangeMeal.bind(this));
    /*le premiere solution pour qu'il affiche au demarage  le premier produit*/
    this.onChangeMeal();
    /*lla deuxieme solution pour qu'il affiche au demarage  le premier produit
    this.$meal.trigger('Change');*/

    this.$form.find('button[type=submit]').on('click', this.onSubmit.bind(this));
    this.$orderSummary.on('click', 'button', this.onClickRemoveItem.bind(this));
    this.refreshOrderSummary();
    this.$validateOrder.on('click',this.onClickValidateOrder.bind(this));
  }

  onClickRemoveItem(event) {
    event.preventDefault();
    let mealId = $(event.currentTarget).data('mealid');
    this.basketSession.remove(mealId);
    this.refreshOrderSummary();
  }


  onChangeMeal() {

    /*recuperation de l'Id de chaque mela de la liste*/
    const mealId = this.$meal.val();
    /*Preparation de la Route*/
    const url = getRequestUrl() + '/meal?id=' + mealId;
    /*la requette AJAX*/
    $.getJSON(url, this.onAjaxMeal.bind(this));
  }


  onAjaxMeal(mealData) {

    this.$mealDetails.find('img').attr('src', getWwwUrl() + '/images/meals/' + mealData.Photo);
    this.$mealDetails.find('p').text(mealData.Description);
    this.$mealDetails.find('strong').text(formatMoneyAmount(mealData.SalePrice));
    /* enregistrer le prix (SalePrice) du produit dans la zone hidden*/
    this.$form.find('input[name=salePrice]').val(mealData.SalePrice);
  }

  onClickValidateOrder()
  {
    let dataFields = { 'items': this.basketSession.Items };
    $.post(getRequestUrl() + '/order/validate', dataFields, this.onAjaxValidation.bind(this));
  }

  onAjaxValidation(data)
  {
    console.log(data);

   let orderId = JSON.parse(data);
   
   console.log(orderId);

   if(!orderId)
   {
      // la validation de la commande a échoué
      window.location.assign(getRequestUrl()+'/user/login');
   }
   else
   {
       // la validation de la commande a réussi    
       window.location.assign(getRequestUrl()+'/order/payment?orderId=' + orderId);

   }
   
  }



}


