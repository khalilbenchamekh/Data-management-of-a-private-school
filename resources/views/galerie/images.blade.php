@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href=" {{ URL::asset('css/lightbox.css') }} ">
	<script type="text/javascript" src=" {{ URL::asset('javascript/galerie/jssor.slider.min.js') }} "></script>
    <link href="{{ URL::asset('css/galerie/bootstrap.min.css') }}" rel="stylesheet">
    <!-- use jssor.slider.debug.js instead for debug -->
    

    
    <br>
   
    <div class="container" align=center>
    <h2 class="page-title">رواق الصور</h2>
       @for($i = 0 ; $i < count($images) ; $i++)
           <a class="example-image-link" href="{{ URL::asset('uploads/'.$images[$i]->post_attachment)}}" data-lightbox="example-set" data-title="{{ $images[$i]->post_content }}"><img class="img-thumbnail" src="{{ URL::asset('uploads/'.$images[$i]->post_attachment)}}" width="15%" height="15%" alt=""/></a>
        @endfor 
    </div>

  
    
    <script src=" {{ URL::asset('javascript/galerie/jquery.js') }}"></script>
    <script src=" {{ URL::asset('javascript/galerie/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('javascript/lightbox-plus-jquery.min.js') }} "></script>


@endsection

@section('script')
	<script type="text/javascript">
		var vwidth = $('#main-video').width();
		$('#main-video').height(vwidth * 56.25 / 100);
	</script>
@endsection
