<?= $this->extend('template') ?>
<?= $this->section('title') ?>
Profile
<?= $this->endSection() ?>
<?= $this->section('header') ?>
<!-- Header -->
<div class="header bg-primary pb-6">
	<div class="container-fluid">
		<div class="header-body">
			<div class="row align-items-center py-4">
				<div class="col-lg-6 col-7">
					<h6 class="h2 text-white d-inline-block mb-0">My Profile</h6>
					<nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
						<ol class="breadcrumb breadcrumb-links breadcrumb-dark">
							<li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
							<li class="breadcrumb-item active"><a href="#">Profile</a></li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
</div>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="mt-4">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<div class="row align-items-center">
						<div class="col-8">
							<h3 class="mb-0">Edit profile </h3>
						</div>
						<div class="col-4 text-right">
							<a href="#!" class="btn btn-sm btn-primary change">Save Change</a>
						</div>
					</div>
				</div>
				<div class="card-body">
					<form id="profile" method="post" action="<?= route_to('App\Controllers\UserController::profile') ?>">
						<?= csrf_field() ?>
						<?php if(session()->getFlashData('validation')): ?>
							<div class="alert alert-danger" role="alert">
								<?php foreach ((array) session()->getFlashData('validation') as $key => $value): ?>
							        <li>
							          <?= $value ?>
							        </li>
							    <?php endforeach; ?>
							</div>
						<?php endif; ?>
						<h6 class="heading-small text-muted mb-4">User information</h6>
						<div class="pl-lg-4">
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<label class="form-control-label" for="input-username">Username</label>
										<input type="text" id="input-username" name="username" class="form-control" placeholder="Username" value="<?= $data['username'] ?>">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label class="form-control-label" for="input-email">Email address</label>
										<input disabled type="email" id="input-email" class="form-control" placeholder="<?= $data['email'] ?>">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="form-control-label" for="input-old-pw">Old Password</label>
										<input id="input-old-pw" class="form-control" placeholder="Type Here" name="old_password" type="password">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="form-control-label" for="input-new-pw">New Password</label>
										<input type="password" id="input-new-pw" class="form-control" placeholder="Type Here" name="new_password">
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?= $this->endSection() ?>
<?= $this->section('js') ?>
<script>
$(document).ready(() => {
	$('.change').click((e) => {
		e.preventDefault()
		$('form#profile').submit()
	})
})
</script>
<?= $this->endSection() ?>