<script src="https://checkout.stripe.com/checkout.js"></script>
$(function () {
    var renderPaymentMethod = function () {
                var handler = StripeCheckout.configure({
                    key: 'pk_XXXXX_XXXXX', //Your publishable key from the Stripe Portal
                    image: "http://tempurl.com/logo.jpg",  //customize the Checkout popup with your logo
                    email: 'YourSoToBeCustomers@email.com',
                    token: function (token, args) {
                        //However you want to get the Token back to the server
                        AjaxPostToCreateCustomerOnToServer(token.id);  

                    }
                });

                //Stripe's  checkout.js will display a iframe modal to collect CC info
                handler.open({
                    name: 'My Awesome Business',
                    panelLabel: 'Add Payment Method',
                    description: 'AwesomeBusiness.com',
                    allowRememberMe: false
                });
            };

    $("#btnSubscribePayment").click(function () {
        renderPaymentMethod();
    });


});