<div class="container">
	<div class='row'>
		<div class="col-md-2" ><div class='row'><div style="width:100%"><?php menu($this->uri->segment(3));?></div></div></div>
		<div class="col-md-6" style="">
					<br>
			<div class="panel panel-primary">
				   <div class="panel-heading ">
				   		<div class='row'>
						   	<span class='col-md-8'>insert_kk</span>
			          	</div>
				   </div>
				  	<div class="panel-body">
						<div class='row '>
							<table class='table'>

								<?php
								$action=site_url('penduduk/form_kk');
								$no="";
								$kk_val="";
								$nama="";

								if (isset($data)){	
									 foreach( $data as $row)
										{
											$id=$row->ID;
											$no=$row ->no_kk;
											$kk=$row->no_ktp;
											$nama=$row->nama_kk;
										}
											$action=site_url("penduduk/update_kk/".$id);
									}


								?>
									<?= form_open($action);?> 
									<?php $submit=array('type'=>'submit','value'=>'save','calculhmac(clent, data)lass'=>'btn btn-xs btn-primary');?>
										<!--tr>
												<td><label for='exampleInputEmail1'>id kepala keluarga</label></td>
												<td><?=form_input('id','','class="form-control" id="id_p"')?></td>
										</tr-->
										<tr>
											<td><label for='exampleInputEmail1'>no kk</label></td>
											<td><?=form_input('no_kk',$no,'class="form-control"')?></td>
										</tr>
										<tr>
											<td><label for='exampleInputEmail1'>nama keluarga </label></td>
											<td><?=form_input('nama',$nama,'class="form-control"')?></td>
										</tr>
										<tr>
												<td><?=form_submit($submit)?>
													<button class="btn btn-xs btn-warning" onclick="history.back();">back</button>
												</td>
											</tr>
											<?=form_close();?>
								</table>								
						</div>
					</div>
			</div>
		</div>
		<div class="col-md-2"></div>
	</div>

</div>