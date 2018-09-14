@extends('layouts.app')

@section('hero-footer')

	<div class="hero-footer">
		<nav class="tabs">
			<div class="container-fluid">
				<ul class="navbar">
					<li class="{{ Request::is('/') ? 'is-active' : '' }}">
						<a href="{{ url('/') }}">الرئيسية</a>
					</li>
					@foreach($newsMenu as $item)
						<li class="{{ Request::is( $category . '/' . $item->UmdTerm->slug ) ? 'is-active' : '' }}"><a href="{{ url($category . '/' . $item->UmdTerm->slug) }}">{{ $item->UmdTerm->name }}</a></li>
					@endforeach
					<li>
						{{ Form::open(['url' => url('search')]) }}
							<p class="control">
								{{ Form::text('search', null , ['class' => 'input', 'placeholder' => 'ابحت']) }}
							</p>
						{{ Form::close() }}
					</li>
				</ul>
			</div>
		</nav>
	</div>

@endsection

@section('content')

	<div class="container category-page">

		<div class="columns is-mobile is-multiline">
			@foreach($tposts as $post)
				<div class="column is-12-mobile is-half-tablet is-one-quarter-desktop">
					<a href="{{ url($category . '/' . $post->UmdTermTaxonomy->UmdTerm->slug . '/' . $post->UmdPost->post_slug . '/' ) }}">
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

@endsection
