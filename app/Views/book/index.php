<?= $this->extend('template') ?>
<?= $this->section('title') ?>
Book
<?= $this->endSection() ?>
<?= $this->section('header') ?>
<!-- Header -->
<div class="header bg-primary pb-6">
	<div class="container-fluid">
		<div class="header-body">
			<div class="row align-items-center py-4">
				<div class="col-lg-6 col-7">
					<h6 class="h2 text-white d-inline-block mb-0">Book</h6>
					<nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
						<ol class="breadcrumb breadcrumb-links breadcrumb-dark">
							<li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
							<li class="breadcrumb-item active" aria-current="page">book</li>
						</ol>
					</nav>
				</div>
				<?php if ($user['role'] == 'admin'): ?>
					<div class="col-lg-6 col-5 text-right">
						<a href="<?= base_url('book/new') ?>" class="btn btn-sm btn-neutral">New</a>
					</div>
				<?php endif ?>
			</div>
		</div>
	</div>
</div>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="row mt-1">
	<div class="col-12">
		<div class="card">
            <div class="card-header">
              	<h3 class="mb-0">Data</h3>
            </div>
            <div class="table-responsive py-4">
             	<table class="table table-flush" id="table">
              		<thead class="thead-light">
                  		<tr>
                    		<th class="sort" scope="col" data-sort="id">ID</th>
                    		<th class="sort" scope="col" data-sort="name">Name</th>
                    		<th class="sort" scope="col" data-sort="name_publisher">Name Publisher</th>
                    		<th class="sort" scope="col" data-sort="year_publisher">Year Publisher</th>
                    		<th class="sort" scope="col" data-sort="author">Author</th>
                    		<th>Action</th>
                 		</tr>
                	</thead>
            	</table>
          	</div>
		</div>
	</div>
</div>
<?= $this->endSection() ?>
<?= $this->section('js') ?>
<?= $this->include('component/datatable.php') ?>
<script>
$(document).ready(() => {
	const render = (key) => ( data, type, row, meta ) => row[key]
	let table = $('#table').DataTable({
	  	processing: true,
	  	serverSide: true,
	  	ajax: {
	    	url: '/book/json'
	  	},
	  	columns: [
			{data: 'id', render: render(0)},
			{data: 'name', render: render(1)},
			{data: 'name_publisher', render: render(2)},
			{data: 'year_publisher', render: render(3)},
			{data: 'author', render: render(4)},
			{data: "action", render : function ( data, type, row, meta ) {
		  		var value = `<a href="<?= base_url('borrow-book/new') ?>?id=${row[0]}" class="btn btn-sm btn-secondary">Borrow</a>`;
		  		var isAdmin = '<?= $user['role'] == 'admin' ?>';
				if (isAdmin) {
					value += `<a href="<?= base_url('book') ?>/${row[0]}/edit" class="btn btn-sm btn-primary">Edit</a>`
					value += `<button data-id="${row[0]}" type="submit" class="btn btn-sm btn-danger deleted">Remove</button>`
				}
				return value
          	}},
	  	],
		columnDefs: [
			{
        		targets: [4],
        		orderable: false,
     			searchable: false
     		}
     	]
	});
	$("#table").on("draw.dt", function () {
		const deleted = () => {
			$('button.deleted').click(function(e){
				var id = $(this).data('id')
				var url = `/book/${id}/delete`
				$.ajax({
					url: url,
					method: 'DELETE',
					success: () => table.ajax.reload()
				})
			})
		}
		deleted()
	})
})
</script>
<?= $this->endSection() ?>