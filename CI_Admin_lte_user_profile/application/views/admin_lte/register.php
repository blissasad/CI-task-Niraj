<div class="register-box">
  <div class="register-logo">
    <a href="../../index2.html"><b>Admin</b>LTE</a>
  </div>

    <?php if($this->session->flashdata('message')) { ?>
        <div class="alert alert-info">
            <?php echo $this->session->flashdata('message')?>
        </div>
    <?php } ?>
  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>
      <span id="err" style="color:red">
        </span>
      <!---  form start --->
      <span id='usn' style="color:red"></span>
        <div class="input-group mb-3">
          <?php echo form_input(['type'=>'text', 'name' =>'username', 'id'=>'username','placeholder'=>'Enter your name','class'=>'form-control']);?>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <span id='eml' style="color:red"></span>
        <div class="input-group mb-3">
          <?php echo form_input(['type'=>'email', 'name' =>'email', 'id'=>'email','placeholder'=>'Enter your email','class'=>'form-control']);?>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <span id='psw' style="color:red"></span>
        <div class="input-group mb-3">
          <?php echo form_password(['name'=>'password','id'=>'password','placeholder'=>'Enter your password','class'=>'form-control']);?>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <span id='cps' style="color:red"></span>
        <div class="input-group mb-3">
          <?php echo form_password(['name'=>'c_password','id'=>'c_password','placeholder'=>'Confirm your password','class'=>'form-control']);?>
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
              <?php echo form_checkbox(['name'=>'terms', 'id'=>'terms', 'class'=>'form-control']); ?>
              <label for="terms">
               I agree to the <a href="#">terms</a>
              </label>
            </div>
          </div>
          
          <!-- /.col -->
          <div class="col-4">
            <?php echo form_submit(['name'=>'submit','value'=>'Sign In','class'=>'btn btn-primary btn-block','onclick'=>'submitform()']);?>
          </div>
          <!-- /.col -->
          <div id='check'>
          </div>
        </div>
    <!---  form end  --->
      <div class="social-auth-links text-center">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i>
          Sign up using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i>
          Sign up using Google+
        </a>
      </div>

      <a href="<?php echo site_url('admin_lte/login_page'); ?>" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->
<script>
     function IsEmail(email) {
          var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
          if(!regex.test(email)) {
            return false;
          }else{
            return true;
          }
        }

    function IsName(username)
    {
      var regex = /^[0-9a-zA-Z]+$/;
      if(!regex.test(username))
      {
        return false;
      }
      else
      {
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
    function IsEqual(password,c_password)
    {
      if(!password == c_password)
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
        /*Checking the value of inputs*/
        var email = $('#email').val();
        var password = $('#password').val();
        var username = $('#username').val();
        var c_password = $('#c_password').val();
        var terms = $('#terms').val();
        /*Validating the values of inputs that it is neither null nor undefined.*/
        if (username == '' || username == undefined) {
            $('#username').css('border', '1px solid red');
            $("#username").attr("placeholder", "Username is Required").val("").focus().blur();
            flag = 1;
        }
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
        if (c_password == '' || c_password == undefined) {
            $("#c_password").attr("placeholder", "Confirm Password is Required").val("").focus().blur();
            $('#c_password').css('border', '1px solid red');
            flag = 1;
        }
        if (!$('#terms').is(":checked"))
        {

            document.getElementById('chv').innerHTML = 'please accept terms and condition';
        }

        if(IsName(username)==false)
        {
          document.getElementById('usn').innerHTML = 'invalid username';

        }

        if(IsEmail(email)==false)
        {
          document.getElementById('eml').innerHTML = 'invalid email';

        }
        if(IsPassword(password)==false)
        {
          document.getElementById('psw').innerHTML = 'invalid password';
        }
        if(IsEqual(password,c_password)==false)
        {
          document.getElementById('cps').innerHTML = 'password should be same';
        }


        /*if there is no error, go to flag==0 condition*/
        if (flag == 0) {
            /*Ajax call*/
            $.ajax({
                url: "<?php echo base_url('/admin_lte/register_ajax') ?>",
                method: 'POST',
                data: "username=" + username +"&email=" + email + "&password=" + password + "&c_password=" + c_password,  
                success: function (result) {
                    /*result is the response from LoginController.php file under getLogin.php function*/
                    if (result == 2) {
                        /*if response result is 1, it means it is successful.*/
                        $('#username').css('border', '1px solid green');
                        $('#email').css('border', '1px solid green');
                        $('#password').css('border', '1px solid green');
                        $('#c_password').css('border', '1px solid green');
                        document.getElementById('err').innerHTML = '<div class="alert alert-success">User Registered</div>';
                        setTimeout(function () {
                            /*Redirect to login page after 1 sec*/              
                            window.location.href = '<?php echo base_url("/admin_lte/login_page") ?>';
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

