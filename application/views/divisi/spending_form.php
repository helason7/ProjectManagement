		<div class="panel-title" style="padding-bottom:0px; padding-top:30px;">
		  <ul class="topstats clearfix">
			<li class="arrow"></li>
			<li class="col-xs-4 col-lg-4">
			  <span class="title"> Allocated</span>
			  <h4><?="Rp ".number_format($budgets->AMOUNT)?></h4>
			</li>
			<li class="col-xs-4 col-lg-4">
			  <span class="title">Used</span>
			  <h4><?="Rp ".number_format($budgets->USAGE)?></h4>
			</li>
			<li class="col-xs-4 col-lg-4">
			  <span class="title"> Remained</span>
			  <h4><?="Rp ".number_format($budgets->REMAINDER)?></h4>
			</li>
		  </ul>
		</div>
		
		<center><h2>Form Penggunaan Anggaran</h2></center>
		
						<table  class="table display">
							<tr>
									<td>Deskripsi</td> <td> : </td> <td> <textarea name="desc" style="width:300px;" class="form-control"> </textarea> </td>
							</tr>
							<tr>
								<td>Cost</td> <td> : </td> 
								<td> 
									<fieldset>
										<div class="control-group">
										  <div class="controls">
										   <div class="input-prepend input-group">
												<span class="add-on input-group-addon">
														<input type="text" value="Rp" name="curr" style="width:30px; height:20px;"/>
												</span>
												<input type="text" style="width:200px; text-align:right;" name="cost" class="form-control" value=""/> 
										   </div>
										  </div>
										</div>
									</fieldset>
								</td>
							</tr>
							<tr>
								<td> Tanggal Kegiatan </td> <td> : </td>
								<td>
									<fieldset>
										<div class="control-group">
										  <div class="controls">
										   <div class="input-prepend input-group">
											 <span class="add-on input-group-addon"><i class="fa fa-calendar"></i></span>
											 <input type="text" style="width:200px;" id="act_date" name="act_date" class="form-control" value=""/> 
										   </div>
										  </div>
										</div>
									</fieldset>
								</td>
							</tr>
							<tr>
								<td>
									File</td> <td> : </td> <td> 
										<input type="file" name="doc" /><input type="hidden" name="type" value="OPPORTUNITY"/>
										<input type="hidden" name="idOPP" value="<?=$oppID?>"/>
										<input type="hidden" name="bID" value="<?=$bID?>"/>
										<input type="hidden" name="idOPPB" value="<?=$budgets->ID?>"/>
									</td>
							</tr>
							<tr>
								<td colspan="3"><center><button type="submit" class="btn btn-default">Add New Spending</button></center></td>
							</tr>
						</table>
						
	<script>
$(document).ready(function() {
	$('#act_date').daterangepicker({ 
		singleDatePicker: true, 
		locale: {
					format: 'YYYY-MMM-DD'
				} 
	});
} );</script>
						
						