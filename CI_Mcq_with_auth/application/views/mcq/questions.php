<center>
	<h1>Questions</h1>
	<hr><br><hr>

	<table height="100%">
		<?php
		foreach($quest as $ques)
		{
		?>
		<tr >
			<td ><b><?php echo $ques->name; ?> : <?php echo $ques->content; ?></b></td>
			
		</tr>
		<tr>
			<td></td>
		</tr>

		<?php
		}
		?>
		<?php
		foreach($ans as $answ)
		{
		?>
		<tr >
			<td ><b><?php echo $answ->id; ?> : <?php echo $answ->answers; ?></b></td>
			
		</tr>
		<tr>
			<td></td>
		</tr>

		<?php
		}
		?>
	</table>





</center>