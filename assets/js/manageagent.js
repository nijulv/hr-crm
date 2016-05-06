var Manageagent = function(){    
    $(document).ready(function() {
        $('#agents').validate({
            rules: {
             agent_code: {
              required: true,
              minlength: 3,
             },
             username: {
              required: true,
              minlength: 5
             },
             password: {
              required: true,
              minlength: 5

             },
             first_name: {
              required: true,
              minlength: 3
             },
             email: {
              email: true,
              required: true
             },
             phone: {
              minlength: 10,
              maxlength: 10,
              required: true,
              number:true
             },
             state: {
              required: true
             },
             district: {
               required: true
             },
             city: {
              required: true,
              minlength: 3
             },
             pincode: {
              minlength: 6,
              maxlength:6,
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
}();
    
    // can only type number function    // add [onkeypress='numberValidate(event)] in text box
    function numberValidate(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
    
    // not allowed speal characters
    function blockSpecialChar(e){
        var k;
        document.all ? k = e.keyCode : k = e.which;
        return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 9 || k == 8 || k == 32 || k == 34 || k == 39 || k == 9 || (k >= 48 && k <= 57));
    }
    
    // Hide display msgs after few seconds later
    setTimeout(function() {
            $(".alert").fadeOut();
    }, 3000);
    

    $('#bank_payment').on('blur', function(e){  
        
        var bank_amount = parseInt($(this).val());   
        var total_amount = parseInt($('#total_payment').val());      
        
        if(total_amount < bank_amount) {        
            
            $("#warning_msg").html("Bank amount must be less than total amount");
            $("#warning_msg").show(500);
            $('#bank_payment').val('');
        }
        else {
            $("#warning_msg").hide();  
        }
       
    });
    
    $('#total_payment').on('blur', function(e){  
        
        var total_amount  = parseInt($(this).val());   
        var bank_amount = parseInt($('#bank_payment').val());      
        
        if(total_amount < bank_amount) {        
            
            $("#warning_msg").html("Bank amount must be less than total amount");
            $("#warning_msg").show(500);
            $('#bank_payment').val('');
        }
        else {
            $("#warning_msg").hide();  
        }
       
    });
    
    $(".more").click(function(){   
        $('#moreDetails').modal('show');
        var from  = $(this).attr("data-from");        
        if(from == 'agent')
            $('#data-title').html("Agent: More details");
        else if(from == 'payment')
            $('#data-title').html("Payment: More details");

        var id              = $(this).attr("data-id");

        var request_path    = base_url+"viewmore/"+from+"/"+id;
        console.log(request_path);
        $.post(request_path,function(data){
            $("#data-output").html(data);
        });
    });
    
    
    $("#todate_search").mouseover(function(){  
        $('#todate_search').datepicker({
            format: "yyyy-mm-dd"
        });  

    });

    $("#fromdate_search").mouseover(function(){  
        $('#fromdate_search').datepicker({
            format: "yyyy-mm-dd"
        });  

    });
    
    
    $("#todocontent").on("mouseover","#popup_calender",function(){  
         $('#popup_calender').datepicker({
            format: "yyyy-mm-dd"
        });  
        
    });
    
