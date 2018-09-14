@extends('layouts.app')

@section('content')

	<div class="container tv">
		<h3 class="title is-3">{{ $name or $json["items"][1]["snippet"]["title"] }}</h3>
		<div class="columns is-multiline is-mobile">
			<div class="column is-12-mobile is-full">
				<div id="main-video-cntainer">
					<iframe src="https://www.youtube.com/embed/{{ $id or $json["items"][1]["id"]["videoId"] }}" frameborder="0" allowfullscreen id="main-video"></iframe>
				</div>
			</div>
			<div class="columns is-multiline is-mobile" id="video-list">
				@foreach($json["items"] as $item)
                    @if($item["id"]["kind"] != "youtube#channel")
                        <div class="column is-one-third-desktop">
    						<article class="media">
    							<figure class="media-right">
    								<p class="image is-64x64">
    									<img src="{{ $item["snippet"]["thumbnails"]["default"]["url"] }}">
    								</p>
    							</figure>
    							<div class="media-content">
    								<div class="content">
    									<p>
    										<a href="{{ url('tv/'. $item["snippet"]["title"] . '/' . $item["id"]["videoId"]) }}"><strong>{{ $item["snippet"]["title"] }}</strong></a>
    									</p>
    								</div>
    							</div>
    						</article>
    					</div>
                    @endif
				@endforeach
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
