<center>
	<h1>Questions</h1>
	<hr><br>
	<?php
		$name = $this->session->userdata('username');
		echo 'Currently logged_in '.$name; 
	?>
	<br><hr>

	<table height="100%">
		<?php
		foreach($quest as $ques)
		{
		?>
		<tr >
			<td ><b><?php echo $ques->name; ?> : <?php echo $ques->content; ?></b></td>

			
		</tr>
        
       	<?php echo form_open('mcqs/quiz_dis'); ?>
       	<input type="hidden" name="id" value="<?php echo $ques->id;  ?>" />
       	<?php
	       }
	     ?>
                
       	
       		<?php 
       		foreach($answ as $ans)
       		{

       		?>
       		<tr>
				<td>
	            <div class="form-group">
	                <input type="radio" name="answer" id="answer" value="<?php  echo $ans->id; ?>" required />
	                <?php echo $ans->answers; ?> 
	            </div>
	            </td>
            </tr>
            <?php 
        	}
            ?>
    	
            <?php if($this->session->flashdata('message')) { ?>
            <div class="alert alert-danger">
                <?php echo $this->session->flashdata('message')?>
            </div>
			<?php
				}
			?>
			
			
		<tr>

			<?php
				if(! $this->session->flashdata('message'))
				{
			?>
			<td>
				<div class="form-group form-button">
			   		<input type="submit" name="submit" id="submit" class="form-submit" value="submit"/>
				</div>
			</td>
			<?php
				}
			?>
			<?php

				if($this->session->flashdata('message'))
				{
					foreach($quest as $ques)
					{
					$upid = $ques->id;
					}
					$upid =$upid + 1;
			?>
			<td>

			<a href="<?php echo site_url('mcqs/quiz_dis/').$upid;?>" class="btn btn-secondary btn-lg">next</a>
			</td>

			<?php
					}
			 ?>

    	</tr>
		<?php echo form_close(); ?>

	</table>
</center>