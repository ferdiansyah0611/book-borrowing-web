<?= $this->extend('template') ?>
<?= $this->section('title') ?>
Create
<?= $this->endSection() ?>
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
							<div class="form-group">
								<label for="name" class="form-control-label">Name</label>
								<input id="name" value="<?= isset($data['name']) ? $data['name']: '' ?>" type="text" class="form-control form-control-alternative" name="name" placeholder="Name of book" required>
							</div>
							<div class="form-group">
								<label for="Description" class="form-control-label">Description</label>
								<textarea name="description" id="Description" cols="30" rows="10" class="form-control form-control-alternative" placeholder="Description"><?= isset($data['description']) ? $data['description']: '' ?></textarea>
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
								<label for="name_publisher" class="form-control-label">Name Publisher</label>
								<input id="name_publisher" value="<?= isset($data['name_publisher']) ? $data['name_publisher']: '' ?>" type="text" class="form-control form-control-alternative" name="name_publisher" placeholder="Name of publisher" required>
							</div>
						</div>
						<div class="col-6">
							<div class="form-group">
								<label for="year_publisher" class="form-control-label">Year Publisher</label>
								<input id="year_publisher" value="<?= isset($data['year_publisher']) ? $data['year_publisher']: '' ?>" type="number" min="1900" max="2199" step="1" class="form-control form-control-alternative" name="year_publisher" placeholder="Year of publisher" required>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label for="author" class="form-control-label">Author</label>
								<input id="author" value="<?= isset($data['author']) ? $data['author']: '' ?>" type="year" class="form-control form-control-alternative" name="author" placeholder="Name of author" required>
							</div>
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
					<h6 class="h2 text-white d-inline-block mb-0">Create</h6>
					<nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
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