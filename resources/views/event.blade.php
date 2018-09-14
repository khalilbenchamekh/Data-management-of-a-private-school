@extends('layouts.app')

@section('hero-footer')

	<div class="hero-footer">
		<nav class="tabs">
			<div class="container-fluid">
				<ul class="navbar">
					<li class="{{ Request::is('/') ? 'is-active' : '' }}">
						<a href="{{ url('/') }}">الرئيسية</a>
					</li>
					@forelse($newsMenu as $item)
						<li class="{{ Request::is( $cat . '/' . $item->UmdTerm->slug ) ? 'is-active' : '' }}"><a href="{{ url($cat . '/' . $item->UmdTerm->slug) }}">{{ $item->UmdTerm->name }}</a></li>
					@empty

					@endforelse
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

	<section class="section article-container">
				<div class="columns">
					<div class="column is-full article-section">
						@if(isset($event))
							<p class="image is-16by9">
								<img src="{{ asset('uploads/' . $event->post_attachment ) }}">
							</p>
							<div class="content article-content">
								<h4 class="title is-4">{{ $event->post_title }}</h4>
								<h6 class="subtitle is-6">{{ date('d/m/Y', strtotime($event->post_date)) }} - {{ $event->User->name }}</h6>
								<p>{!! $event->post_content !!}</p>
							</div>
						@else
							<div class="content article-content">
								<h4 class="title is-4">حدث غير موجود</h4>
							</div>
						@endif

					</div>
				</div>

			</section>

@endsection

@section('script')
	<script src="https://www.google.com/recaptcha/api.js?hl=ar" async defer></script>
@endsection
