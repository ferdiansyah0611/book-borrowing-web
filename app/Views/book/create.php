<?= $this->extend('template') ?>
<?= $this->section('content') ?>
<div class="row mt-1">
	<div class="col-12">
		<div class="card mt-3">
			<div class="card-header">
				<div class="row align-items-center">
					<div class="col">
						<h6 class="text-light text-uppercase ls-1 mb-1"><?= isset($data['name']) ? 'Edit': 'Create' ?></h6>
					</div>
				</div>
			</div>
			<div class="card-body">
				<form action="<?= base_url('book') ?>" method="post">
						<?php if(session()->getFlashData('validation')): ?>
						<div class="alert alert-danger" role="alert">
								<?php foreach ((array) session()->getFlashData('validation') as $key => $value): ?>
						        <li>
						          <?= $value ?>
						        </li>
						        <?php endforeach; ?>
						</div>
						<?php endif; ?>
					<div class="row">
						<input type="hidden" name="id" value="<?= isset($data) ? $data['id']: '' ?>">
						<div class="col-12">
							<input value="<?= isset($data['name']) ? $data['name']: '' ?>" type="text" class="form-control form-control-alternative" name="name" placeholder="Name">
						</div>
						<div class="col-12 py-4">
							<textarea name="description" id="" cols="30" rows="10" class="form-control form-control-alternative" placeholder="Description"><?= isset($data['description']) ? $data['description']: '' ?></textarea>
						</div>
						<div class="col-12">
							<button type="submit" class="btn btn-primary">Save</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?= $this->endSection() ?>
<?= $this->section('header') ?>
<!-- Header -->
<div class="header bg-primary pb-6">
	<div class="container-fluid">
		<div class="header-body">
			<div class="row align-items-center py-4">
				<div class="col-lg-6 col-7">
					<nav aria-label="breadcrumb" class="d-none d-md-inline-block">
						<ol class="breadcrumb breadcrumb-links breadcrumb-dark">
							<li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
							<li class="breadcrumb-item"><a href="/book">book</a></li>
							<li class="breadcrumb-item active" aria-current="page"><?= isset($data['name']) ? 'edit': 'create' ?></li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
</div>
<?= $this->endSection() ?>