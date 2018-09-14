@extends('admin.master-admin')

@section('title')

	memberaires

@endsection

@section('content')

			<h3 class="title is-3">Membres</h3>
			<table class="table">
			  <thead>
				<tr>
					<th>nom</th>
  					<th>prenom</th>
					<th>date nais.</th>
  					<th>ville</th>
					<th>métier</th>
					<th>CIN</th>
					<th>n telephone</th>
					<th>e-mail</th>
					<th>actions</th>
				</tr>
			  </thead>
			  <tfoot>
				<tr>
					<th>nom</th>
    				<th>prenom</th>
  					<th>date nais.</th>
    				<th>ville</th>
  					<th>métier</th>
  					<th>CIN</th>
  					<th>n telephone</th>
  					<th>e-mail</th>
  					<th>actions</th>
				</tr>
			  </tfoot>
			  <tbody>
				@foreach ($members as $member)
					<tr>
					  <td>{{ $member->lname }}</td>
					  <td>{{ $member->fname }}</td>
					  <td>{{ $member->date }}</td>
					  <td>{{ $member->city }}</td>
					  <td>{{ $member->job }}</td>
					  <td>{{ $member->cin }}</td>
					  <td>{{ $member->phone }}</td>
					  <td>{{ $member->email }}</td>
					  <td class="table-link table-icon">
						 {{ Form::open(['method' => 'delete', 'url' => url('admin/mem/delete/'.$member->id)]) }}

							<button type="submit" class="button a-is-danger">
							  <i class="fa fa-remove"></i>
						  	</button>
						  {{ Form::close() }}
					  </td>
					</tr>
				@endforeach
			  </tbody>
			</table>

@endsection
