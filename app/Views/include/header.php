<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Rekam Medis Klinik dr. Farabi</title>

	<!-- Bootstrap core CSS-->
	<link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>">
	<!-- Bootstrap core JS-->
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>

<body style="overflow-x: hidden;">
	<div class="flash-data-success" data-flashdata="<?= session()->getFlashdata('success'); ?>"></div>
	<div class="flash-data-error" data-flashdata="<?= session()->getFlashdata('error'); ?>"></div>
	<div class="container-fluid px-md-5 d-flex flex-row-reverse">
		<a href="<?= base_url('home/logout') ?>">
			<img src="<?= base_url('images/logout.png') ?>" class="img-thumbnail m-2" style="height: 30px;" alt="">
		</a>
		<!-- <form action="#" class="searchform order-lg-last mt-2 ">
			<div class="form-group d-flex">
				<input type="text" class="form-control pl-3" placeholder="Search">
				<button type="submit" placeholder="" class="form-control search"><span class="fa fa-search"></span></button>
			</div>
		</form> -->
	</div>
	<nav class="navbar navbar-expand-lg px-0" id="ftco-navbar">
		<div class="container-fluid d-flex flex-row-reverse align-items-center">
			<div class="navbar me-4 justify-content-center" style="height: 34px; width: 300px; background-color: #E79E5A;">
				<small class="text-white fw-bold"><?php echo $jabatan ?> | <?php echo $nama ?></small>
			</div>
			<?php if ($jabatan == 'ADMINISTRATOR') : ?>
				<a href="<?= base_url('admin/tambah_pasien') ?>">
					<input type="button" class="text-white fw-bold mb-0 ms-3 border-0" value="Beranda" style="background-color: #2269D2;">
				</a>

			<?php elseif ($jabatan == 'PERAWAT') : ?>
				<a href="<?= base_url('perawat/daftar_pasien') ?>">
					<input type="button" class="text-white fw-bold mb-0 ms-3 border-0" value="Beranda" style="background-color: #2269D2;">
				</a>
			<?php elseif ($jabatan == 'DOKTER') : ?>
				<a href="<?= base_url('dokter/daftar_pasien') ?>">
					<input type="button" class="text-white fw-bold mb-0 ms-3 border-0" value="Beranda" style="background-color: #2269D2;">
				</a>
			<?php elseif ($jabatan == 'APOTEKER') : ?>
				<a href="<?= base_url('apoteker/daftar_pasien') ?>">
					<input type="button" class="text-white fw-bold mb-0 ms-3 border-0" value="Beranda" style="background-color: #2269D2;">
				</a>
			<?php elseif ($jabatan == 'SUPER ADMIN') : ?>
				<a href="<?= base_url('pemilik/daftar_dokter') ?>">
					<input type="button" class="text-white fw-bold mb-0 ms-3 border-0" value="Beranda" style="background-color: #2269D2;">
				</a>
			<?php endif; ?>
		</div>
	</nav>