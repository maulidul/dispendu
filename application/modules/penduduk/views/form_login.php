<link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
		
<div class="container">
	<div class='row'>
		<div class="col-md-3" >
			<div class='row'><div style="width:100%"><?php //menu($this->uri->segment(2));?></div></div></div>
		<div class="col-md-6" style="">
					<br>
						  <div class="panel panel-primary">
						   <div class="panel-heading ">
						   		<div class='row'>
								   	<span class='col-md-2'>login</span>
					          	</div>
						   </div>
				  		    <div class="panel-body">
							<div class='row '>
								<?php
echo form_open('penduduk/Login');
 $user=array('type'=>'email','value'=>'','name'=>'email');
 $pass=array('type'=>'password','value'=>'','name'=>'pass');
echo "<table class='table'>
		<tr>
			<td>username</td><td>".form_input($user)."</td>
		</tr><br>
		<tr>
			<td>password</td><td>".form_input($pass)."</td>
		</tr>
		<tr>
			<td></td><td>".form_submit('','kirim')."</td>		
		</tr>

	</table>";
echo form_close();
?>
					</div>
					</div>
					 
				
			</div>
		</div>
		<div class="col-md-3"></div>
	</div>

</div>