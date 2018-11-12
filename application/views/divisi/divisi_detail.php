
<table  class="table display">
	<tr>
		<th> 
			No
		</th>
		<th>
			Budget Name
		</th>
		<th>
			Component Name
		</th>
	</tr>
	<?php foreach($budget as $bud){
		
	?>
		<tr>
			<td><?=$bud['ORDER']?></td><td><?=$bud['TYPE_NAME']?></td><td></td>
		</tr>
		<?php
			foreach($bud['COMP_NAME'] as $comp)
			{
				if($comp != "")
				{
					$comp_ = explode("|",$comp);
		?>		
		<tr>
			<td><?=$comp_[1]?></td><td></td><td><?=$comp_[0]?></td>
		</tr>
		
		<?php		
				}
			}
		?>
	<?php
	}
	?>
</table>