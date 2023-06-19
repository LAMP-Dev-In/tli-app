<?php include VIEW_PATH.'/header.php'; ?>
<caption> <center><b>List of Customers with Visa Service and Agent</b></center> </caption>

<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Customer</th>
      <th scope="col">Rank</th>
	  <th scope="col">Status</th>
      <th scope="col">Premium Service</th>
	  <th scope="col">Agent</th>
    </tr>
  </thead>
  <tbody>
	<?php 
		$i = 0;	
		foreach($customers as $customer) {
	?>
		<tr>
		<th scope="row"><?= ++$i?></th>
		<td><a href="./customer/<?= $customer['Customer']?>"><?= $customer['Customer']?></a></td>
		<td><?= $customer['Rank']?></td>
		<td><?= $customer['stat']?></td>
		<td><?= $customer['Premium_Service']?></td>
		<td><?= $customer['Agent']?></td>
		</tr>
	<?php
	}	
	?>

  </tbody>
</table>



<?php include VIEW_PATH.'/footer.php';?>