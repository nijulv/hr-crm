
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
            star_rate: {
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
                       
            $('#btnCancel_paymentbank').on('click', function(){   
               window.location=base_url+'manage_cash';
               return false;
            }); 
            
            $('#btnCancel_payment').on('click', function(){   
               window.location=base_url+'manage_payment';
               return false;
            }); 
            
            $('#btnCancel').on('click', function(){   
               window.location=base_url+'manageuser';
               return false;
            }); 
            
            $('#btnCancelagent').on('click', function(){   
               window.location=base_url+'manage_agents';
               return false;
            }); 
            
            
            $('.savetax').on('click', function(e){    
                if ($.trim($("#tax_name").val()) == "")
                {
                    $("#tax_name").next(".validation_msg").html("Tax name not entered");
                    $("#tax_name").focus();
                    return false;
                } 
                else if ($.trim($("#tax_percentage").val()) == "")
                {
                    $("#tax_percentage").next(".validation_msg").html("Tax value not entered");
                    $("#tax_percentage").focus();
                    return false;
                }
                else {
                    $.post(base_url+"tax_add", $(".form_tax").serialize(),
                    function(response) {
                            var data = $.parseJSON(response);
                            if (data["status"] == 1) {
                                    $(".err_msg").html(data["msg"]);
                                    $( ".err_msg" ).removeClass( "alert alert-danger" ).addClass( "alert alert-success" );
                                    $(".err_msg").show(500);
                                    setTimeout(function() {
                                            window.location = base_url+"manage_tax";
                                    }, 2000);
                            } 
                            else {
                                    $(".err_msg").html(data["msg"]);
                                    $( ".err_msg" ).removeClass( "alert alert-success" ).addClass( "alert alert-danger" );
                                    $(".err_msg").show(500);
                                    setTimeout(function() {
                                            window.location = base_url+"manage_tax";
                                    }, 2000);
                            }
                    });
                } 
           });
           
            $('.edit_tax').on('click', function(e){ 
               
               var id = $(this).data('id'); 
               var name = $(this).data('name'); 
               var value = $(this).data('value');   
               
                $("#adddiv").show('600');
               $("#sub_title").html('Modify Tax');
               $("#tax_name").val(name);
               $("#tax_percentage").val(value);
               $("#tax_id").val(id);
            });
           
           $('.addnewtax').on('click', function(e){    
               $("#adddiv").toggle('600');
               $("#tax_name").val('');
               $("#tax_percentage").val('');
               $("#sub_title").html('Add Tax');
           });
           
           $('.edit_caterory').on('click', function(e){    
               var id = $(this).data('id'); 
               var name = $(this).data('name'); 
               
               $("#category_name").val(name);
               $("#category_id").val(id);
           });
           
           $('.savecategory').on('click', function(e){    
               if ($.trim($("#category_name").val()) == "")
                {
                    $("#category_name").next(".validation_msg").html("Category name name not entered");
                    $("#category_name").focus();
                    return false;
                } 
                else {
                    $.post(base_url+"category_add", $(".form_category").serialize(),
                    function(response) {
                            var data = $.parseJSON(response);
                            if (data["status"] == 1) {
                                    $(".err_msg").html(data["msg"]);
                                    $( ".err_msg" ).removeClass( "alert alert-danger" ).addClass( "alert alert-success" );
                                    $(".err_msg").show(500);
                                    setTimeout(function() {
                                            window.location = base_url+"manage_category";
                                    }, 2000);
                            } 
                            else {
                                    $(".err_msg").html(data["msg"]);
                                    $( ".err_msg" ).removeClass( "alert alert-success" ).addClass( "alert alert-danger" );
                                    $(".err_msg").show(500);
                                    setTimeout(function() {
                                            window.location = base_url+"manage_category";
                                    }, 2000);
                            }
                    });
                } 
           });
           
           $('.delete').on('click', function(e){    
                      var u_id = $(this).data('id'); 
                      var url = $(this).data('url'); 
                      console.log(url);
                      var ppup_content = "<b>Are you sure?</b><br><br>Do you want to delete this record?";
                      bootbox.confirm(ppup_content, function(result) {
                      if(result){
                            window.location = base_url+url+'/'+u_id
                      }
                      })
            });
            
            $('.generate_invoice').on('click', function(e){    
                    var p_id = $(this).data('id'); 
                    window.location = base_url+'generate_invoice'+'/'+p_id
            });
            
            
            $('.agree_bankpayment').on('click', function(e){    
                var id = $(this).data('id');   
                var url = $(this).data('url'); 
                console.log(url);
                var ppup_content = "<b>Are you sure?</b><br><br>Do you want to agree this payment?";
                bootbox.confirm(ppup_content, function(result) {
                    if(result){
                          window.location = base_url+url+'/'+id
                    }
                })
            });
            
            // Disagree payment
            $(".disagree_bankpayment").click(function () {
                $('#moreDetails').modal('show');
                $('#data-title').html("Disagree bank payment");
                var id              = $(this).attr("data-id");         
                var request_path    = base_url+"disagree_bankpayment/"+id;
                console.log(request_path);
                $.post(request_path,function(data){  
                    $("#data-output").html(data);
                });
            })
            
            $(document).on("click","#disagree_paymentsubmitbtn",function () {  
                var reason = 'reason' + $("#reason").val();
                var id = $("#id").val();                 
                window.location = base_url + "disagree_bankpayment_submit/" + reason + "/" + id ;
            });
    

            $('#btn-todo').on('click', function(){   
                if(''!= $('#todo').val()){
                    $('#myModal').modal();
                    return false;
                }
                else {
                     $(".shedule").html("Please type a note");
                     $(".shedule").show();
                     setTimeout(function() { $(".shedule").hide(); }, 3000);
                } 
            });
            
            
            $('#todo-panel').on('click','.deletetodo', function(){ 
       
                 var todo_id = $(this).data('id'); 
                 var todourl = $(this).data('url'); 
                 var ppup_content = "<b>Are you sure?</b><br><br>Do you want to delete this details?";
                 bootbox.confirm(ppup_content, function(result) {
                      if(result){
                                $.ajax({
                                    type    : "POST",
                                    url     : base_url+todourl+'/'+todo_id,
                                    dataType: "json",
                                    success : function(data){
                                                $('.panel-footer font').remove();
                                                $('#'+todo_id).remove();
                                                $('.panel-footer').append(data.msg);
                                                $('.panel-footer font').delay(2000).fadeOut();
                                    }
                                });
                        }
                      })
                 
            })
            $('#todo-panel').on('click','.edittodo', function(){ 
                 var todo_id = $(this).data('id'); 
                 var todourl = $(this).data('url'); 
                  $.ajax({
                        type    : "POST",
                        url     : base_url+todourl+'/'+todo_id,
                        success : function(data){    
                            
                            var data = $.parseJSON(data);  
                            
                            var todoid = data["todoid"];
                            var todotext = data["todotext"];
                            var date = data["date"];
                            
                            $("#todoid_edit").val(todoid);
                            $("#todotext_edit").val(todotext);
                            $("#popup_calender").val(date);
                            
                            $('#editModal').modal();
                        }
                    });
                 
 
             });
            
            $('#updatetodo').on('click', function(){    
                $('.panel-footer font').remove(); 
                var u_id=$('#todoid').val();  
               $.ajax({
                        type    : "POST",
                        url     : base_url+'updatetodo',
                        dataType: "json",
                        data    : {'todoid':$('#todoid_edit').val(),
                                   'todo':$('#todotext_edit').val(),
                                   'todostatus':$('#todostatus_edit').val(),
                                   'calendar':$('#popup_calender').val()},
                        success : function(data){
                                  if(data.success==1){
                                     $('.panel-footer font').remove();
                                     //$('#'+u_id +' .checkbox label').text(data.title);
                                     //search$('#'+u_id +' .status').text(data.status);
                                    $('#todo_list').html(data.datas); 
                                     $('.panel-footer').append(data.msg);
                                     $('.panel-footer font').delay(2000).fadeOut();
                                    }
                                 else if(data.success==2){
                                        $('.panel-footer').append(data.msg);
                                        $('.panel-footer font').delay(2000).fadeOut();
                                    }
                                else{
                                    $('#'+u_id).remove();
                                    $('.panel-footer').append(data.msg);
                                    $('.panel-footer font').delay(2000).fadeOut();
                            }
                           $('#todo').val('');
                        }

                    })
                
            }) 
            
            $('#state').on('change', function(){  
           
                 $.ajax({
                        type    : "POST",
                        url     : base_url+'district',
                        data    : {'state_id':$('#state').val()},
                        success : function(data){
                                  $('#district option').remove();
                                  $('#district').append('<option value="">Select</option>');
                                  $('#district').append(data);
                     
                        }
                    });
              
            })
            
            $('.view').on('click', function(){ 
                var u_id = $(this).data('id'); 
                $.ajax({
                        type    : "POST",
                        url     : base_url+'viewuser/'+u_id,
                        data    : {'u_id':u_id},
                        success : function(data){
                                   $('#content').html('');
                                   $('#content').append(data);
                                   $('#viewmyModal').modal();
                                  }
                    });
                
            })
            
            $("#Userstatus").change(function () {   
                 var value = $(this).val();  
                 if(value == 1){
                    var userid = $("#userid").val();
                    if (userid != "") {
                        $.post(base_url+"check_user_payment", { userid: userid },
                        function(response) {
                            var data = $.parseJSON(response);
                            if (data["status"] == 1) {
                                $("#payment_status").css("color", "green");
                                $("#payment_status").html(data["msg"]);
                                $(".check_div").fadeIn();
                                setTimeout(function() {
                                        $(".check_div").fadeOut();
                                }, 3000);
                            } else {
                                $("#payment_status").css("color", "red");
                                $("#payment_status").html(data["msg"]);
                                $(".check_div").fadeIn();
                                setTimeout(function() {
                                        $(".check_div").fadeOut();
                                }, 5000);
                            }
                        });
                    }
                 }
            });
            
            $(".removeimage").click(function () {   
                var answer = confirm("Are you sure you want to delete this attachment?");
                if(answer){
                    var id    = $(this).attr("data-id");    
                    var no    = $(this).attr("data-no");    
                    var request_path    = base_url+"remove_attchments/"+id+"/"+no;
                    console.log(request_path);
                    $.post(request_path,function(data){  
                        $("#"+no+"div").html('');
                    });
                }
            })
            
            $(document).on("change","#todo_search",function() {  
                var date_val = $("#todo_search").val(); 
                $.ajax({
                    type    : "POST",
                    url     : base_url+'search_todolist'+'/'+date_val,
                    //dataType: "json",
                    success : function(data){   
                        $('#todo_list').html(data);
                    }
                });
            })
            
            $('#save').on('click', function(){      
                 $('.panel-footer font').remove();  
                    $.ajax({
                        type    : "POST",
                        url     : base_url+'todo',
                        dataType: "json",
                        data    : {'todo':$('#todo').val(),
                                   'calendar':$('#main_calendar').val(),
                                   'todostatus':$('#todostatus').val()},
                        success : function(data){
                            if(data.success==1){
                                //$('.todo-list').append(data.html);
                                $('#todo_list').html('');
                                $('#todo_list').html(data.html);
                                $('.panel-footer').append(data.msg);
                                $('.panel-footer font').delay(2000).fadeOut();
                            }else{
                                 $('.panel-footer').append(data.msg);
                                 $('.panel-footer font').delay(2000).fadeOut();
                            }
                           $('#todo').val('');
                        }
                    });
            });
            
             
            $("#search_name_agent").keyup(function () { 
                var id = $(this).attr("id");    
                if (this.value.length > 1) {
                    $.ajax({
                        type: "POST",
                        url: base_url + "agent_autocomplete",
                        data: {'keyword': $(this).val(), 'selector': id},
                        beforeSend: function () {  
                            $("#search_name_agent").css("background", "#FFF url(" + assets_url + "images/LoaderIcon.gif) no-repeat 165px");
                        },
                        success: function (data) {
                            $(".suggesstion-box-agent").show();
                            $(".suggesstion-box-agent").html(data);
                            $("#search_name_agent").css("background", "#FFF");
                        }
                    });
                }
                else {
                    $(".suggesstion-box-agent").hide();
                }
            });
            
            $('.panel-body').on('click','.agentautolist', function(){  
                
                var val = $(this).attr("data-value");    
                $("#search_name_agent").val(val);
                $(".suggesstion-box-agent").hide();
            });
            
            $("#search_user").keyup(function () { 
                var id = $(this).attr("id");    
                if (this.value.length > 1) {
                    $.ajax({
                        type: "POST",
                        url: base_url + "user_autocomplete",
                        data: {'keyword': $(this).val(), 'selector': id},
                        beforeSend: function () {  
                            $("#search_user").css("background", "#FFF url(" + assets_url + "images/LoaderIcon.gif) no-repeat 165px");
                        },
                        success: function (data) {
                            $(".suggesstion-box").show();
                            $(".suggesstion-box").html(data);
                            $("#search_user").css("background", "#FFF");
                        }
                    });
                }
                else {
                    $(".suggesstion-box").hide();
                }
            });
            
            $('.panel-body').on('click','.userautolist', function(){  
                
                var val = $(this).attr("data-value");    
                $("#search_user").val(val);
                $(".suggesstion-box").hide();
            });
            
             $("#payment_code").keyup(function () { 
                var id = $(this).attr("id");    
                if (this.value.length > 1) {
                    $.ajax({
                        type: "POST",
                        url: base_url + "bank_payment_autocomplete",
                        data: {'keyword': $(this).val(), 'selector': id},
                        beforeSend: function () {  
                            $("#payment_code").css("background", "#FFF url(" + assets_url + "images/LoaderIcon.gif) no-repeat 165px");
                        },
                        success: function (data) {
                            $(".suggesstion-box").show();
                            $(".suggesstion-box").html(data);
                            $("#payment_code").css("background", "#FFF");
                        }
                    });
                }
                else {
                    $(".suggesstion-box").hide();
                }
            });
            
            $('.panel-body').on('click','.bankpaymentautolist', function(){ 
                
                var val = $(this).attr("data-value");    
                $("#payment_code").val(val);
                $(".suggesstion-box").hide();
            });
            
            $("#search_district").keyup(function () {  
                var id = $(this).attr("id");    
                if (this.value.length > 1) {
                    $.ajax({
                        type: "POST",
                        url: base_url + "district_autocomplete",
                        data: {'keyword': $(this).val(), 'selector': id},
                        beforeSend: function () {  
                            $("#search_district").css("background", "#FFF url(" + assets_url + "images/LoaderIcon.gif) no-repeat 165px");
                        },
                        success: function (data) {
                            $(".suggesstion-box").show();
                            $(".suggesstion-box").html(data);
                            $("#search_district").css("background", "#FFF");
                        }
                    });
                }
                else {
                    $(".suggesstion-box").hide();
                }
            });
            
            $('.panel-body').on('click','.districtautolist', function(){  
                
                var val = $(this).attr("data-value");    
                $("#search_district").val(val);
                $(".suggesstion-box").hide();
            });
            
//            $("#main_calendar").datepicker({
//                 startDate: new Date(),
//                 autoclose: true,
//            });
            
}();    
