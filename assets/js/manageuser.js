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
           $('.delete').on('click', function(e){    
                      var u_id = $(this).data('id'); 
                      var url = $(this).data('url'); 
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
            });
            $('.deletetodo').on('click', function(){ 
                 var todo_id = $(this).data('id'); 
                 var todourl = $(this).data('url'); 
                 var ppup_content = "<b>Are you sure?</b><br><br>Do you want to delete this details?";
                 bootbox.confirm(ppup_content, function(result) {
                      if(result){
                            window.location = base_url+todourl+'/'+todo_id
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
                                   'calendar':$('#calendar').val()},
                        success : function(data){
                            if(data.success==1){
                                if(0 == $('.todo-list').length){
                                    var html = '<div class="panel-body"><ul class="todo-list">'+data.html+'</div></div>';
                                    $('#todo-panel .panel-heading').after(html);
                                    $('.panel-footer').append(data.msg);
                                }else{
                                     $('.todo-list').append(data.html);
                                     $('.panel-footer').append(data.msg);
                                }
                                
                            }else{
                                 $('.panel-footer').append(data.msg);
                            }
                           $('#todo').val('');
                        }
                    });
            }); 
            
}();
