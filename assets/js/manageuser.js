var Manageuser = function(){    
    $(document).ready(function() {
      
        $('#frmUserdetails').validate({
            rules: {
             firstname: {
              minlength: 2,
              required: true,
             },
             useremail: {
              minlength: 2,
              required: true
             },
             phonenumber: {
              minlength: 2,
              required: true
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