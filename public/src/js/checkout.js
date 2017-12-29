var stripe = Stripe('pk_test_M0RKTQbv97ol7CwOS0kcV7Sl');

var $form = $('#checkout-form');

/*var elements = stripe.elements();
var card = elements.create('card');
card.mount('#card-element');
*/
// var card = elements.create('card');
// card.mount('#card-element');
// var card = elements.create('card');
// card.mount('#card-element');
// var card = elements.create('card');
// card.mount('#card-element');
// var card = elements.create('card');
// card.mount('#card-element');
// var card = elements.create('card');
// card.mount('#card-element');
//


$form.submit(function (event) {
    $('#charge-error').addClass('hidden');
    $form.find('button').prop('disabled', true);
    stripe.createToken('bank_account', {
        country: 'US',
        currency: 'usd',
        routing_number: '110000000',
        account_holder_type: 'individual',
        account_number: $('#card-number').val(),
        account_holder_name: $('#card-name').val(),
        //exp_month : $('#card-expiry-month').val(),
        //exp_year : $('#card-expiry-year').val()

}).then(function(result) {
        // Handle result.error or result.token
        console.log("boss");
        if(result.error){
            window.alert("haha");
            console.log("haha");
            $('#charge-error').removeClass('hidden');
            $('#charge-error').text(result.error.message);
            $form.find('button').prop('disabled', false);
        }else{
            window.alert("yuyu");
            console.log("uyyu");
            var tokenn = result.token.id;
            $form.append($('<input type="hidden" name="stripeToken" />').val(tokenn));
            $form.find('button').prop('disabled', false);
            $form.get(0).submit();
        }
    });
    return false;
});


// stripe.createToken(card).then(function(result) {
//     // Handle result.error or result.token
// });
//
//
// stripe.createToken('bank_account', {
//     country: 'US',
//     currency: 'usd',
//     routing_number: '110000000',
//     account_number: $('#card-number').val(),
//     account_holder_name: $('#card-name').val(),
//     account_holder_type: 'individual',
// }).then(function(result) {
//     // Handle result.error or result.token
// });
//
