@extends('admin.master-admin')

@section('title')

	modifier une image

@endsection

@section('content')

			<h3 class="title is-3">Ajouter une video</h3>

			{{ Form::open(['url' => route('admin.videos.store') , 'files' => true] ) }}

				{{ Form::label('title', 'titre de la video : ', ['class' => 'label', 'files' => true]) }}
				<p class="control">
					{{ Form::text('title', null , ['class' => 'input', 'required' => 'true']) }}
				</p>

				{{ Form::label('content', 'ID Youtube : ', ['class' => 'label']) }}
				<p class="control">
					{{ Form::textarea('content', null , ['class' => 'textarea', 'required' => 'true']) }}
				</p>

				{{ Form::label('attachment', 'Image : ', ['class' => 'label']) }}
				<p class="control">
					{{ Form::file('attachment', ['class' => 'input input-column column is-3']) }}
				</p>

				<p class="control">
				  <label class="checkbox">
				    {{ Form::checkbox('statut', 1, 0 , ['class' => 'checkbox']) }}
				    publier ?
				  </label>
				</p>

				<button class="button is-primary">Enregistrer</button>

			{{ Form::close() }}


@endsection
