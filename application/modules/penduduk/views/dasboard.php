<script src="<?=base_url('assets/js/raphael-min.js')?>"></script>
<script src="<?=base_url('assets/js/morris.min.js')?>"></script>
<link rel="stylesheet" href="<?=base_url('assets/css/morris.css')?>">
<div class="container">
	<div class='row'>
		<div class=col-md-2 ><div class='row'><div style="width:100%"><?php menu($menu_ac);?></div></div></div>
			<div class=col-md-10 style="overflow:auto">
			 <!--penduduk-->
			 <br>
			 <div class="panel panel-primary">
				<div class="panel-heading ">
					<div class='row'>
					 	<span class='col-md-8'>Data penduduk</span> 	
					</div>
				</div>
				<div class="panel-body ">
					<div id="penduduk"></div>	
				</div>  
			 </div>
			 <!--kematian-->
			 <br>
			 <div class="panel panel-danger">
				<div class="panel-heading ">
					<div class='row'>
					 	<span class='col-md-8'>Data Kematian</span> 	
					</div>
				</div>
				<div class="panel-body ">
					<div id="kematian"></div>	
				</div>  
			 </div>
			 <!--kelahiran-->
			 <br>
			 <div class="panel panel-default">
				<div class="panel-heading ">
					<div class='row'>
					 	<span class='col-md-8'>Data Kelahiran</span> 	
					</div>
				</div>
				<div class="panel-body ">
					<div id="kelahiran"></div>	
				</div>  
			 </div>
			 <!--masuk-->
			 <br>
			 <div class="panel panel-default">
				<div class="panel-heading ">
					<div class='row'>
					 	<span class='col-md-8'>Data Penduduk masuk</span> 	
					</div>
				</div>
				<div class="panel-body ">
					<div id="masuk"></div>	
				</div>  
			 </div>
			 <!--keluar-->
			 <br>
			 <div class="panel panel-default">
				<div class="panel-heading ">
					<div class='row'>
					 	<span class='col-md-8'>Data Penduduk Keluar</span> 	
					</div>
				</div>
				<div class="panel-body ">
					<div id="keluar"></div>	
				</div>  
			 </div>
		</div>
		
	</div>
		

</div>   
<script>
/* data stolen from http://howmanyleft.co.uk/vehicle/jaguar_'e'_type */
var kelahiran = <?=$kelahiran?>;
var kematian = <?=$kematian?>;
var penduduk = <?=$penduduk?>;
var masuk = <?=$masuk?>;
var keluar = <?=$keluar?>;

Morris.Bar({
	element: 'penduduk',
	data: penduduk,
	xkey: 'tahun',
	ykeys: ['jumlah'],
	labels: ['Jumlah'],
	xLabelAngle: 60
});

Morris.Bar({
	element: 'kematian',
	data: kematian,
	xkey: 'tahun_mati',
	ykeys: ['jumlah'],
	labels: ['Jumlah'],
	xLabelAngle: 60
});

Morris.Bar({
	element: 'kelahiran',
	data: kelahiran,
	xkey: 'tahun_lahir',
	ykeys: ['jumlah'],
	labels: ['Jumlah'],
	xLabelAngle: 60
});
Morris.Bar({
	element: 'masuk',
	data: masuk,
	xkey: 'bulan_pindah',
	ykeys: ['jumlah'],
	labels: ['Jumlah'],
	xLabelAngle: 60
});
Morris.Bar({
	element: 'keluar',
	data: keluar,
	xkey: 'bulan_pindah',
	ykeys: ['jumlah'],
	labels: ['Jumlah'],
	xLabelAngle: 60
});
</script>