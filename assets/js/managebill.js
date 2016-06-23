var bill_contents = function(){    
    $(document).ready(function() {
        $('#bill_contents').validate({
            rules: {
             company_name: {
                required: true,
                minlength: 3
             },
             company_email: {
                required: true,
                email: true
             },
             company_phone: {
                minlength: 10,
                maxlength: 10,
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
                
           })
           })

}();