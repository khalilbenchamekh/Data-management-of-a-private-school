@extends('admin.master-admin')

@section('title')

	modifier un article

@endsection

@section('content')

			<h3 class="title is-3">Ajouter un Utilisateur</h3>

			{{ Form::open(['url' => route('admin.users.store'), 'files' => true, 'class' => 'admin-options']) }}

				{{ Form::label('user-name', 'nome d\'utilisateur : ', ['class' => 'label']) }}
				<p class="control">
					{{ Form::text('user-name', null , ['class' => 'input', 'required' => 'true']) }}
				</p>

				{{ Form::label('user-email', 'email : ', ['class' => 'label']) }}
				<p class="control">
					{{ Form::email('user-email', null , ['class' => 'input', 'required' => 'true']) }}
				</p>

				{{ Form::label('user-password', 'mot de pass : ', ['class' => 'label']) }}
				<p class="control">
					{{ Form::password('user-password', ['class' => 'input', 'required' => 'true']) }}
				</p>

				{{ Form::label('role', 'role : ', ['class' => 'label']) }}
				<p class="control">
					<span class="select">
						{{ Form::select('role', $roless, 1) }}
					</span>
				</p>

				{{ Form::label('attachment', 'photo de profile : ', ['class' => 'label']) }}
				<p class="control">
					{{ Form::file('attachment', ['class' => 'input']) }}
				</p>

				<button class="button is-primary">Enregistrer</button>

			{{ Form::close() }}


@endsection
