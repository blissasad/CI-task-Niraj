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
      window.location.href = '<?php echo base_url("/admin_lte/success") ?>';
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

       <span id="err" style="color:red"></span>
        <span id='eml' style="color:red"></span>
        <div class="input-group mb-3">
          <?php echo form_input(['type'=>'email', 'name' =>'email', 'id'=>'email','placeholder'=>'Enter your Email','class'=>'form-control']);?>
           <!-- <input type="email" name="email" class="form-control" placeholder="Email"> -->
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <span id='psw' style="color:red"></span>
        <div class="input-group mb-3">
          <?php echo form_password(['name'=>'password','id'=>'password','placeholder'=>'Enter your password','class'=>'form-control']);?>
          <!-- <input type="password" name="password" class="form-control" placeholder="Password"> -->
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <span id='chv' style="color:red"></span>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <!-- <input type="checkbox" id="terms" name="terms" value="agree"> -->
              <?php echo form_checkbox(['name'=>'check', 'id'=>'check', 'class'=>'form-control']); ?>
              <label for="check">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <?php echo form_submit(['name'=>'submit','value'=>'Sign In','class'=>'btn btn-primary btn-block','onclick'=>'submitform()']);?>
            <!-- <input type="submit" name="submit" class="btn btn-primary btn-block" value="Sign In"> -->
          </div>
          <!-- /.col -->
        </div>

      <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <div class="fb-login-button" data-width="318px" data-size="large" data-button-type="continue_with" data-layout="default" data-auto-logout-link="true" data-use-continue-as="true" scope="public_profile,email" onlogin="checkLoginState();"></div>
        <!-- <div class="fb-login-button" data-width="" data-size="large" data-button-type="continue_with" data-layout="default" data-auto-logout-link="false" data-use-continue-as="false" scope="public_profile,email" onlogin="checkLoginState();"></div> -->
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
        <a href="<?php echo site_url('admin_lte/register_ajax'); ?>" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v10.0&appId=273840041056531&autoLogAppEvents=1" nonce="VHlqdmj0"></script>

<script>
    function IsEmail(email) {
          var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
          if(!regex.test(email)) {
            return false;
          }else{
            return true;
          }
        }
    function IsPassword(password)
    {
      var regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/;
      if(!regex.test(password))
      {
        return false;
      }
      else
      {
        return true;
      }
    }
    /*Custom fucntion to validate data and submit data thorugh ajax*/
    function submitform() {
        /*falg to check the data, if there is an error, flag will turn to 1*/
        var flag = 0;
        /*var check;
        if (!$('#check').is(":checked"))
        {
           check = false;
        }
        else
        {
          check = true;
        }*/
        /*Checking the value of inputs*/
        var email = $('#email').val();
        var password = $('#password').val();
        /*Validating the values of inputs that it is neither null nor undefined.*/
        if (email == '' || email == undefined) {
            $("#email").attr("placeholder", "Email is Required").val("").focus().blur();
            $('#email').css('border', '1px solid red');
            flag = 1;
        }
        if (password == '' || password == undefined) {
            $("#password").attr("placeholder", "Password is Required").val("").focus().blur();
            $('#password').css('border', '1px solid red');
            flag = 1;
        }
        if(IsEmail(email)==false)
        {
          document.getElementById('eml').innerHTML = 'invalid email';

        }
        if(IsPassword(password)==false)
        {
          document.getElementById('psw').innerHTML = 'invalid password';
        }
        /*if there is no error, go to flag==0 condition*/
        if (flag == 0) {
            /*Ajax call*/
            $.ajax({
                url: "<?php echo base_url('/admin_lte/login_ajax') ?>",
                method: 'POST',
                data: "email=" + email + "&password=" + password, 
                success: function (result) {
                    /*result is the response from LoginController.php file under getLogin.php function*/
                    if (result == 2) {
                        /*if response result is 1, it means it is successful.*/
                        $('#username').css('border', '1px solid green');
                        $('#email').css('border', '1px solid green');
                        $('#password').css('border', '1px solid green')
                        document.getElementById('err').innerHTML = '<div class="alert alert-success">Logged in Successfully</div>';
                        setTimeout(function () {
                            /*Redirect to login page after 1 sec*/              
                            window.location.href = '<?php echo base_url("/profiles") ?>';
                        }, 1000)
                    } 
                    else
                    {
                        document.getElementById('err').innerHTML = 'Something went wrong';
                    }
                }
            });
        } 
    }
</script>