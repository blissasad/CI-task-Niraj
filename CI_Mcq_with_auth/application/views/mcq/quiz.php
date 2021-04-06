<center>
	<h1>Questions</h1>
	<hr><br><hr>

	<table height="100%">
		<?php
		foreach($quizs as $ques)
		{
		?>
		<tr >
			<td ><b><?php echo $ques->name; ?> : <?php echo $ques->content; ?></b></td>

			
		</tr>
        
       	<?php echo form_open('mcqs/quiz'); ?>
       	<tr>
			<td>
            <div class="form-group">
                <label for="answer"><i class="zmdi zmdi-email"></i></label>
                <input type="hidden" name="id" value="<?php echo $ques->id;  ?>">
                <input type="text" name="answer" id="answer" placeholder="Your anser"/>
            </div>
        </td>
    	</tr>
            <?php if($this->session->flashdata('message')) { ?>
            <div class="alert alert-danger">
                <?php echo $this->session->flashdata('message')?>
            </div>
			<?php
				}
			?>
		<tr>
			<td>
				<div class="form-group form-button">
			   		<input type="submit" name="submit" id="submit" class="form-submit" value="Next"/>
				</div>
			</td>
    	</tr>
		<?php echo form_close(); ?>

		<?php } ?>
	</table>
</center>