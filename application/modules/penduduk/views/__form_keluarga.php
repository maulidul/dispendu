<div >

<?php $submit=array('type'=>'submit','value'=>'save','class'=>'btn btn-xs btn-primary');?>
							
	<table class='table'> 

		<tr><td><label for='exampleInputEmail1'>tempat lahir</label></td>
			<td><?=form_input("tempat","","class='form-control'")?></td>
		</tr>
		<tr><td><label for='exampleInputEmail1'>tanggal_lahir</label></td>
			<td><?=form_input("tanggal","","class='form-control'")?></td>
		</tr>
		<tr><td></td>
			<td><?=form_submit($submit)//form_submit($submit)=($menu_ac)?(false)?>
		<button class='btn btn-xs btn-warning' onclick='history.back();'>back</button>
			</td>
		</tr>
	</table></div>

					 
				
</div>