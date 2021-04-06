<h1>
<?php 

$id = $this->session->userdata('id');



	if($id)
	{
		$username = $this->session->userdata('username');
		echo $username;		
	}
?>
</h1>
<br><br>

<h2>
<?php
	if($id)
	{
?>
		&emsp;<a href="<?php echo site_url('admin_lte/logout/');?>">Logout</a>
<?php
	}
?>
</h2>



