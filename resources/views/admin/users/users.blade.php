@extends('admin.master-admin')

@section('title')

	utilisateurs

@endsection

@section('content')

			<h3 class="title is-3">Utilisateurs</h3>
			<table class="table">
			  <thead>
				<tr>
				  <th>nom</th>
				  <th>role</th>
				  <th colspan="2">actions</th>
				</tr>
			  </thead>
			  <tfoot>
				<tr>
				  <th>nom</th>
				  <th>role</th>
				  <th colspan="2">actions</th>
				</tr>
			  </tfoot>
			  <tbody>
				@foreach ($users as $user)
					<tr>
					  <td>{{ $user->name }}</td>
					  <td>@if($user->role_id == 1)
						  admin
					  @elseif($user->role_id == 2)
						  manager
					  @else
						  reporter
					  @endif</td>
					  <td class="table-link table-icon">
						<a href="{{ route('admin.users.edit', $user) }}" class="a-is-warning">
						  <i class="fa fa-pencil"></i>
						</a>
					  </td>
					  <td class="table-link table-icon">
						 {{ Form::open(['method' => 'delete', 'url' => route('admin.users.destroy', $user)]) }}
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
