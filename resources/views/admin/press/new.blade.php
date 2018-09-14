@extends('admin.master-admin')

@section('title')

	ajouter un article de presse

@endsection

@section('content')

			<h3 class="title is-3">Ajouter un Article de Presse</h3>

			{{ Form::open(['url' => route('admin.press.store'), 'files' => true]) }}

				{{ Form::label('title', 'titre de l\'article : ', ['class' => 'label']) }}
				<p class="control">
					{{ Form::text('title', null , ['class' => 'input']) }}
				</p>

				{{ Form::label('content', 'contenu de l\'article : ', ['class' => 'label']) }}
				<p class="control">
					{{ Form::textarea('content', null , ['class' => 'mce-textarea textarea']) }}
				</p>

				{{ Form::label('attachment', 'image de l\'article : ', ['class' => 'label']) }}
				<p class="control">
					{{ Form::file('attachment', ['class' => 'input']) }}
				</p>

				{{ Form::label('category', 'categorie : ', ['class' => 'label']) }}
				<p class="control">
					<span class="select">
						{{ Form::select('category', $cats, null) }}
					</span>
				</p>

				<p class="control">
				  <label class="checkbox">
				    {{ Form::checkbox('statut', 1, 1 , ['class' => 'checkbox']) }}
				    publier ?
				  </label>
				</p>

				<button class="button is-primary">Enregistrer</button>

			{{ Form::close() }}


@endsection
