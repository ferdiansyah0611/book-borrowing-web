<?= $this->extend('template') ?>
<?= $this->section('title') ?>
Borrow Book
<?= $this->endSection() ?>
<?= $this->section('header') ?>
<!-- Header -->
<div class="header bg-primary pb-6">
	<div class="container-fluid">
		<div class="header-body">
			<div class="row align-items-center py-4">
				<div class="col-lg-6 col-7">
					<h6 class="h2 text-white d-inline-block mb-0">Borrow Book</h6>
					<nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
						<ol class="breadcrumb breadcrumb-links breadcrumb-dark">
							<li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
							<li class="breadcrumb-item active" aria-current="page">borrow-book</li>
						</ol>
					</nav>
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
				<table id="table" class="table table-flush">
					<thead class="thead-light">
						<tr>
							<th scope="col" class="sort" data-sort="name">ID</th>
							<th scope="col" class="sort" data-sort="username">User</th>
							<th scope="col" class="sort" data-sort="booksname">Books</th>
							<th scope="col" class="sort" data-sort="start">Start</th>
							<th scope="col" class="sort" data-sort="end">End</th>
							<th scope="col" class="sort" data-sort="created_at">Created</th>
							<?php if ($user['role'] == 'admin'): ?>
								<th>Action</th>
							<?php endif ?>
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
	var isAdmin = '<?= $user['role'] == 'admin' ?>';
	const columns = [
		{data: 'id', render: render(0)},
		{data: 'username', render: render(4)},
		{data: 'booksname', render: render(5)},
		{data: 'start', render: render(3)},
		{data: 'end', render: function( data, type, row, meta ){
			var classed = new Date(row[2]).getTime() < new Date().getTime() ? 'badge badge-danger': 'badge badge-success' 
			return `<div class="${classed}">${row[2]}</div>`
		}},
		{data: 'created_at', render: render(3)},
	]
	if (parseInt(isAdmin)) {
		columns.push({data: "action", render : function ( data, type, row, meta ) {
		  	var value = '';
			value += `<a href="<?= base_url('borrow-book') ?>/${row[0]}/edit" class="btn btn-sm btn-primary">Edit</a>`
			value += `<button data-id="${row[0]}" type="submit" class="btn btn-sm btn-danger deleted">Remove</button>`
			return value
        }})
	}
	let table = $('#table').DataTable({
	  	processing: true,
	  	serverSide: true,
	  	ajax: {
	    	url: '/borrow-book/json'
	  	},
	  	columns: columns,
     	columnDefs: [
			{
        		targets: [columns.length - 1],
        		orderable: false,
     			searchable: false
     		}
     	]
	});
	$("#table").on("draw.dt", function () {
		const deleted = () => {
			$('button.deleted').click(function(e){
				var id = $(this).data('id')
				var url = `/borrow-book/${id}/delete`
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