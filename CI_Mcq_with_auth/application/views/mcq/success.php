<center>
	<h1>
		<br>
		Your Score <?php 
		
		echo $result;
		 ?>/5
	</h1>
	<h2>
	<?php
	if($result > 3)
	{
	?>
	</h2>
	Congratualations you have passed the test!
	<h2> 
	<?php
	}
	else
	{
	?>
	</h2>
	Sorry you have failed the test! Try again!
	<h2> 
	<?php
	}
	?>

		<a href="<?php echo site_url('mcqs/'); ?>">
			Go to home page.
		</a>
	</h2>
</center>