@extends('admin.master-admin')

@section('title')

	articles

@endsection

@section('content')

			<h3 class="title is-3">Articles</h3>
			<table class="table">
			  <thead>
				<tr>
				  <th>statut</th>
				  <th>titre</th>
				  <th>date</th>
				  <th colspan="{{ $role == "reporter" ? 2 : 3 }}">actions</th>
				</tr>
			  </thead>
			  <tfoot>
				<tr>
				  <th>statut</th>
				  <th>titre</th>
				  <th>date</th>
				  <th colspan="{{ $role == "reporter" ? 2 : 3 }}">actions</th>
				</tr>
			  </tfoot>
			  <tbody>
				@foreach ($posts as $post)
					<tr>
					  <td class="table-link table-icon">
						<a class=" {{ $post->post_status ? 'a-is-success' : 'a-is-danger'}}">
						  <i class="fa fa-circle"></i>
						</a>
					  </td>
					  <td>{{ $post->post_title }}</td>
					  <td>{{ date('d/m/Y', strtotime($post->post_date)) }}</td>
					  <td class="table-link table-icon">
						<a href="{{ route('admin.articles.edit', $post) }}" class="a-is-warning">
						  <i class="fa fa-pencil"></i>
						</a>
					  </td>
					  @if($role != "reporter")
						  <td class="table-link table-icon">
    						<a href="{{ route('admin.comments.show', $post->ID) }}">
    						  <i class="fa fa-comment"></i>
    						</a>
    					  </td>
					  @endif
					  <td class="table-link table-icon">
						 {{ Form::open(['method' => 'delete', 'url' => route('admin.articles.destroy', $post)]) }}
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
