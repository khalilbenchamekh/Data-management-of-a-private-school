@extends('admin.master-admin')

@section('title')

	modifier un categorie

@endsection

@section('content')

			<h3 class="title is-3">Ajouter une Categorie</h3>

			{{ Form::open(['url' => route('admin.categories.store')]) }}

				{{ Form::label('title', 'nom de la categorie : ', ['class' => 'label']) }}
				<p class="control">
					{{ Form::text('title', null , ['class' => 'input', 'required' => 'true']) }}
				</p>

				{{ Form::label('parent', 'parent : ', ['class' => 'label']) }}

				<p class="control">
					<span class="select">
						{{ Form::select('parent', $cats, null) }}
					</span>
				</p>

				<button class="button is-primary">Enregistrer</button>

			{{ Form::close() }}


@endsection
