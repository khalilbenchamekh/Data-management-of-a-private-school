@extends('layouts.app')

@section('content')

	<div class="container category-page">
		<div class="columns is-mobile is-multiline">
			<div class="column is-12-mobile is-one-quarter">
				<nav class="panel">
				  <p class="panel-heading">
				    {{ $newsTerm->name }}
				  </p>
				  @foreach($newsMenu as $item)
					  <a class="panel-block {{ Request::is( $category . '/' . $item->UmdTerm->slug ) ? 'is-active' : '' }}" href="{{ url($category . '/' . $item->UmdTerm->slug) }}">
					    {{ $item->UmdTerm->name }}
					  </a>
				  @endforeach

				</nav>
			</div>
			<div class="column is-12-mobile is-three-quarters">
				<div class="columns is-mobile is-multiline">
					@foreach($posts as $post)
						<div class="column is-12-mobile is-half-tablet is-one-third-desktop">
							<a href="{{ url($category . '/' . $post['UmdTermTaxonomy']['UmdTerm']['slug'] . '/' . $post['UmdPost']['post_slug'] . '/' ) }}">
								<div class="card">
								  <div class="card-image">
									<figure class="image is-4by3">
									  <img src="{{ asset('uploads/' . $post->UmdPost->post_attachment) }}" alt="">
									</figure>
								  </div>
								  <div class="card-content">
									<div class="media-right">
									  <div class="media-content">
										<p class="title is-5">{{ $post->UmdPost->post_title }}</p>
									  </div>
									</div>
									<div class="content">{{ $post->UmdPost->post_excerpt }}
									  <br>
									  <small>التاريخ : {{ date('d/m/Y', strtotime($post->UmdPost->post_date)) }}</small>
									</div>
								  </div>
								</div>
							</a>
						</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>

@endsection
