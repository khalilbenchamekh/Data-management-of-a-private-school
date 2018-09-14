@extends('admin.master-admin')

@section('title')

	modifier un article

@endsection

@section('content')

			<h3 class="title is-3">Modifier un Article</h3>

			{{ Form::open(['method' => 'put', 'url' => route('admin.categories.update', $cat->UmdTerm)]) }}

				{{ Form::label('title', 'nom de la categorie : ', ['class' => 'label']) }}
				<p class="control">
					{{ Form::text('title', $cat->UmdTerm->name , ['class' => 'input']) }}
				</p>

				{{ Form::label('parent', 'parent : ', ['class' => 'label']) }}
				<p class="control">
					<span class="select">
						{{ Form::select('parent', $cats, $cat->parent) }}
					</span>
				</p>

				<button class="button is-primary">Enregistrer</button>

			{{ Form::close() }}

@endsection
