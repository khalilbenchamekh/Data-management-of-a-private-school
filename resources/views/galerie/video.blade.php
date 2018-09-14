@extends('layouts.app')

@section('content')

  <div class="container tv">
    <h3 class="title is-3">{{$video->post_title}}</h3>
    <center>
    <div class="columns is-multiline is-mobile">
      <div class="column is-12-mobile is-full">
        <div id="main-video-cntainer">
          <iframe title="YouTube video player" class="youtube-player" type="text/html" 
            width="640" height="390" src="http://www.youtube.com/embed/{{$video->post_content}}"
            frameborder="0" allowFullScreen></iframe>
        </div>
      </div>
    </div>
    </center>
  </div>

@endsection

@section('script')
@endsection
