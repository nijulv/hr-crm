var Payments = function(){    
    $(document).ready(function() {
        $('#payments').validate({
            rules: {
             title: {
              required: true,
             },
             user: {
              required: true
             },
             amount: {
              required: true,
              number:true

             },
            },

            highlight: function(element) {
              $(element)
              .closest('.form-group').addClass('has-error'); // set error class to the control group

              $(element)
              .closest('.form-group').find('.error').removeClass('success'); 
            },
            unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
                },
//            success: function(element) {
//             element.addClass('success').text('OK!');
//            }, 
           })
           })

}();