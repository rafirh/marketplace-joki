 <?php 
 $id_toko	= $_SESSION["penjual"]; 
 $ambil=$koneksi->query("SELECT * FROM toko 
 	JOIN pelanggan ON toko.id_toko=pelanggan.id_pelanggan 
 	WHERE toko.id_toko='$id_toko'");
 	$pecah=$ambil->fetch_assoc(); ?>
 	<h1 class="center">Profil Toko</h1>
 	 		<div class="" style="margin-top: 50px;">
 			<img src="../assets/img/homepage/c.jpeg" height="150" width="350" style="position: absolute; z-index: auto;">
 		</div>
 	<div class="row">
 		<div class="col s1" style="position: relative;">
 			<img src="../assets/img/toko/<?php echo $pecah['foto_toko']; ?>" class="circle" height="80" width="80" style="margin-top: 20px;">
 		</div>
 		<div class="col s3" style="margin-top: 10px; position: relative;">
 			<span class="white-text">
 				<h6><b><?php echo $pecah['nama_toko']; ?></b></h6>
 				<h6><?php echo 	$pecah['alamat_toko'] ?></h6>
 			</span>
 		</div>
 		<div class="col s1">
 		<p>
 				<b>
 	 				<i class="tiny material-icons">phone</i>Telpon <br><br>		
 					<i class="tiny material-icons">email</i>email   <br><br>
 					<i class="tiny material-icons">location_on</i>Alamat	 <br>
 				</b>	
 		</p>		
 		</div>
 		<div class="col s3">
 			<p>
 				: <?php echo $pecah['telepon_toko'] ;?> <br> <br>
 				: <?php echo $pecah['email_toko'] ;?><br> <br>
 				: <?php echo $pecah['alamat_toko'] ;?><br>	
 			</p>
 		</div>
 		<?php
 		$ambil= $koneksi->query("SELECT * FROM produk 
 			LEFT JOIN toko ON produk.id_toko=toko.id_toko
 			WHERE produk.id_toko='$id_toko'");
 		while ($detail = $ambil->fetch_assoc()) {
 			$data[]= $detail;
 		}
 		$produk = 0;
 		$stok_produk = 0;
 		$stok_awal = 0;
 		$produk_terjual = 0;
 		$total_pembelian = 0 ;


 		if (isset($data)) {
 			foreach ($data as $key => $value) :{
 				$value['id_toko']=1 ;
 				$toko = $value['id_toko'];
 				$produk += $toko;

 				$stok_produk += $value['stok_produk'];
 				$stok_awal += $value['stok_awal'];
 				$produk_terjual += $stok_awal - $stok_produk ;

 			}endforeach;        
 		} 

 		?>
 		<div class="col s2">
 			<p>
 				<b> 
 					<i class="tiny material-icons">local_offer</i> Jenis produk <br><br>	
 					<i class="tiny material-icons">local_shipping</i> Produk Terjual <br> <br>
 					<i class="tiny material-icons">date_range</i> Bergabung <br>
 				</b> 	
 			</p>	
 		</div>
 		<div class="col s2">
 			<p>
 				
 				: <?php if ($produk < 1): ?>
 					<?php echo "-" ; ?>
 					<?php else: ?>
 						<?php echo 	$produk ?>
 				<?php endif ?> <br>	<br>	
 				: <?php if ($produk_terjual < 1): ?>
 					<?php echo "-" ; ?>
 					<?php else: ?>
 						<?php echo $produk_terjual; ?>
 				<?php endif ?><br><br>
 				: <?php echo date("d F Y", strtotime($pecah['bergabung'])); ?>
 		
 			</p>
 		</div>
 	</div>
 	

		<script  type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script type="text/javascript" src="js/materialize.min.js"></script>

		<script>
			$(document).ready(function() {
				$(".carousel.carousel-slider").carousel({
					fullWidth: true,
					indicators: true
				});
				setInterval(function(){
					$('.carousel.carousel-slider').carousel('next');   
				}, 3000);
			});
		</script>

		<br><br><br>
		<section id="highlights" class="highlights scrollspy">
			<h1 class="center-align">Produk Terbaru</h1>
			<div class="row">
				<?php $ambil=$koneksi->query("SELECT * FROM produk 
					LEFT JOIN kategori ON produk.id_kategori=kategori.id_kategori
					WHERE produk.id_toko='$id_toko' "); ?>
					<?php while($perproduk = $ambil->fetch_assoc()){ ?>
						<div class="grid-example col m3 s12">
							<div class=" responisve-card card hoverable">
								<div class="card-image waves-effect waves-block waves-light">
									<center>												
										<p><strong><?php echo $perproduk['nama_produk']; ?></strong></p>
										<img class="responsive-img activator" src="../assets/img/produk/<?php echo $perproduk['foto_produk']; ?>" style="height: 250px; width: 250px;" id="gambarr">
									</div>
								</center>
								<div class="card-content">
									<h6>kategori : <?php echo $perproduk['nama_kategori'] ?> </h6>
									<p>stok : <?php echo $perproduk['stok_produk'] ?></p>
									<span class="harga">
										<h5>Rp.<?php echo number_format($perproduk['harga_produk']); ?></h5>
									</span> 
									<hr>
								<div class="card-action">
									<a href="index.php?halaman=detail&id=<?php echo $perproduk['id_produk']; ?>" 
										class="btn waves-effect waves-light red btn-small ">detail</a>
											
									</div>
								</div>
							</div>
						</div>
										<?php 	} ?>
					</div>	
			</section>


