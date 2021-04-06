<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?php echo $title; ?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
         <div class="col-lg-12" align="center">

              <?php if($this->session->flashdata('message')) { ?>
                  <div class="alert alert-info">
                      <?php echo $this->session->flashdata('message')?>
                  </div>
              <?php } ?>
          <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title-center " >Profile Details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- <form> -->
                  <span id="err" style="color:red">
                   </span>
                <?php form_open_multipart('profiles/edit_profile', 'id="profile"'); ?>
<!-- input tags -->
                <span id='co' style="color:red"></span>
                <div class="form-group row">
                <div class="col-sm-2">
                </div>
                    <label class="col-sm-2 col-form-label" for="course"> 
                      Course Name
                    </label>
                    <div class="col-sm-6">
                      <?php 
                       $course = null;
                        if($user){
                        $course = $user->course;
                        } 
                        echo form_input(['type'=>'text', 'name' =>'course' ,'value'=>$course,'id'=>'course','placeholder'=>'Enter your course name','class'=>'form-control form-control-md']);?>
                    </div>
                  </div>

                <span id='cl' style="color:red"></span>
                <div class="form-group row">
                <div class="col-sm-2">
                </div>
                    <label class="col-sm-2 col-form-label" for="college"> 
                      College Name
                    </label>
                    <div class="col-sm-6">
                      <?php 
                       $college = null;
                        if($user){
                        $college = $user->college;
                        } 
                        echo form_input(['type'=>'text', 'name' =>'college' ,'value'=>$college,'id'=>'college','placeholder'=>'Enter your college name','class'=>'form-control form-control-md']);?>
                    </div>
                  </div>

                  <span id='sk' style="color:red"></span>
                  <div class="form-group row">
                    <div class="col-sm-2">
                    </div>
                    <label class="col-sm-2 col-form-label" for="skills">
                      Skills
                    </label>
                    <div class="col-sm-6 ">
                      <?php 
                      $skills = null;
                        if($user){
                        $skills = $user->skills;
                        } 
                      echo form_input(['type'=>'text', 'name' =>'skills','value'=>$skills, 'id'=>'skills','placeholder'=>'Enter your college name','class'=>'form-control form-control-md', 'onchange'=>''  ]);?>
                    </div>
                  </div>

                  <span id='bi' style="color:red"></span>
                  <div class="form-group row">
                    <div class="col-sm-2">
                    </div>
                    <label class="col-sm-2 col-form-label" for="bio">
                    About yourself
                    </label>
                    <div class="col-sm-6">

                       <?php 
                       $bio = null;
                      if($user){
                        $bio = $user->bio;
                      }
                       echo form_textarea(['name' =>'bio','value'=>$bio, 'id'=>'bio','placeholder'=>'Something about yourself','class'=>'form-control form-control-md','rows'=>'3' ]); ?>   
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-2">
                    </div>
                    <label class="col-sm-2 col-form-label" for="country">
                    Country
                    </label>
                    <div class="col-sm-6">
                    <select name="country" id="country" class="form-control input-lg">
                    <option value="">Select Country</option>
                        <?php
                        foreach($countries as $row)
                        {
                         echo '<option value="'.$row->id.'">'.$row->country_name.'</option>';
                        }
                        ?>
                       </select>
                     <?php

                      /*
                        echo var_dump($countries);
                        echo form_dropdown('country',$countries['country_name'],'class="form-control form-control-md" id="country"');*/
                        ?>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-2">
                    </div>
                    <label class="col-sm-2 col-form-label" for="state">
                     State
                    </label>
                    <div class="col-sm-6">

                    <select name="state" id="state" class="form-control form-control-md">
                      <option value="">Select State</option>
                    <?php

                        /*foreach($states as $state)
                        {
                          echo '<option value="'.$state->id.'">'.$state->country_name.'</option>';
                        }*/
                     ?>
                    </select>
                      <?php 
                /*        $states = array(
                          'demo' => 'demo',
                          'demp2'=> 'demo2'
                        );
                        
                        echo form_dropdown('state', $states,'' ,'class="form-control form-control-md" id="state"');*/
                        ?>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-2">
                    </div>
                    <label class="col-sm-2 col-form-label" for="city">
                    City</label>
                    <div class="col-sm-6">
                    <select name="city" id="city" class="form-control form-control-md">
                      <option value="">Select City</option>
                    <?php

                       /* foreach($cities as $city)
                        {
                          echo '<option value="'.$city->id.'">'.$city->city_name.'</option>';
                        }*/
                     ?>
                    </select>
                     <?php 
                        /*$cities = array(
                          'demo' => 'demo',
                          'demp2'=> 'demo2'
                        );
                        
                        echo form_dropdown('city', $cities,'' ,'class="form-control form-control-md" id="city"');*/
                        ?> 
                    </div>
                  </div>
                 <!--  <div class="form-group row">
                    <div class="col-sm-2">
                    </div>
                    <label class="col-sm-2 col-form-label" for="exampleInputFile">Profile Picture</label>
                    <div class="col-sm-6">
                      <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="profile_pic" id="profile_pic">
                        <label class="custom-file-label" for="profile_pic">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                  </div>   -->

               
<!-- 
                  <div class="row">
                    <div class="col">
                    </div>
                    <div class="col">
                    </div>
                  </div> -->
                </div>


<!-- end input tags -->
                <div class="card-footer">
                <?php 
                /*if($result)
                {
                  echo form_button(['type'=>'submit','name'=>'insert','id'=>'insert','value'=>'Insert','class'=>'btn btn-info ','onclick'=>'insertForm()']);
                }
                else{
                   echo form_button(['type'=>'submit','name'=>'edit','id'=>'edit','value'=>'Edit','class'=>'btn btn-info ','onclick'=>'updateForm()']);*/

                   if($user)
                   {
                    ?>
                    <button type="submit" name='edit' id='edit' value='Edit' class="btn btn-info" onclick='updateForm()'>Edit</button>
                    <?php
                   }
                   else
                   {
                    ?>
                    <input type="submit" name='insert' id='insert' value='Insert' class="btn btn-info" onclick='insertForm()' />
                    <?php
                   }
                  ?>


                 <!--  <button type="submit" class="btn btn-info">Sign in</button> -->
                  <button type="submit" class="btn btn-danger">Cancel</button>
                </div>  
                <?php echo form_close(); ?>
             <!--    </form> -->
              <!-- /.card-body -->
            </div>
            <!-- /.card --> 
        </div>
      </div>
    </section>
  </div>

  <script>
    /*$("#country").prop("selectedIndex", -1);
    $("#state").prop("selectedIndex", -1);
    $("#city").prop("selectedIndex", -1);*/
    var flag = 0;


    function check_null()
    {
        var course = $('#course').val();
        var skills = $('#skills').val();
        var bio = $('#bio').val();
        var college = $('#college').val();
        if (course == '' || course == undefined) {
            $('#course').addClass('is-invalid');
            $("#course").attr("placeholder", "Course is Required").val("").focus().blur();
            //flag = 1;
        }
        if (skills == '' || skills == undefined) {
            $('#skills').addClass('is-invalid');
            $("#skills").attr("placeholder", "Skills are Required").val("").focus().blur();
           // flag = 1;
        }
        if (bio == '' || bio == undefined) {
            $('#bio').addClass('is-invalid');
            $("#bio").attr("placeholder", "Bio is Required").val("").focus().blur();
            //flag = 1;
        }
        if (college == '' || college == undefined) {
            $('#college').addClass('is-invalid');
            $("#college").attr("placeholder", "College is Required").val("").focus().blur();
            //flag = 1;
        }

    }
    function insertForm()
    {
        /*falg to check the data, if there is an error, flag will turn to 1*/
        var flag = 0;
        /*Checking the value of inputs*/
        var course = $('#course').val();
        var skills = $('#skills').val();
        var bio = $('#bio').val();
        var college = $('#college').val();
        var profile_pic = $('#profile_pic').val();
       /* var terms = $('#terms').val();*/
        /*Validating the values of inputs that it is neither null nor undefined.*/
       /* if (course == '' || course == undefined) {
            $('#course').css('border', '1px solid red');
            $("#course").attr("placeholder", "Course is Required").val("").focus().blur();
            flag = 1;
        }
        if (skills == '' || skills == undefined) {
            $("#skills").attr("placeholder", "Skills are Required").val("").focus().blur();
            $('#skills').css('border', '1px solid red');
            flag = 1;
        }
        if (bio == '' || bio == undefined) {
            $("#bio").attr("placeholder", "Bio is Required").val("").focus().blur();
            $('#bio').css('border', '1px solid red');
            flag = 1;
        }

*/
        if (course == '' || course == undefined) {
            $('#course').addClass('is-invalid');
            $("#course").attr("placeholder", "Course is Required").val("").focus().blur();
            flag = 1;
        }
        if (skills == '' || skills == undefined) {
            $('#skills').addClass('is-invalid');
            $("#skills").attr("placeholder", "Skills are Required").val("").focus().blur();
            flag = 1;
        }
        if (bio == '' || bio == undefined) {
            $('#bio').addClass('is-invalid');
            $("#bio").attr("placeholder", "Bio is Required").val("").focus().blur();
            flag = 1;
        }
        if (college == '' || college == undefined) {
            $('#college').addClass('is-invalid');
            $("#college").attr("placeholder", "College is Required").val("").focus().blur();
            //flag = 1;
        }


        /*if there is no error, go to flag==0 condition*/
        if (flag == 0) 
        {
            /*Ajax call*/
            $.ajax({
                url: "<?php echo base_url('/profiles/insert_data') ?>",
                method: 'POST',
                data: "course=" + course +"&skills=" + skills + "&bio=" + bio + "&college=" + college,  
                success: function (result) {
                    /*result is the response from LoginController.php file under getLogin.php function*/
                    if (result == 2) {
                        /*if response result is 1, it means it is successful.*/
                        $('#course').addClass('is-valid');
                        $('#skills').addClass('is-valid');
                        $('#bio').addClass('is-valid');
                        $('#college').addClass('is-valid');
                       /* $('#profile_pic').css('border', '1px solid green');*/
                        document.getElementById('err').innerHTML = '<div class="alert alert-success">User Registered</div>';
                        setTimeout(function () {
                            /*Redirect to login page after 1 sec*/              
                            window.location.href = '<?php echo base_url("/profiles/") ?>';
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

    function updateForm()
    {
        /*falg to check the data, if there is an error, flag will turn to 1*/
        var flag = 0;
        /*Checking the value of inputs*/
        var course = $('#course').val();
        var skills = $('#skills').val();
        var bio = $('#bio').val();
        var college = $('#college').val();
        var profile_pic = $('#profile_pic').val();
       /* var terms = $('#terms').val();*/
        /*Validating the values of inputs that it is neither null nor undefined.*/
       /* if (course == '' || course == undefined) {
            $('#course').css('border', '1px solid red');
            $("#course").attr("placeholder", "Course is Required").val("").focus().blur();
            flag = 1;
        }
        if (skills == '' || skills == undefined) {
            $("#skills").attr("placeholder", "Skills are Required").val("").focus().blur();
            $('#skills').css('border', '1px solid red');
            flag = 1;
        }
        if (bio == '' || bio == undefined) {
            $("#bio").attr("placeholder", "Bio is Required").val("").focus().blur();
            $('#bio').css('border', '1px solid red');
            flag = 1;
        }

*/
        if (course == '' || course == undefined) {
            $('#course').addClass('is-invalid');
            $("#course").attr("placeholder", "Course is Required").val("").focus().blur();
            flag = 1;
        }
        if (skills == '' || skills == undefined) {
            $('#skills').addClass('is-invalid');
            $("#skills").attr("placeholder", "Skills are Required").val("").focus().blur();
            flag = 1;
        }
        if (bio == '' || bio == undefined) {
            $('#bio').addClass('is-invalid');
            $("#bio").attr("placeholder", "Bio is Required").val("").focus().blur();
            flag = 1;
        }
        if (college == '' || college == undefined) {
            $('#college').addClass('is-invalid');
            $("#college").attr("placeholder", "College is Required").val("").focus().blur();
            //flag = 1;
        }


        /*if there is no error, go to flag==0 condition*/
        if (flag == 0) 
        {
            /*Ajax call*/
            $.ajax({
                url: "<?php echo base_url('/profiles/edit_data') ?>",
                method: 'POST',
                data: "course=" + course +"&skills=" + skills + "&bio=" + bio +"&college=" + college,   
                success: function (result) {
                    /*result is the response from LoginController.php file under getLogin.php function*/
                    if (result == 2) {
                        /*if response result is 1, it means it is successful.*/
                        $('#course').addClass('is-valid');
                        $('#skills').addClass('is-valid');
                        $('#bio').addClass('is-valid');
                        $('#college').addClass('is-valid');
                       /* $('#profile_pic').css('border', '1px solid green');*/
                        document.getElementById('err').innerHTML = '<div class="alert alert-success">User Updated Successfuly</div>';
                        setTimeout(function () {
                            /*Redirect to login page after 1 sec*/              
                            window.location.href = '<?php echo base_url("/profiles/") ?>';
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

$(document).ready(function(){
 $('#country').change(function(){
  var id = $('#country').val();
  if(id != '')
  {
   $.ajax({
    url:"<?php echo base_url(); ?>profiles/fetch_state",
    method:"POST",
    data:{id:id},
    success:function(data)
    {
     $('#state').html(data);
     $('#city').html('<option value="">Select City</option>');
    }
   });
  }
  else
  {
   $('#state').html('<option value="">Select State</option>');
   $('#city').html('<option value="">Select City</option>');
  }
 });

 $('#state').change(function(){
  var id = $('#state').val();
  if(id != '')
  {
   $.ajax({
    url:"<?php echo base_url(); ?>profiles/fetch_city",
    method:"POST",
    data:{id:id},
    success:function(data)
    {
     $('#city').html(data);
    }
   });
  }
  else
  {
   $('#city').html('<option value="">Select City</option>');
  }
 });
 
});
  </script>