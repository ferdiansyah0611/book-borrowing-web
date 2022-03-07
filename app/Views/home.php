<?= $this->extend('template') ?>
<?= $this->section('header') ?>
<!-- Header -->
<div class="header bg-primary pb-6">
	<div class="container-fluid">
		<div class="header-body">
			<div class="row align-items-center py-4">
				<div class="col-lg-6 col-7">
					<h6 class="h2 text-white d-inline-block mb-0">Dashboards</h6>
					<nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
						<ol class="breadcrumb breadcrumb-links breadcrumb-dark">
							<li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
							<li class="breadcrumb-item active"><a href="#">Dashboards</a></li>
						</ol>
					</nav>
				</div>
			</div>
			<!-- Card stats -->
			<div class="row">
				<div class="col-xl-3 col-md-6">
					<div class="card card-stats">
						<!-- Card body -->
						<div class="card-body">
							<div class="row">
								<div class="col">
									<h5 class="card-title text-uppercase text-muted mb-0">Total request</h5>
									<span class="h2 font-weight-bold mb-0"><?= $count['view'] ?></span>
								</div>
								<div class="col-auto">
									<div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
										<i class="ni ni-active-40"></i>
									</div>
								</div>
							</div>
							<p class="mt-3 mb-0 text-sm">
								<span class="text-nowrap">Since last month</span>
							</p>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-md-6">
					<div class="card card-stats">
						<!-- Card body -->
						<div class="card-body">
							<div class="row">
								<div class="col">
									<h5 class="card-title text-uppercase text-muted mb-0">New book</h5>
									<span class="h2 font-weight-bold mb-0"><?= $count['book'] ?></span>
								</div>
								<div class="col-auto">
									<div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
										<i class="ni ni-chart-pie-35"></i>
									</div>
								</div>
							</div>
							<p class="mt-3 mb-0 text-sm">
								<span class="text-nowrap">Since last month</span>
							</p>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-md-6">
					<div class="card card-stats">
						<!-- Card body -->
						<div class="card-body">
							<div class="row">
								<div class="col">
									<h5 class="card-title text-uppercase text-muted mb-0">New user</h5>
									<span class="h2 font-weight-bold mb-0"><?= $count['user'] ?></span>
								</div>
								<div class="col-auto">
									<div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
										<i class="ni ni-single-02"></i>
									</div>
								</div>
							</div>
							<p class="mt-3 mb-0 text-sm">
								<span class="text-nowrap">Since last month</span>
							</p>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-md-6">
					<div class="card card-stats">
						<!-- Card body -->
						<div class="card-body">
							<div class="row">
								<div class="col">
									<h5 class="card-title text-uppercase text-muted mb-0">Borrow</h5>
									<span class="h2 font-weight-bold mb-0"><?= $count['borrow'] ?></span>
								</div>
								<div class="col-auto">
									<div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
										<i class="ni ni-chart-bar-32"></i>
									</div>
								</div>
							</div>
							<p class="mt-3 mb-0 text-sm">
								<span class="text-nowrap">Since last month</span>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="mt-4">
	<div class="row">
		<div class="col-xl-4 order-xl-2">
			<div class="card card-profile">
				<img src="<?= base_url() ?>/argon/assets/img/theme/img-1-1000x600.jpg" alt="Image placeholder" class="card-img-top">
				<div class="row justify-content-center">
					<div class="col-lg-3 order-lg-2">
						<div class="card-profile-image">
							<a href="#">
								<img src="<?= base_url() ?>/argon/assets/img/theme/team-4.jpg" class="rounded-circle">
							</a>
						</div>
					</div>
				</div>
				<div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
				</div>
				<div class="card-body pt-0">
					<div class="row">
						<div class="col">
							<div class="card-profile-stats d-flex justify-content-center">
								
							</div>
						</div>
					</div>
					<div class="text-center">
						<h5 class="h3"><?= $user['username'] ?></h5>
						<div class="h5 font-weight-300">
							<i class="ni business_briefcase-24 mr-2"></i><?= $user['role'] ?> - Fairy Tech
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-8">
			<div class="card bg-default">
				<div class="card-body">
					<div class="chart">
						<canvas id="chart-sales-dark" class="chart-canvas"></canvas>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?= $this->endSection() ?>