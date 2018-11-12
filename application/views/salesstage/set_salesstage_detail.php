
<table  class="table display">
	<tr>
		<th> 
			No
		</th>
		<th style="width:30%;">
			Budget Name
		</th>
		<th style="width:40%;">
			Component Name
		</th>
		<th>
			Amount
		</th>
	</tr>
	<?php foreach($budget as $key=>$bud){
		
	?>
		<tr>
			<td><?=$bud['ORDER']?></td><td><?=$bud['TYPE_NAME']?></td><td></td><td>
			<?php
			if(count($bud['COMP_NAME']) == 1){
			?>
				<input type="text" class="form-control" name="budget[<?=$key?>]"  style="text-align:right;"/>
			<?php
			}
			?></td>
		</tr>
		<?php
			foreach($bud['COMP_NAME'] as $comp)
			{
				if($comp != "")
				{
					$comp_ = explode("|",$comp);
		?>		
		<tr>
			<td><?=$comp_[1]?></td><td></td><td><?=$comp_[0]?></td><td><input type="text" class="form-control" name="budget[<?=$comp_[2]?>]" style="text-align:right;"/></td>
		</tr>
		
		<?php		
				}
			}
		?>
	<?php
	}
	?>
</table>