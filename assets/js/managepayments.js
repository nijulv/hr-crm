var Payments = function(){    
    $(document).ready(function() {
        $('#payments').validate({
            submitHandler : function(form) {
                var ppup_content = "<b>Are you sure,Do you want to submit this form ?</b>\n\
                                    <br>Note:once you submit a form you can't modified it.";
                bootbox.confirm(ppup_content, function(result) {
                    if(result){
                        form.submit();
                    }
                })
            },
            rules: {
                title: {
                 required: true,
                },
                user: {
                 required: true
                },
                amount: {
                 required: true,
                 number:true,
                 minlength: 2
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