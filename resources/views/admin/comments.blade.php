@extends('admin.master-admin')

@section('title')

	commentaires

@endsection

@section('content')

			<h3 class="title is-3">Commentaires</h3>
			<table class="table">
			  <thead>
				<tr>
				  <th>author</th>
  				  <th>email</th>
  				  <th>content</th>
				  <th>article</th>
				  <th colspan="2">actions</th>
				</tr>
			  </thead>
			  <tfoot>
				<tr>
				  <th>author</th>
				  <th>email</th>
				  <th>content</th>
				  <th>article</th>
				  <th colspan="2">actions</th>
				</tr>
			  </tfoot>
			  <tbody>
				@foreach ($comments as $comment)
					<tr>
					  <td>{{ $comment->comment_author }}</td>
					  <td>{{ $comment->comment_author_email }}</td>
					  <td>{{ $comment->comment_content }}</td>
					  <td>{{ $comment->UmdPost->post_title }}</td>
					  <td class="table-link table-icon">
						  {{ Form::open(['method' => 'put', 'url' => route('admin.comments.update', $comment->ID)]) }}

 							<button type="submit" class="button a-is-success">
 							  <i class="fa fa-check"></i>
 						  	</button>
 						  {{ Form::close() }}
					  </td>
					  <td class="table-link table-icon">
						 {{ Form::open(['method' => 'delete', 'url' => route('admin.comments.destroy', $comment->ID)]) }}

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
