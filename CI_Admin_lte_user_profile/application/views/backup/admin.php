<script>
  function statusChangeCallback(response) {  // Called with the results from FB.getLoginStatus().
    console.log('statusChangeCallback');
    console.log(response);                   // The current login status of the person.
    if (response.status === 'connected') {   // Logged into your webpage and Facebook.
      testAPI();  
    } else {                                 // Not logged into your webpage or we are unable to tell.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this webpage.';
    }
  }


  function checkLoginState() {               // Called when a person is finished with the Login Button.
    FB.getLoginStatus(function(response) {   // See the onlogin handler
      statusChangeCallback(response);
    });
  }


  window.fbAsyncInit = function() {
    FB.init({
      appId      : '{app-id}',
      cookie     : true,                     // Enable cookies to allow the server to access the session.
      xfbml      : true,                     // Parse social plugins on this webpage.
      version    : '{api-version}'           // Use this Graph API version for this call.
    });


    FB.getLoginStatus(function(response) {   // Called after the JS SDK has been initialized.
      statusChangeCallback(response);        // Returns the login status.
    });
  };
 
  function testAPI() {                      // Testing Graph API after login.  See statusChangeCallback() for when this call is made.
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log('Successful login for: ' + response.name);
      document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response.name + '!';
    });
  }

</script>

<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Admin</b>LTE</a>
  </div>
  <!-- /.login-logo -->
   <?php if($this->session->flashdata('message')) { ?>
        <div class="alert alert-info">
            <?php echo $this->session->flashdata('message')?>
        </div>
    <?php } ?>
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <?php echo form_open('admin_lte/login'); ?>
        <div class="input-group mb-3">
          <?php echo form_input(['type'=>'email', 'name' =>'email', 'id'=>'email','placeholder'=>'Enter your Email','class'=>'form-control']);?>
           <!-- <input type="email" name="email" class="form-control" placeholder="Email"> -->
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <?php echo form_password(['name'=>'password','id'=>'password','placeholder'=>'Enter your password','class'=>'form-control']);?>
          <!-- <input type="password" name="password" class="form-control" placeholder="Password"> -->
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <?php echo form_submit(['name'=>'submit','value'=>'Sign In','class'=>'btn btn-primary btn-block']);?>
            <!-- <input type="submit" name="submit" class="btn btn-primary btn-block" value="Sign In"> -->
          </div>
          <!-- /.col -->
        </div>
      <?php echo form_close(); ?>

      <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <div class="fb-login-button" data-width="" data-size="large" data-button-type="continue_with" data-layout="default" data-auto-logout-link="false" data-use-continue-as="false" scope="public_profile,email" onlogin="checkLoginState();"></div>
        <!-- <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
        </fb:login-button> -->
 
    <div id="status">
      </div>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div>
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v10.0&appId=273840041056531&autoLogAppEvents=1" nonce="Sq5nM9w0"></script>
<!-- /.login-box -->


<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>