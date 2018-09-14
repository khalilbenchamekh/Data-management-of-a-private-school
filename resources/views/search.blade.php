@extends('layouts.app')

@section('hero-footer')

	<div class="hero-footer">
		<nav class="tabs">
			<div class="container">
				<ul class="navbar">
					<li class="{{ Request::is('/') ? 'is-active' : '' }}">
						<a href="{{ url('/') }}">الرئيسية</a>
					</li>

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
		<h2 class="title is-2">نتائج البحت</h2>
		<div class="columns is-mobile is-multiline">
			@forelse($posts as $post)
				<div class="column is-12-mobile is-half-tablet is-one-third-desktop">
					<a href="{{ url($post->UmdTermRelationship->UmdTermTaxonomy->UmdTermParent->slug . '/' . $post->UmdTermRelationship->UmdTermTaxonomy->UmdTerm->slug . '/' . $post->post_slug . '/' ) }}">
						<div class="card">
						  <div class="card-image">
							<figure class="image is-4by3">
							  <img src="{{ asset('uploads/' . $post->post_attachment) }}" alt="">
							</figure>
						  </div>
						  <div class="card-content">
							<div class="media-right">
							  <div class="media-content">
								<p class="title is-5">{{ $post->post_title }}</p>
							  </div>
							</div>
							<div class="content">{{ $post->post_excerpt }}
							  <br>
							  <small>التاريخ : {{ date('d/m/Y', strtotime($post->post_date)) }}</small>
							</div>
						  </div>
						</div>
					</a>
				</div>
			@empty
				<h5 class="title is-5">لا يوجد اي مقال</h5>
			@endforelse
		</div>
	</div>

@endsection
