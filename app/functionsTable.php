<?php

function printMeals($rows, $headers) {
	?>

	<table class="table table-striped table-sm">
		<thead>
			<tr>
			<?php foreach ($headers as $header): ?>
				<th scope="col"><?php echo $header; ?></th>
			<?php endforeach; ?>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($rows as $row): ?>
			    <tr>
			    <?php for ($k = 0; $k < count($headers); $k++): ?>
			    	<?php if ($k == 2){ ?>
			    		<td>
						<?php 
							if($row[2] == 1) {
								echo "Petit dejeuner";
							} elseif($row[2] == 2) {
								echo "Dejeuner";
							} elseif($row[2] == 3) {
								echo "Souper";
							}elseif($row[2] == 4) {
								echo "Autres";
							} 
						?>
						</td>
			    	<?php } else { ?>
			    		<td><?php echo $row[$k]; ?></td>
						
			    	<?php } ?> 
			    <?php endfor; ?>
			    </tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<?php
}
