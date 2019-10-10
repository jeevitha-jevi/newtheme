function creaditCardDetails() {
      /*jshint validthis: true */
      
      //var vm = this;
      Stripe.setPublishableKey('pk_test_7vp1WEu0o1IOyLilC0WhkVXs');

      $(function() {
        var $form = $('#payment-form');
        $form.submit(function(event) {


          // Disable the submit button to prevent repeated clicks:
          $form.find('.submit').prop('disabled', true);

          // Request a token from Stripe:
          Stripe.card.createToken($form, stripeResponseHandler);
          // console.log(response);
          // Prevent the form from being submitted:
          return false;
        });
      });
    function stripeResponseHandler(status, response) {
      
        // Grab the form:
        var $form = $('#payment-form');

        if (response.error) { // Problem!

          // Show the errors on the form:
          $form.find('.payment-errors').text(response.error.message);
          $form.find('.submit').prop('disabled', false); // Re-enable submission

        } else { // Token was created!

          // Get the token ID:
          let token = JSON.stringify({tokenid: response.id, quantity:15.00});
          var tok=JSON.parse(token);
          // debugger
        
        
          //$state.transitionTo('paymentstatus');
           //$state.transitionTo('paymentstatus', { user_id: $rootScope.user_id });
          // $state.go("login");
            
          // Insert the token ID into the form so it gets submitted to the server:
          $form.append($('<input type="hidden" name="stripeToken">').val(token));
         

          var modalDetails={
                        'id':tok.tokenid,
                        'quantity':tok.quantity,
                        'user':$('#email').val(),
                        'plan':$('#plan').val()
                        };

           $.ajax({
        dataType: "json",
        type: "POST",
        url: "/freshgrc/php/common/stripePayment.php",
        data: modalDetails,
        success:success
           });
              
          
           
          // Submit the form:
          
         
        }
      }

    }
    function success(data){
      var $form = $('#payment-form');
      debugger
       swal({ 
           title:  'Payment successful',
           confirmButtonColor: '#3085d6',
           confirmButtonText:'ok'
            });

          var modalDetails= {
      'company':$('#company').val(),
      'plan':$('#planId').val(),
      'stripe_subscription_id':data.subscriptions.data[0].id,
      'plan_id':data.subscriptions.data[0].plan.id,
      'current_period_end':data.subscriptions.data[0].current_period_end,
      'quantity':data.subscriptions.data[0].quantity,
      'current_period_start':data.subscriptions.data[0].current_period_start,
      'trial_start':data.subscriptions.data[0].trial_start,
      'trial_end':data.subscriptions.data[0].trial_end,
      'started_at':data.subscriptions.data[0].start,
      'next_payment_at':data.subscriptions.data[0].days_until_due,
      'ended_at':data.subscriptions.data[0].canceled_at,
      'status':data.subscriptions.data[0].status


    }
    $.ajax({
          type: "POST",
        url: "/freshgrc/php/common/subscriptionControlManager.php",
        data: modalDetails        
    }).done(function (data) {
         
       //window.location="/view/common/subscriptionCreate.php";
       $form.get(0).submit();

          window.location="/freshgrc/view/common/payment.php";

    });
       
    }