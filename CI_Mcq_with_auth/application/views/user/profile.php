<hr>
	<h1>Profile</h1>
<hr>
<div>

	<table width="80%" height="70%" align="center" >
	<tr>
		<td>UserName</td>
		<td><?php echo $record['username']; ?></td>
	</tr>
	<tr>
		<td>Email</td>
		<td><?php echo $record['email']; ?></td>
	</tr>
	<tr>
		<td>contact</td>
		<td><?php echo $record['contact']; ?></td>
	</tr>
<br>
<tr>
</tr>
	<tr>
		<td><a href="<?php echo site_url('user/profile_e/').$record['id'];?>"> Edit profile</a></td>
		<td> Change password </td>
	</tr>


<div>