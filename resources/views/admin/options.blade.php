@extends('admin.master-admin')

@section('title')

	modifier les options generales

@endsection

@section('content')

	<h3 class="title is-3">Options Generales</h3>


	{{ Form::open(['url' => url('admin/options'), 'class' => 'admin-options']) }}

		<div class="control is-horizontal">
			<div class="control-label">
				{{ Form::label('fb-page', 'page facebook : ', ['class' => 'label']) }}
			</div>
			<div class="control">
				{{ Form::text('fb-page', $options[0]->option_value , ['class' => 'input']) }}
			</div>
		</div>

		<div class="control is-horizontal">
			<div class="control-label">
				{{ Form::label('tw-page', 'page twitter : ', ['class' => 'label']) }}
			</div>
			<div class="control">
				{{ Form::text('tw-page', $options[1]->option_value , ['class' => 'input']) }}
			</div>
		</div>
		<div class="control is-horizontal">
			<div class="control-label">
				{{ Form::label('st-page', 'page instagram : ', ['class' => 'label']) }}
			</div>
			<div class="control">
				{{ Form::text('st-page', $options[14]->option_value , ['class' => 'input']) }}
			</div>
		</div>

		<div class="control is-horizontal">
			<div class="control-label">
				{{ Form::label('yt_api_key', 'id chaine youtube : ', ['class' => 'label']) }}
			</div>
			<div class="control">
				{{ Form::text('yt_api_key', $options[2]->option_value , ['class' => 'input']) }}
			</div>
		</div>

		<div class="control is-horizontal">
			<div class="control-label">
				{{ Form::label('i_link_1', 'lien interessant 1 : ', ['class' => 'label']) }}
			</div>
			<div class="control is-grouped">
				{{ Form::text('i_link_1', $options[3]->option_value , ['class' => 'input']) }}
				{{ Form::text('i_link_1_name', $options[9]->option_value , ['class' => 'input']) }}
			</div>
		</div>

		<div class="control is-horizontal">
			<div class="control-label">
				{{ Form::label('i_link_2', 'lien interessant 2 : ', ['class' => 'label']) }}
			</div>
			<div class="control is-grouped">
				{{ Form::text('i_link_2', $options[4]->option_value , ['class' => 'input']) }}
				{{ Form::text('i_link_2_name', $options[10]->option_value , ['class' => 'input']) }}
			</div>
		</div>

		<div class="control is-horizontal">
			<div class="control-label">
				{{ Form::label('i_link_3', 'lien interessant 3 : ', ['class' => 'label']) }}
			</div>
			<div class="control is-grouped">
				{{ Form::text('i_link_3', $options[5]->option_value , ['class' => 'input']) }}
				{{ Form::text('i_link_3_name', $options[11]->option_value , ['class' => 'input']) }}
			</div>
		</div>

		<div class="control is-horizontal">
			<div class="control-label">
				{{ Form::label('i_link_4', 'lien interessant 4 : ', ['class' => 'label']) }}
			</div>
			<div class="control is-grouped">
				{{ Form::text('i_link_4', $options[6]->option_value , ['class' => 'input']) }}
				{{ Form::text('i_link_4_name', $options[12]->option_value , ['class' => 'input']) }}
			</div>
		</div>

		<div class="control is-horizontal">
			<div class="control-label">
				{{ Form::label('i_link_5', 'lien interessant 5 : ', ['class' => 'label']) }}
			</div>
			<div class="control is-grouped">
				{{ Form::text('i_link_5', $options[7]->option_value , ['class' => 'input']) }}
				{{ Form::text('i_link_5_name', $options[13]->option_value , ['class' => 'input']) }}
			</div>
		</div>

		<div class="control is-horizontal">
			<div class="control-label">
				{{ Form::label('marquee', 'marquee : ', ['class' => 'label']) }}
			</div>
			<div class="control">
				{{ Form::textarea('marquee', $options[8]->option_value , ['class' => 'textarea', 'style' => 'direction : rtl!important;']) }}
			</div>
		</div>

		<button type="submit" class="button is-primary pull-right" name="button">enregistrer</button>



	{{ Form::close() }}

@endsection
