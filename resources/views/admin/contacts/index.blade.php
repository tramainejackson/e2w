@extends('admin.layouts.app')

	@section('styles')
		<!-- DataTables Select CSS -->
		<link href="/css/addons/datatables-select.min.css" rel="stylesheet">
		<!-- DataTables Select CSS -->
		<script href="/css/addons/datatables-select.min.js" rel="stylesheet"></script>
	@endsection

	@section('scripts')
		<script type="text/javascript" src="/js/addons/datatables.min.js"></script>
		<script type="text/javascript">
            // Material Design example
            $('#contacts_table_admin').DataTable();
            $('#contacts_table_admin_wrapper').find('label').each(function () {
                $(this).parent().append($(this).children());
            });
            $('#contacts_table_admin_wrapper .dataTables_filter').find('input').each(function () {
                $('input').attr("placeholder", "Search");
                $('input').removeClass('form-control-sm');
            });
            $('#contacts_table_admin_wrapper .dataTables_length').addClass('d-flex flex-row align-items-center');
            $('#contacts_table_admin_wrapper .dataTables_filter').addClass('md-form');
            $('#contacts_table_admin_wrapper select').removeClass(
                'custom-select custom-select-sm form-control form-control-sm');
            $('#contacts_table_admin_wrapper select').addClass('mdb-select');
            $('#contacts_table_admin_wrapper .dataTables_filter').find('label').remove();
		</script>

	@endsection

	@section('content')

		<div class="row">

			<div class="col">
				<div id="users_page_header" class="">
					<h1 class="pageTopicHeader">All Contacts</h1>
				</div>
			</div>

		</div>

		<div class="row d-xl-none">

			<div class="col text-center py-4">
				<a href="/admin/create" class="btn btn-success">Create New Contact</a>
			</div>

		</div>

		<div class="row">

			<div class="col">

				<table id="contacts_table_admin" class="table table-striped" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th></th>
							<th class="th-sm">Name
							</th>
							<th class="th-sm">Email
							</th>
							<th class="th-sm">Phone
							</th>
							<th></th>
						</tr>
					</thead>

					<tbody>
						@foreach($contacts as $contact)
							<tr>
								<td></td>
								<td>{{ $contact->full_name() }}</td>
								<td>{{ $contact->email }}</td>
								<td>{{ $contact->phone }}</td>
								<td><a href="/participants/{{ $contact->id }}/edit" class="btn btn-default">Edit</a></td>
							</tr>
						@endforeach
					</tbody>

				</table>

			</div>

		</div>

	@endsection