 <div class="main">

        <!-- Sign up form -->

        <center>
        <h2><? echo $title?> Page </h2>
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                        <?php if($this->session->flashdata('message')) { ?>
				            <div class="alert alert-danger">
				                <?php echo $this->session->flashdata('message')?>
				            </div>
				        <?php } ?>
                       <?php echo form_open('tests/login'); ?>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Your Email"/>
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="password" placeholder="Password"/>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="submit" id="submit" class="form-submit" value="Login"/>
                            </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </section>
    </center>
   </div>