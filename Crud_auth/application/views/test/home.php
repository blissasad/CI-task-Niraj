
<center>

	<?php

		echo base_url();
	?>
	<h2>home</h2>
		<?php 
		$id = $this->session->userdata('id');

		if(empty($id))
		{
		?>
	<h3>
		<a href="<?php echo site_url('tests/login/');?>">Login</a>
	</h3>
	<?php
		}
		else
		{
			$name = $this->session->userdata('username');


			echo 'Currently logged_in '.$name; 
	?>
	<h3>
		<a href="<?php echo site_url('tests/logout/');?>">Logout</a>

	</h3>
		<table border="1px" width="80%" align="center" >
		<tr>
			<th>Name</th>
			<th>Email </th>
		</tr>

		<?php foreach($users as $user): ?>
		<tr>
			<td><?php echo $user->username; ?></td>
			<td><?php echo $user->email; ?></td>
			
		</tr>
		<?php endforeach; ?>

		</table>
	<?php


		}
	?>
</center>

<script>
/*$.ajax({
           url: "/test/ajax_refresh_session",
           type: "POST",
           error: function() {
               if(confirm("Session refresh failed.  Your session will timeout if you do not refresh the page or navigate to another location. Click OK to refresh this page or cancel to return to this page."))
                   location.reload(true);
           },
           success: function(jsondata, status, xhr){
               initTimers();
           }
       });
     */
</script>