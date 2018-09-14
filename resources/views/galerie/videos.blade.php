@extends('layouts.app')

@section('content')
<br/>
    <div class="container" align="center">
    <h2 class="title is-3">مرئيات</h2>
        <div class="column is-12-mobile is-half-desktop">
            <div class="columns is-mobile is-multiline">
                @if(count($videos) > 0)
                    @for($i=0; $i < count($videos) ; $i++)
                        <div class="column is-12-mobile is-half-tablet is-one-quarter-desktop">
                            <a href="">
                                <div class="card">
                                    <div class="card-image">
                                     <figure class="image is-4by3">
                                        <a href="{{ url('/videos/'.$videos[$i]->ID) }}">
                                         <img class="img-thumbnail" src="{{ asset('uploads/' . $videos[$i]->post_attachment) }}" />
                                        </a>
                                    </figure>
                                </div>
                            </div>
                            </a>
                        </div>
                    @endfor
                    @endif
                </div>
            </div>
        </div>
@endsection

@section('script')
	<script type="text/javascript">
		var vwidth = $('#main-video').width();
		$('#main-video').height(vwidth * 56.25 / 100);
	</script>
@endsection
