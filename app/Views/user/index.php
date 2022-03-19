<?= $this->extend('template') ?>
<?= $this->section('title') ?>
User
<?= $this->endSection() ?>
<?= $this->section('header') ?>
<!-- Header -->
<div class="header bg-primary pb-6">
	<div class="container-fluid">
		<div class="header-body">
			<div class="row align-items-center py-4">
				<div class="col-lg-6 col-7">
					<h6 class="h2 text-white d-inline-block mb-0">User</h6>
					<nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
						<ol class="breadcrumb breadcrumb-links breadcrumb-dark">
							<li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
							<li class="breadcrumb-item active" aria-current="page">user</li>
						</ol>
					</nav>
				</div>
				<div class="col-lg-6 col-5 text-right">
					<a href="<?= base_url('user/new') ?>" class="btn btn-sm btn-neutral">New</a>
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
			<div class="card-header">
              	<h3 class="mb-0">Data</h3>
            </div>
			<div class="table-responsive py-4">
				<table id="table" class="table align-items-center table-flush">
					<thead class="thead-light">
						<tr>
							<th scope="col" class="sort" data-sort="name">ID</th>
							<th scope="col" class="sort" data-sort="username">Name</th>
							<th scope="col" class="sort" data-sort="email">Email</th>
							<th scope="col" class="sort" data-sort="created_at">Created</th>
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
	    	url: '/user/json'
	  	},
	  	columns: [
	  		{data: 'id', render: render(0)},
			{data: 'username', render: render(1)},
			{data: 'email', render: render(2)},
			{data: 'created_at', render: render(3)},
			{data: "action", render: function ( data, type, row, meta ) {
		  		var value = '';
				value += `<a href="<?= base_url('user') ?>/${row[0]}/edit" class="btn btn-sm btn-primary">Edit</a>`
				value += `<button data-id="${row[0]}" type="submit" class="btn btn-sm btn-danger deleted">Remove</button>`
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
				var url = `/user/${id}/delete`
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