@extends('admin.master-admin')

@section('title')

	modifier un evenement

@endsection

@section('content')

			<h3 class="title is-3">Ajouter un Evenement</h3>

			{{ Form::open(['url' => route('admin.events.store')]) }}

				{{ Form::label('title', 'titre de l\'evenement : ', ['class' => 'label', 'files' => true]) }}
				<p class="control">
					{{ Form::text('title', null , ['class' => 'input', 'required' => 'true']) }}
				</p>

				{{ Form::label('date', 'date de l\'evenement : ', ['class' => 'label']) }}
				<p class="control">
					{{ Form::Date('date', null , ['class' => 'input input-column column is-3', 'required' => 'true']) }}
				</p>

				{{ Form::label('content', 'description : ', ['class' => 'label']) }}
				<p class="control">
					{{ Form::textarea('content', null , ['class' => 'mce-textarea textarea', 'required' => 'true']) }}
				</p>

				{{ Form::label('attachment', 'image : ', ['class' => 'label']) }}
				<p class="control">
					{{ Form::file('attachment', ['class' => 'input input-column column is-3', 'required' => 'true']) }}
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
