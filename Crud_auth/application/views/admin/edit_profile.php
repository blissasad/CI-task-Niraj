<div class="main">

        <!-- Sign up form -->

        <center>
        <h2><? echo $title?> Page </h2>
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Edit</h2>
                        <form method="POST" class="register-form" id="register-form">
                            <input type="hidden" name="id" value="<?php echo $record['id']; ?>">
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="username" id="username" value="<?php echo $record['username'];?>"placeholder="Your userName"/>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" value="<?php echo $record['email'];?>"placeholder="Your Email"/>
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="number" name="contact" id="contact" value="<?php echo $record['contact'];?>"placeholder="Contact"/>
                            </div>
                            <!-- <div class="form-group">
                                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                            </div> -->
                            <div class="form-group form-button">
                                <input type="submit" name="submit" id="submit" class="form-submit" value="Update"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </center>
   </div>