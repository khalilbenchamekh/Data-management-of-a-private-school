@extends('layouts.app')

@section('hero-footer')
    <div class="hero-footer">
        <nav class="tabs">
            <div class="container-fluid">
                <ul class="navbar">
                    <li class="{{ Request::is('/') ? 'is-active' : '' }}">
                        <a href="{{ url('/') }}">الرئيسية</a>
                    </li>
                    @forelse($newsMenu as $item)
                        <li class="{{ Request::is( $cat . '/' . $item->UmdTerm->slug ) ? 'is-active' : '' }}"><a href="{{ url($cat . '/' . $item->UmdTerm->slug) }}">{{ $item->UmdTerm->name }}</a></li>
                    @empty
                    @endforelse
                    <li>
                        {{ Form::open(['url' => url('search')]) }}
                            <p class="control">
                                {{ Form::text('search', null , ['class' => 'input', 'placeholder' => 'ابحت']) }}
                            </p>
                        {{ Form::close() }}
                    </li>
                </ul>
            </div>
        </nav>
    </div>

@endsection

@section('content')
<br/>
               <div class="container">
               <div class="bar columns is-multiline is-mobile">
               <h2 class="title column is-half-desktop" style=" margin: 0px; padding: 0px;">أصداء الحزب في الصحافة</h2>
                </div>
                    <div class="columns is-mobile is-multiline">
                         @if(count($press) > 0)
                           @foreach($press as $reporter)
                            <div class="column is-12-mobile is-half-tablet is-one-quarter-desktop">
                              <a href="{{ url('article/' . $reporter->ID) }}">
                                    <div class="card">
                                      <div class="card-image">
                                        <figure class="image is-4by3">
                                          <img src="{{ asset('uploads/'. $reporter->post_attachment) }}" alt="">
                                        </figure>
                                      </div>
                                      <div class="card-content">
                                        <div class="media-right">
                                          <div class="media-content">
                                            <p class="title is-5">{{  $reporter->post_title }}</p>
                                          </div>
                                        </div>

                                        <div class="content">{{ $reporter->post_excerpt }}
                                          <br>
                                          <small>التاريخ : {{ date('d/m/Y', strtotime($reporter->post_date)) }}</small>
                                        </div>
                                      </div>
                                    </div>
                                </a>
                            </div>
                         @endforeach
                      @endif
                    </div>
                </div>
 
                
@endsection

@section('script')
    <script type="text/javascript">
        var vwidth = $('#main-video').width();
        $('#main-video').height(vwidth * 56.25 / 100);
    </script>
@endsection