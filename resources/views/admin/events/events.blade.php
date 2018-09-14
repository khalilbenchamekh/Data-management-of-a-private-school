@extends('admin.master-admin')

@section('title')

	articles

@endsection

@section('content')

			<h3 class="title is-3">Evenements</h3>
			<table class="table">
			  <thead>
				<tr>
				  <th>statut</th>
				  <th>titre</th>
				  <th>date</th>
				  <th colspan="2">actions</th>
				</tr>
			  </thead>
			  <tfoot>
				<tr>
				  <th>statut</th>
				  <th>titre</th>
				  <th>date</th>
				  <th colspan="2">actions</th>
				</tr>
			  </tfoot>
			  <tbody>
				@foreach ($events as $event)
					<tr>
					  <td class="table-link table-icon">
						<a class=" {{ $event->post_status ? 'a-is-success' : 'a-is-danger'}}">
						  <i class="fa fa-circle"></i>
						</a>
					  </td>
					  <td>{{ $event->post_title }}</td>
					  <td>{{ date('d/m/Y', strtotime($event->post_date)) }}</td>
					  <td class="table-link table-icon">
						<a href="{{ route('admin.events.edit', $event) }}" class="a-is-warning modal-button">
						  <i class="fa fa-pencil"></i>
						</a>
					  </td>
					  <td class="table-link table-icon">
						 {{ Form::open(['method' => 'delete', 'url' => route('admin.events.destroy', $event)]) }}
							<button class="button a-is-danger">
							  <i class="fa fa-remove"></i>
						  	</button>
						  {{ Form::close() }}
					  </td>
					</tr>
				@endforeach
			  </tbody>
			</table>

@endsection
