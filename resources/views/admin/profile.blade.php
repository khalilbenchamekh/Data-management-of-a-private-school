@extends('admin.master-admin')

@section('title')

	modifier les options generales

@endsection

@section('content')

	<h3 class="title is-3">Profile</h3>

	<div class="columns is-multiline">
		<div class="column is-three-thirds">
			{{ Form::open(['url' => url('admin/profile'), 'class' => 'admin-options']) }}

				<div class="control is-horizontal">
					<div class="control-label">
						{{ Form::label('username', ' nom d\'utilisateur : ', ['class' => 'label']) }}
					</div>
					<div class="control">
						{{ Form::text('username', $profile->name , ['class' => 'input', 'disabled' => 'disabled']) }}
					</div>
				</div>

				<div class="control is-horizontal">
					<div class="control-label">
						{{ Form::label('ar-name', ' nom en arabe : ', ['class' => 'label']) }}
					</div>
					<div class="control">
						{{ Form::text('ar-name', $profile->ar_name , ['class' => 'input']) }}
					</div>
				</div>

				<div class="control is-horizontal">
					<div class="control-label">
						{{ Form::label('email', ' adresse email : ', ['class' => 'label']) }}
					</div>
					<div class="control">
						{{ Form::email('email', $profile->email , ['class' => 'input', 'disabled' => 'disabled']) }}
					</div>
				</div>
				
				<button type="submit" class="button is-primary pull-right" name="button">enregistrer</button>



			{{ Form::close() }}
		</div>
		<div class="column is-one-third">
			<p class="image">
				<img src="{{ asset('uploads/'. $profile->user_pic) }}" alt="" />
			</p>
		</div>
	</div>

@endsection
