<section class="getquotepanel" id="getquote">
    <div class="container">
        <h3>Get 3 Quotes Today!</h3>
        <h4>Use CopierChoice and let suppliers contact you and compete.</h4>

        <h5>
            <p>Just share some details and compare up to 3 quotes from quality suppliers.</p>
            <p>Start by entering your Postcode or Suburb below:</p>
        </h5>
        <form name="post_suburb" id="post_suburb" action="<?php echo base_url(); ?>getquote" novalidate>
            <!-- <div class="row text-center formwrapper">
                <div class="" style = ""> -->
                    <!--<small>Type postcode/suburb here</small>-->
                   <!--<small id="ps-error"></small>
                    <input type="text" class="form-control" name="id" id = "search-box" placeholder="Enter Your Suburb/Postcode" required />
                    <input type="hidden" name="sub" id="sub" value=""/>
                    <input type="hidden" name="postcode" id="postalcode" value=""/>
                    <input type="hidden" name="suburb" id="sub_name" value=""/>
                    <div id="suggesstion-box"></div>
                </div>
                <div class="clearfix"></div>
            </div> -->
            <div class="row text-center formwrapper">
                <div class="form-group">
                    <label>City/Suburb</label><br/>
                    <small id="ps-error"></small>
                    <input type="text" name="suburb_new" id="suburb_new" required="" class="form-control sellcopierautocompltehome" placeholder="Enter Your Suburb/Postcode">
                    <div class = "suggesstion-box"></div>
                </div> 

                <input type="hidden" name="suburb" id="suburb" value="">
                <input type="hidden" name="postcode" id="postcode" value="">
                <input type="hidden" name="value_check" id="value_check" value="no">
             </div>
            
            <div class="row text-center submitbtn">
                <button type="submit" class="btn btn-primary get3quote" id="go_butn">Get Quotes</button>
            </div>
        </form>
        <div class="note">
            <p>Once you complete your quote request, we will attempt to connect you with at least 3 different suppliers to give you quotes. </p>
            <p>All information you provide is solely for suppliers to understand your requirements and be able to contact you with their quotes.</p>
            <p><i class="fa fa-lock" style="color: #B1B1B1;"></i> &nbsp; We hate SPAM and your information will be kept secure. Please see our <a href="<?php echo base_url()?>privacy.html" target = "_blank">privacy policy.</a></p>
        </div>
    </div>
</section>
<style type="text/css">
    li.token-input-input-token-facebook {
        float: none !important;
    }
    ul.token-input-list-facebook{
        width: 100% !important;
        margin: 0 auto !important;
        height: 54px !important;
        border: 1px solid #007FC2;
        background-color: #f1f1f1;
        border-radius: 5px;
    }
    #token-input-search-box {
        border:0px solid #FFFFFF;
        background-color: #f1f1f1;
    }
    .token-input-list-facebook{
        height: 54px !important;
    }
    li.token-input-token-facebook{
        padding: 12px 10px !important;
        font-size: 14px !important;
    }
    .getquotepanel .container .submitbtn button:hover{
        background-color: #79BA28;
        border-color: #629820;
    }
    .getquotepanel .container input[type="text"] {
        height: 50px;
    }
    
</style>
<script>
        $(".sellcopierautocompltehome").blur(function(){   // mouseleave
            var value_check = $("#value_check").val();  
            if(value_check != 'yes'){
                $(".sellcopierautocompltehome").val('');
            }
        }); 
        
        $(".sellcopierautocompltehome").keydown(function(){
            $("#value_check").val("no"); 
        }); 
        
        $(".sellcopierautocompltehome").keypress(function(){
            $("#value_check").val("no");  
        });
    
</script>  