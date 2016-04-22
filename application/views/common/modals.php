<style>
    body.modal-open {
    overflow: hidden;
    position:fixed;
    width: 100%;
}
</style>
<!-- buyer guid popup model -->
<div id="buyerguid-popup" class="modal fade">
    <div class="modal-dialog bg-modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                <!--<div class="progress">
                    <div class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar" style="width: 50%">
                        50% Complete
                    </div>
                </div>-->
                <div align="center">
                    <h4 style="line-height: 1.6;">
                        To download a FREE copy of the
                        <br><strong>CopierChoice Buyer’s Guide to Digital Copiers & Multifunction Devices,</strong>
                        <br>Please complete a 1 minute survey. You will receive the download link via email.
                    </h4>
                </div>

            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <img src="<?php echo c('image_url') ?>theme/bguide/b7.png" class="img-responsive">
                    </div>
                    <div class="col-md-8">
                        <h4 align="center">Enter your name and email below to start survey.</h4>
                        <form name="bgform" target="_blank" id="buyer_guid_form" class="cc-form bgf" method="get" action="<?php echo base_url(); ?>buyerguide">
                            <div class="form-group">
                                <!--<label for="fname">First Name</label>-->
                                <input name="fname" type="text" class="form-control" id="fname" placeholder="First Name" required="">
                            </div>
                            <div class="form-group">
                                <!--<label for="lname">Email address</label>-->
                                <input name="lname" type="text" class="form-control" id="lname" placeholder="Last Name" required="">
                            </div>
                            <div class="form-group">
                                <!--<label for="email">Email address</label>-->
                                <input name="email" type="email" class="form-control" id="email123" placeholder="Email" required="">
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="ps" value="yes">
                                <button type="button" name="" class="btn btn-lg btn-primary" style="width: 100%;" id="bguide_submit">
                                    GET STARTED HERE <i class="fa fa-arrow-right"></i>
                                </button>
                            </div>
                        </form>
                        <p align="center"><i class="fa fa-lock"></i> &nbsp; We hate SPAM and promise to keep your email address safe. </p>
                    </div>
                </div>
            </div>
            <!--            <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
                        </div>-->
        </div>
    </div>
</div>

<style type="text/css">
    @media only screen and (min-width: 768px) {
        .bg-modal-dialog{
            width: 55% !important;
        }
    }
</style>