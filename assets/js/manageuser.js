var Manageuser = function(){    
    $(document).ready(function() {
      
        $('#frmUserdetails').validate({
            rules: {
             firstname: {
              minlength: 3,
              required: true,
             },
             useremail: {
              minlength: 2,
              required: true
             },
             phonenumber: {
              minlength: 10,
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
                       
            $('#btnCancel').on('click', function(){   
               window.location=base_url+'manageuser';
               return false;
            }); 
            
            $('#btnCancelagent').on('click', function(){   
               window.location=base_url+'manage_agents';
               return false;
            }); 
            
           $('.delete').on('click', function(e){    
                      var u_id = $(this).data('id'); 
                      var url = $(this).data('url'); 
                      console.log(url);
                      var ppup_content = "<b>Are you sure?</b><br><br>Do you want to delete this details?";
                      bootbox.confirm(ppup_content, function(result) {
                      if(result){
                            window.location = base_url+url+'/'+u_id
                      }
                      })
            });
}();
