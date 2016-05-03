var Manageagent = function(){    
    $(document).ready(function() {
        $('#agents').validate({
            rules: {
             agent_code: {
              required: true,
             },
             username: {
              required: true
             },
             password: {
              required: true,

             },
             first_name: {
              required: true,
             },
             email: {
              email: true,
              required: true
             },
             phone: {
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
           $('.status').on('click', function(e){    
                      var u_id = $(this).data('id'); 
                      var url = $(this).data('url'); 
                      var status = $(this).data('status'); 
                       var ppup_content = "<b>Are you sure?</b><br><br>Do you want to "+status+" this agent?";
                      bootbox.confirm(ppup_content, function(result) {
                      if(result){
                            window.location = base_url+url+'/'+u_id
                      }
                      })
            });
            $('#agtbtnCancel').on('click', function(){   
               window.location=base_url+'manage_agents';
               return false;
            });
}();