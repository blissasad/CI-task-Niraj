<?php
	


?>

 <div class="main">

        <!-- Sign up form -->

        <center>
        <h2><? echo $title?> Page </h2>
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">log in</h2>
                        <form method="POST" class="register-form" id="register-form">
                           
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Your Email"/>
                            </div>
       
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="password" placeholder="Password"/>
                            </div>
                            <!-- <div class="form-group">
                                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                            </div> -->
                            <div class="form-group form-button">
                                <input type="submit" name="submit" id="submit" class="form-submit" value="log-in"/>
                            </div>
                        </form>
                    </div>
                
                </div>
            </div>
        </section>
    </center>
   </div>

   