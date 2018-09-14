@extends('layouts.app')


@section('content')
    
    <br><br><br>
            @if(count($notification) > 0)
                @for($i=0; $i < count($notification) ; $i++)
                <div class="container">
                    <div class="columns is-mobile is-multiline">
                        <img src="{{ asset('uploads/' . $notification[$i]->post_attachment) }}" alt="Logo" width=5% height=5%>
                        {{ $notification[$i]->post_title }}<br /> 
                        <a href="{{ url('/notification') }}">{{ $notification[$i]->post_content }}</a>
                    </div>
                </div>
                @endfor
            @endif

@endsection

@section('script')
	<script type="text/javascript">
		var vwidth = $('#main-video').width();
		$('#main-video').height(vwidth * 56.25 / 100);
	</script>
@endsection
