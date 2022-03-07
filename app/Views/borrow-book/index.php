<?= $this->extend('template') ?>
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
							<li class="breadcrumb-item active" aria-current="page">borrow-book</li>
						</ol>
					</nav>
				</div>
				<div class="col-lg-6 col-5 text-right">
					<a href="#" class="btn btn-sm btn-neutral">Filters</a>
				</div>
			</div>
		</div>
	</div>
</div>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="row mt-1">
	<div class="col">
		<div class="card">
			<div class="card-header border-0">
				<h3 class="mb-0">Borrow Book</h3>
			</div>
			<div class="card-header border-0">
				<form action="">
					<input type="search" value="<?=  isset($_GET['search']) ? $_GET['search']: '' ?>" class="form-control form-control-alternative" placeholder="Search here..." name="search">
				</form>
			</div>
			<div class="table-responsive">
				<table class="table align-items-center table-flush">
					<thead class="thead-light">
						<tr>
							<th scope="col" class="sort" data-sort="name">ID</th>
							<th scope="col" class="sort" data-sort="budget">User</th>
							<th scope="col" class="sort" data-sort="budget">Books</th>
							<th scope="col" class="sort" data-sort="budget">Start</th>
							<th scope="col" class="sort" data-sort="budget">End</th>
							<th scope="col" class="sort" data-sort="status">Created</th>
							<th scope="col" class="sort" data-sort="status">Action</th>
						</tr>
					</thead>
					<tbody class="list">
						<?php foreach ($list as $key => $data): ?>
						<tr>
							<th scope="row">
								<?= $data->id ?>
							</th>
							<td class="budget">
								<?= $data->username ?>
							</td>
							<td class="budget">
								<?= $data->booksname ?>
							</td>
							<td class="budget">
								<?= $data->start ?>
							</td>
							<td class="budget">
								<?= $data->end ?>
							</td>
							<td>
								<?= $data->created_at ?>
							</td>
							<td>
								<a href="<?= base_url('borrow-book/' . $data->id  . '/edit') ?>" class="btn btn-sm btn-primary">Edit</a>
								<button data-id="<?= $data->id ?>" type="submit" class="btn btn-sm btn-danger deleted">Remove</button>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<!-- Card footer -->
			<div class="card-footer py-4">
				<?= $pager->links() ?>
			</div>
		</div>
	</div>
</div>
<script>
	document.addEventListener('DOMContentLoaded', () => {
		const deleted = () => {
			$('button.deleted').click(function(e){
				var id = $(this).data('id')
				var url = `/borrow-book/${id}/delete`
				$.ajax({
					url: url,
					method: 'DELETE',
					success: () => location.reload(true)
				})
			})
		}
		deleted()
	})
</script>
<?= $this->endSection() ?>