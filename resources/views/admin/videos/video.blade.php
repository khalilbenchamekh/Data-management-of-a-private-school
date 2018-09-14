@extends('admin.master-admin')

@section('title')

	modifier un image

@endsection

@section('content')

			<h3 class="title is-3">Modifier un video<a class="button is-primary pull-right" href="{{ url('articles/' . $post->ID) }}" target="_blank">Video</a></h3>

			{{ Form::open(['method' => 'put', 'url' => route('admin.videos.update', $post), 'files' => true]) }}



				<div class="columns">
					<div class="column is-9">
						{{ Form::label('title', 'titre du video : ', ['class' => 'label']) }}
						<p class="control">
							{{ Form::text('title', $post->post_title, ['class' => 'input']) }}
						</p>

						{{ Form::label('content', 'ID Youtube : ', ['class' => 'label']) }}
						<p class="control">
							{{ Form::textarea('content', $post->post_content, ['class' => 'Textarea']) }}
						</p>

						{{ Form::label('attachment', 'Image : ', ['class' => 'label']) }}
						<p class="control">
							{{ Form::file('attachment', ['class' => 'input']) }}
						</p>
					</div>
					<div class="column is-3">
						{{ Form::label(null, 'image attachée : ', ['class' => 'label']) }}
						<a class="modal-button" data-target="#article-image">
							<img src="{{ asset('uploads/' . $post->post_attachment) }}" class="edit-article-img" alt="" />
						</a>


					</div>
				</div>

				<p class="control">
				  <label class="checkbox">
				    {{ Form::checkbox('statut', 1, $post->post_status , ['class' => 'checkbox']) }}
				    publier ?
				  </label>
				</p>
				<button class="button is-primary">Enregistrer</button>

			{{ Form::close() }}


			<div class="modal" id="article-image">
			  <div class="modal-background"></div>
			  <div class="modal-content">
			    <p class="image is-4by3">
			      <img src=" {{ asset('uploads/' . $post->post_attachment) }} ">
			    </p>
			  </div>
			  <button class="modal-close"></button>
			</div>

			<script type="text/javascript">
				$('.modal-button').click(function() {
					var target = $(this).data('target');
					$('html').addClass('has-modal-open');
					$(target).addClass('is-active');
				});

				$('.modal-background, .modal-close').click(function() {
					$('html').removeClass('has-modal-open');
					$(this).parent().removeClass('is-active');
				});
			</script>

@endsection
