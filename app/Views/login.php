<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Rekam Medis Klinik dr. Farabi</title>

	<!-- Bootstrap core CSS-->
	<link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>">
	<!-- Bootstrap core JS-->
	<script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
	<script src="<?= base_url('js/bootstrap.min.js') ?>"></script>
</head>
<style>
	.vertical-center {
		min-height: 100%;
		/* Fallback for browsers do NOT support vh unit */
		min-height: 100vh;
		/* These two lines are counted as one :-)       */
		display: flex;
		align-items: center;
	}
</style>

<body style="overflow-x: hidden;">
	<div class="jumbotron vertical-center">
		<div class="container-lg">
			<div class="row justify-content-md-center">
				<div class="col-md-6">
					<?php if (session()->getFlashdata('msg')) : ?>
						<div class="alert alert-danger"><?= session()->getFlashdata('msg') ?></div>
					<?php endif; ?>
					<form action="<?= base_url('Home/login') ?>" method="POST">
						<div class="form-group form-outline mb-4">

							<!-- <label class="form-label" for="username">Username</label> -->
							<input type="text" class="form-control" name="username" id="username" placeholder="Username" autocomplete="off" required>
							<div class="invalid-feedback">
								Anda belum memasukan username.
							</div>

						</div>
						<div class="form-group form-outline mb-4">
							<!-- <label for="password">Password</label> -->
							<input type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="off" required>
							<div class="invalid-feedback">
								Anda belum memasukan password.
							</div>
						</div>
						<div class="row justify-content-center py-4 bg-white">
							<div class="col text-center">
								<button type="submit" class="btn btn-primary text-center px-3 py-2" name="simpan">LOGIN</button>
							</div>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>
	</div>
</body>

</html>