
<table  class="table display">
	<tr>
		<th style="width:5%;"> 
			No
		</th>
		<th style="width:25%;">
			Budget Name
		</th>
		<th style="width:25%;">
			Component Name
		</th>
		<th style="width:15%;">
			Allocated
		</th>
		<th style="width:15%;">
			Used
		</th>
		<th style="width:15%;">
			Remained
		</th>
	</tr>
	<?php foreach($budgets as $key=>$bud){
		
	?>
		<tr>
			<td><?=$bud['ORDER']?></td><td><?=$bud['TYPE_NAME']?></td><td></td><td style="text-align:right;">
			<?php
			if(count($bud['COMP_NAME']) == 1){
			?>
				Rp <?=number_format($bud['AMOUNT'])?>
			<?php
			}
			?></td>
			<td style="text-align:right;">
				<?php
				if(count($bud['COMP_NAME']) == 1){
				echo "Rp ".number_format($bud['USAGE']) ;
				}
				?>
			</td>
			<td style="text-align:right;">
				<?php
				if(count($bud['COMP_NAME']) == 1){
				echo "Rp ".number_format($bud['REMAINDER']) ;
				}
				?>
			</td>
		</tr>
		<?php
			foreach($bud['COMP_NAME'] as $comp)
			{
				if($comp != "")
				{
					$comp_ = explode("|",$comp);
		?>		
		<tr>
			<td><?=$comp_[1]?></td><td></td><td><?=$comp_[0]?></td><td style="text-align:right;">Rp <?=number_format($comp_[3])?></td><td style="text-align:right;">Rp <?=number_format($comp_[4])?></td><td style="text-align:right;">Rp <?=number_format($comp_[5])?></td>
		</tr>
		
		<?php		
				}
			}
		?>
	<?php
	}
	?>
</table>