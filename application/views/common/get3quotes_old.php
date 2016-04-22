<section class="getquotepanel">
    <div class="container">
        <h3>Get 3 Quotes Today!</h3>
        <h4>Use CopierChoice and let suppliers contact you and compete.</h4>

        <h5>
            <p>Just share some details and compare up to 3 quotes from quality suppliers.</p>
            <p>Start by entering you Postcode or Suburb below:</p>
        </h5>
        <form name="post_suburb" id="post_suburb" action="<?php echo base_url(); ?>getquote">
            <div class="row text-center formwrapper">
                <div class="pull-left text-right">
                    <input type="text" name="postcode" id = "search-box" placeholder="Enter Your Postcode" />
                    <div id="suggesstion-box"></div>
                </div>
                <div class="pull-left text-center or-text">
                    OR
                </div>  
                <div class="pull-right text-left">
                    <select name="suburb" class = "citylist">
                        <option value="">Select Your Suburb</option>
                    </select>

                </div> 
                <div class="clearfix"></div>
            </div>

            <div class="row text-center submitbtn">
                <button type="submit" class="btn btn-primary get3quote">Submit</button>
            </div>
        </form>
        <div class="note">
            <p>Once you complete your quote request, we will attempt to connect you with at least 3 different suppliers to give you quotes. </p>
            <p>All information you provide is solely for suppliers to understand your requirements and be able to contact you with their quotes.</p>
            <p><i class="fa fa-lock" style="color: #B1B1B1;"></i> &nbsp; We hate SPAM and your information will be kept secure. Please see our <a href="">privacy policy.</a></p>
        </div>
    </div>
</section>