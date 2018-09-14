@extends('admin.master-admin')

@section('title')

	articles

@endsection

@section('content')

			<h3 class="title is-3">Categories</h3>
			<table class="table">
			  <thead>
				<tr>
				  <th>titre</th>
				  <th>parent</th>
				  <th colspan="2">actions</th>
				</tr>
			  </thead>
			  <tfoot>
				<tr>
				  <th>titre</th>
				  <th>parent</th>
				  <th colspan="2">actions</th>
				</tr>
			  </tfoot>
			  <tbody>
				@foreach ($categories as $category)
					<tr>
					  <td>{{ $category->UmdTerm->name }}</td>
					  <td>
						  @foreach($terms as $term)
    					  	@if($term->term_id == $category->parent)
    					  		{{ $term->name }}
    					  	@endif
    					  @endforeach
					  </td>
					  <td class="table-link table-icon">
						<a href="{{ route('admin.categories.edit', $category->term_taxonomy_id) }}" class="a-is-warning">
						  <i class="fa fa-pencil"></i>
						</a>
					  </td>
					  <td class="table-link table-icon">
						 {{ Form::open(['method' => 'delete', 'url' => route('admin.categories.destroy', $category)]) }}
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
