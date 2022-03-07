<?= $this->extend('template') ?>
<?= $this->section('content') ?>
<div class="row mt-1">
	<div class="col-12">
		<div class="card mt-3">
			<div class="card-header">
				<div class="row align-items-center">
					<div class="col">
						<h6 class="text-light text-uppercase ls-1 mb-1"><?= isset($data['id']) ? 'Edit': 'Create' ?></h6>
					</div>
				</div>
			</div>
			<div class="card-body">
				<form action="<?= base_url('ebook') ?>" method="post" enctype="multipart/form-data">
					<div class="row">
						<input type="hidden" name="id" value="<?= isset($data) ? $data['id']: '' ?>">
						<div class="col-12">
							<div class="form-group">
								<label for="" class="form-control-label">Title</label>
								<input value="<?= isset($data['title']) ? $data['title']: '' ?>" type="text" class="form-control form-control-alternative" name="title" placeholder="Type here">
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label for="" class="form-control-label">Upload PDF</label>
								<input type="file" class="form-control form-control-alternative" name="file">
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
<?= $this->section('js') ?>
<script>
$(document).ready(() => {
	const init = () => {

	}
	init()
})
</script>
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
							<li class="breadcrumb-item"><a href="/ebook">ebook</a></li>
							<li class="breadcrumb-item active" aria-current="page"><?= isset($data['id']) ? 'edit': 'create' ?></li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
</div>
<?= $this->endSection() ?>