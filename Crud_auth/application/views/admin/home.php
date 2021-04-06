<h2>Admin Panel</h2>


<table border="1px" width="80%" align="center" >
	<tr>
		<th>Name</th>
		<th>Email </th>
		<th>Number</th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>

	<?php foreach($records as $record): ?>
	<tr>
		<td><?php echo $record->username; ?></td>
		<td><?php echo $record->email; ?></td>
		<td><?php echo $record->contact; ?></td>
		<td><a href="<?php echo site_url('admin/pro_edit/').$record->id;?>">Edit</a></td>
		<td><a href="<?php echo site_url('admin/delete_record/').$record->id;?>">Delete</td>
	</tr>
	<?php endforeach; ?>

</table>