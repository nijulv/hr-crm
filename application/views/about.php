<div class="container">
    <div class="row">
        <div class="col-md-12"> 
            <h2>About Us</h2><hr>

            <p>
                    <?php echo $about_data[0]['contents']; ?>
            </p>
            <?php if($get3quotes == 'YES'){
                $this->load->view("common/get3quotes");?>
            <?php }?>
        </div>
    </div>
</div>