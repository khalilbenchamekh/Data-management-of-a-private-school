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
					<div class="column is-8 article-section">
						<p class="image is-16by9">
							<img src="{{ asset('uploads/' . $post->post_attachment ) }}">
						</p>
						<div class="content article-content">
							<h4 class="title is-4">{{ $post->post_title }}</h4>
							<h6 class="subtitle is-6">{{ date('d/m/Y', strtotime($post->post_date)) }} - {{ $post->User->name }}</h6>
							<p>{!! $post->post_content !!}</p>
							<hr>
							@foreach($post->UmdComments as $comment)
								@if($comment->comment_approved == 1)
									<article class="media">
									  <div class="media-content">
									    <div class="content">
									      <p>
									        <strong>{{ $comment->comment_author }}</strong>
									        <br>
									         {{ $comment->comment_content }}
									        <br>
									      </p>
									    </div>
									  </div>
									</article>
								@endif
							@endforeach
							<article class="media">
							  <div class="media-content">
								  <p>
								  	<strong>اضف تعليق</strong>
								  </p>
								  <form class="" action="{{ url('comment/' . $post->ID) }}" method="post">

									  	{!! csrf_field() !!}

										<p class="control">
										  <input class="input" name="name" type="text" placeholder=""></textarea>
										</p>
										<p class="control">
										  <input class="input" name="email" type="email" placeholder=""></textarea>
										</p>
									  	<p class="control">
		  							      <textarea class="textarea" name="content" type="textarea" placeholder="اضف تعليق ..."></textarea>
		  							    </p>
										<div class="g-recaptcha" data-sitekey="{{ env('RE_CAP_SITE') }}"></div>

										<p class="control">
									      <button type="submit" class="button">احفظ التعليق</button>
									    </p>
								  </form>

							  </div>
							</article>
						</div>
					</div>
					<div class="column is-4 sidebar-section">
						<div class="content">
							<h4 class="title is-4">اخبار متعلقة</h4>
							@foreach($related as $rel)
									<a href="{{ url('article/'. $rel->ID) }}">
										<article class="media">
										  <figure class="media-right">
										    <p class="image is-64x64">
										      <img src="{{ asset('uploads/'. $rel->post_attachment) }}">
										    </p>
										  </figure>
										  <div class="media-content">
										    <div class="content">
										      <p>
										        <strong>{{ $rel->post_title }}</strong>
										        	<br>
										          {!! $rel->post_excerpt !!}
										        <br>
										      </p>
										    </div>
										  </div>
										</article>
									</a>
							@endforeach
						</div>
					</div>
				</div>

			</section>

@endsection

@section('script')
	<script src="https://www.google.com/recaptcha/api.js?hl=ar" async defer></script>
@endsection
