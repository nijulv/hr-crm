
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


            $('#btn-todo').on('click', function(){   
                if(''!= $('#todo').val()){
                    $('#myModal').modal();
                    return false;
                }
                else {
                     $(".shedule").html("Please enter description");
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
                                  $('#todocontent .row').remove();
                                  $('#todocontent b').remove();
                                  $('#todocontent input').remove();
                                  $('#todocontent').append(data);
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
                        data    : {'todoid':$('#todoid').val(),
                                   'todo':$('#todotext').val(),
                                   'calendar':$('#popup_calender').val()},
                        success : function(data){
                                  if(data.success==1){
                                     $('.panel-footer font').remove();
                                     $('#'+u_id +' .checkbox label').text(data.title);
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
            $('#save').on('click', function(){ 
                 $('.panel-footer font').remove();
                    $.ajax({
                        type    : "POST",
                        url     : base_url+'todo',
                        dataType: "json",
                        data    : {'todo':$('#todo').val(),
                                   'calendar':$('#main_calendar').val()},
                        success : function(data){
                            if(data.success==1){
                                if(0 == $('.todo-list').length){
                                    var html = '<div class="panel-body"><ul class="todo-list">'+data.html+'</div></div>';
                                    $('#todo-panel .panel-heading').after(html);
                                    $('.panel-footer').append(data.msg);
                                    $('.panel-footer font').delay(2000).fadeOut();
                                }else{
                                     $('.todo-list').append(data.html);
                                     $('.panel-footer').append(data.msg);
                                     $('.panel-footer font').delay(2000).fadeOut();
                                }
                                
                            }else{
                                 $('.panel-footer').append(data.msg);
                                 $('.panel-footer font').delay(2000).fadeOut();
                            }
                           $('#todo').val('');
                        }
                    });
            }); 
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
                    $(".suggesstion-box-suburb").hide();
                }
            });
            
            
            /*function selectdistrictvalue(val, selector) {  
        
                $("#" + selector).val(val);
                $(".suggesstion-box").hide();
            } */
            
            $('.panel-body').on('click','.districtautolist', function(){  
                
                var val = $(this).attr("data-value");    
                $("#search_district").val(val);
                $(".suggesstion-box").hide();
            });
            $("#main_calendar").datepicker({
                 startDate: new Date() 
                });
            
}();    
