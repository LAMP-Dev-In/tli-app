<?php include VIEW_PATH.'/header.php'; ?>
<caption> <center><b>List of Visa Services</b></center> </caption>

<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Recommended Price</th>
      <th scope="col">Details </th>
	  <th scope="col">Created At</th>
	  <th scope="col">Updated At</th>
    </tr>
  </thead>
  <tbody>
	<?php 
		$i = 0;	
   
		foreach($premium_services as $premium_service) {
	?>
		<tr>
		<th scope="row"><?= ++$i?></th>
		<td><?= $premium_service['name']?></td>
		<td>$<?= $premium_service['recommended_price']?></td>
		<td><?= $premium_service['details']?></td>
		<td><?= $premium_service['created_at']?></td>
		<td><?= $premium_service['updated_at']?></td>
		</tr>
	<?php
	}	
	?>

  </tbody>
</table>



<?php include VIEW_PATH.'/footer.php';?>