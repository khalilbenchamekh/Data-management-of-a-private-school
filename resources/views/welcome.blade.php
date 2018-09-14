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
						<li class="{{ Request::is( $cat . '/' . $item->UmdTerm->slug ) ? 'is-active' : '' }}">
							<a href="{{ url($cat . '/' . $item->UmdTerm->slug) }}">{{ $item->UmdTerm->name }}</a>
						</li>
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
			<section class="section" id="scroll-page" style="padding-top:20px;padding-bottom:0px;">

			 @if(count($notification) > 0)
				@for($i=0; $i < count($notification) ; $i++)
				<div class="container" style="padding-top:0px"> 
					<div class="columns is-mobile">
					<div class="column is-14" style="font-size: 19px;">
						<div class="column is-4"><img src="{{ asset('uploads/' . $notification[$i]->post_attachment) }}" alt="Logo" width=16% height=16%>
								
								
							<strong>{{ $notification[$i]->post_title }}</strong><br/>
							<a href="{{ url('/notification/'.$notification[$i]->post_title) }}">
									{{ $notification[$i]->post_content }}</a>
									
									</div>	
						</div>
					</div>
				</div>
				@endfor
	          @endif
	        


				<div class="container" style="padding-top:0px">
					<div class="columns is-mobile is-multiline">
						<marquee class="column is-12" loop="infinite" dir="ltr" direction="right">{{ $marquee->option_value }}</marquee>
					</div>
				</div>
				
				<div class="container">
					<div class="columns is-mobile is-multiline">
						<div class="column is-12-mobile is-9">
							<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
							  <!-- Indicators -->
							  <ol class="carousel-indicators">
								  @for($i=0; $i < min(5, count($slider)); $i++)
									  <li data-target="#carousel-example-generic" data-slide-to="{{ $i }}" class="{{ $i == 0 ? "active" : "" }}"></li>
								  @endfor
							  </ol>

							  <!-- Wrapper for slides -->
							  <div class="carousel-inner" role="listbox">
								    @for($i=0; $i < min(5, count($slider)); $i++)
									    <div class="item {{ $i == 0 ? "active" : "" }}">
		  							      <img src="{{ asset('uploads/' . $slider[$i]->post_attachment) }}" alt="...">
		  							      <div class="carousel-caption">
		  							        <a href="{{ url('/' . $slider[$i]['UmdTermRelationship']['UmdTermTaxonomy']['UmdTermParent']['slug'] . '/' . $slider[$i]['UmdTermRelationship']['UmdTermTaxonomy']['UmdTerm']['slug'] . '/' . $slider[$i]['post_slug'])  }}">
												<h3 class="title is-3">{{ $slider[$i]->post_title }}</h3>
											</a>
		  							      </div>
		  							    </div>
								    @endfor
							   </div>

							  <!-- Controls -->
							  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
							    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
							    <span class="sr-only">Previous</span>
							  </a>
							  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
							    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
							    <span class="sr-only">Next</span>
							  </a>
							</div>
						</div>
						<style type="text/css">
					       .bf{
						    height: 300px;
						    padding: 0px;
				           	}
				           </style> 
						<div class="column is-12-mobile is-3">
							<nav class=" bf panel">
							  <p class="panel-heading">
							    اخر المقالات
							  </p>
							  @for($i=0; $i < min(4, count($slider)); $i++)
								  <a class="panel-block" href="{{ url('/' . $slider[$i]['UmdTermRelationship']['UmdTermTaxonomy']['UmdTermParent']['slug'] . '/' . $slider[$i]['UmdTermRelationship']['UmdTermTaxonomy']['UmdTerm']['slug'] . '/' . $slider[$i]['post_slug'])  }}">
								    {{ $slider[$i]->post_title }}
								  </a>
							  @endfor

							</nav>
						</div>
					</div>
				</div>
				<div class="container">
					<div class="columns is-multiline is-mobile" style="margin-top:0px;padding-top:0px;color:white;">
						<div class="column is-12-mobile is-half-desktop" style="margin-top: 0px;width:74%;">
							<div class="tabs is-centered is-boxed">
								<ul>
									@for($i=0; $i < count($groups); $i++)
										<li class="{{ $i == 0 ? "is-active" : "" }}" style="background:#064577;border-radius: 5px;">
											<a class="group-link" style="" data-target="#group-content-{{ $i }}" id="{{ $i }}">
												{{ $groups[$i]->UmdTerm->name }}
											</a>
										</li>
									@endfor

								</ul>
							</div>
							
							<div id="groups-content">
								@for($i=0; $i < min(4, count($groups)); $i++)
									<div id="group-content-{{$i}}" class="{{ $i != 0 ? 'group-content-hidden' : '' }}">
										@for($j = 0; $j < min(4, count($groups[$i]->UmdPosts)); $j++)
											<a href="{{url('article/'.$groups[$i]->UmdPosts[$j]->ID)}}">
												<article class="media">
													<figure class="media-right">
													    <p class="image is-64x64">
													    	<img src="{{ asset('uploads/' . $groups[$i]->UmdPosts[$j]->post_attachment) }}">
													    </p>
													</figure>
													<div class="media-content">
													    <div class="content">
													      	<p>
														        <strong>{{ $groups[$i]->UmdPosts[$j]->post_title }}</strong>
													     	</p>
													    </div>
													</div>
												</article>
											</a>
										@endfor
									</div>
								@endfor
							</div>
						</div>
 <style type="text/css">
					.bd{
						height: 40px;
						color: #FFF;
						background-color: #064577;
						padding: 6px!important;
						border-radius: 5px;
					}

				.bd h3{
					margin: 0;
					color: #FFF !important;
				}

				.bd h6{
					margin: 0;
				}

				.bd h6 a{
					color: #FFF !important;
				}
				</style>
							<div class="column is-12-mobile is-half-desktop" style="width: 223px;margin-right: 2%;">
							  	<div class="bd columns is-multiline is-mobile">
					            <h3 class="title column is-half-desktop" style="color: #FFF; margin: 0px; padding: 0px;">مرئيات</h3>
					                <h6 style="text-align: left;margin: 0;padding: 0;padding-top: 5px;" class="column is-half-desktop"><a href="{{ url('/videos') }}">(المزيد...)</a></h6>
                               </div>
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

							<!--
							<div class="column is-12-mobile is-half-desktop">
								<h3 class="title is-3" style="text-align: center;">الأنشطة والفعاليات</h3>
								<div class="calendar">

								</div>
							</div>-->

						</div>
					</div>
				</div>
			
			    <style type="text/css">
					.bar{
						height: 50px;
						color: #FFF;
						background-color: #064577;
						padding: 10px!important;
						border-radius: 5px;
					}

				.bar h2{
					margin: 0;
					color: #FFF !important;
				}

				.bar h6{
					margin: 0;
				}

				.bar h6 a{
					color: #FFF !important;
				}
				</style>
               <div class="container">
               <div class="bar columns is-multiline is-mobile" style="height:40px;">
               <h2 class="title column is-half-desktop" style=" margin: 0px;height: 28px; padding: 0px;">اخبار و مستجدات </h2>
                <h6 style="text-align: left;margin: 0;padding: 0;padding-top: 5px;" class="column is-half-desktop"><a href="http://www.pumd.ma/public/%D8%A7%D9%84%D9%81%D8%B6%D8%A7%D8%A1-%D8%A7%D9%84%D8%A7%D8%AE%D8%A8%D8%A7%D8%B1%D9%8A/%D8%A3%D8%AE%D8%A8%D8%A7%D8%B1-%D8%A7%D9%84%D8%AD%D8%B2%D8%A8">(المزيد...)</a></h6>
                </div>
					<div class="columns is-mobile is-multiline">
						@for($i=0; $i < 4; $i++)
							<div class="column is-12-mobile is-half-tablet is-one-quarter-desktop">
								<a href="{{ url('/' . $slider[$i]['UmdTermRelationship']['UmdTermTaxonomy']['UmdTermParent']['slug'] . '/' . $slider[$i]['UmdTermRelationship']['UmdTermTaxonomy']['UmdTerm']['slug'] . '/' . $slider[$i]['post_slug'])  }}">
									<div class="card">
									  <div class="card-image">
									    <figure class="image is-4by3">
									      <img src="{{ asset('uploads/'. $slider[$i]->post_attachment) }}" alt="">
									    </figure>
									  </div>
									  <style type="text/css">
									  	.bb{
									  		height: 250px;
									  	}
									  </style>
									  <div class="bb card-content">
									    <div class="media-right">
									      <div class="media-content">
									        <p class="title is-5" style="color:black;">{{ $slider[$i]->post_title }}</p>
									      </div>
									    </div>                                    
									    <div class="content">{{ $slider[$i]->post_excerpt }}
									      <br>
									      <small>التاريخ : {{ date('d/m/Y', strtotime($slider[$i]->post_date)) }}</small>
									    </div>
									  </div>
									</div>
								</a>
							</div>
						@endfor
					</div>
				</div>
				
				<div class="container">
					
						<div class="column is-12-mobile is-half-desktop" style="width:100%;">
							<div class="bd columns is-multiline is-mobile" style="height: 40px;color: #FFF;background-color: #064577;padding: 6px!important;border-radius: 5px;">
								<h2 class="title column is-half-desktop" style="color:white;padding-left:0px;padding-top: 0px;margin-top: 0px;">مقالات و آراء</h2>
					            <h6 style="text-align: left;margin: 0;margin-right: 40%;padding-left: 0px;width: 10%; padding-top: 0px;"><a href="{{ url('/videos') }}">(المزيد...)</a></h6>
                            </div>
							@foreach($reporters as $reporter)
								<a href="{{ url('article/' . $reporter->id) }}">
									<article class="media">
										<figure class="media-right">
										    <p class="image is-96x96">
										    	<img src="{{ asset('uploads/' . $reporter->post_attachment) }}">
										    </p>
										</figure>
										<div class="media-content">
										    <div class="content">
										      	<p>
											        <strong>{{ $reporter->User->ar_name }}</strong>
											        <br>
											        {{ $reporter->post_excerpt }}
										     	</p>
										    </div>
										</div>
									</article>
								</a>
							@endforeach
						</div>

						<div class="column is-12-mobile is-half-desktop" style="width:100%;margin-top:30px;">
							<div class="bd columns is-multiline is-mobile">
							    <h3 class="title column is-half-desktop" style="color: #FFF; margin: 0px; padding: 0px;">الصحافة</h3>
							        <h6 style="text-align: left;margin: 0;padding: 0;padding-top: 5px;" class="column is-half-desktop"><a href="{{ url('/videos') }}">(المزيد...)</a></h6>
							</div>

							@foreach($press as $reporter)
								<a href="{{ url('article/' . $reporter->ID) }}">
									<article class="media">
										<figure class="media-right">
										    <p class="image is-96x96">
										    	<img src="{{  asset('uploads/' . $reporter->post_attachment)  }}">
										    </p>
										</figure>
										<div class="media-content">
										    <div class="content">
										      	<p>
											        <strong>{{ $reporter->post_title }}</strong>
											        <br>
											        {{ $reporter->post_excerpt }}
										     	</p>
										    </div>
										</div>
									</article>
								</a>
							@endforeach
						</div>
					
				</div>
				<div id="newsletter" class="container-fluid">
					<div class="columns is-mobile is-multiline">
						<div class="column is-12-mobile is-half-desktop">
							<h2 class="title is-2">الرسائل الإخبارية</h2>
						</div>
						<div class="column is-12-mobile is-half-desktop">
							<form action="//umd.us13.list-manage.com/subscribe/post?u=23aae81d12c11354b5520570d&amp;id=1a4d696490" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
								<p class="control is-grouped mc-field-group">
									<input type="email" dir="ltr" value="" name="EMAIL" class="input email" id="mce-EMAIL" placeholder="البريد الإلكتروني" required>
								    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
								    <input type="text" name="b_23aae81d12c11354b5520570d_1a4d696490" tabindex="-1" value="" class="hidden"><input type="submit" value="تسجيل" name="subscribe" id="mc-embedded-subscribe" class="button is-info">
								</p>
								<div id="mce-responses" class="clear">
									<div class="response" id="mce-error-response" style="display:none"></div>
									<div class="response" id="mce-success-response" style="display:none"></div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</section>
@endsection

@section('script')


	<link rel="stylesheet" href="{{ asset('javascript/calendar/jquery.datepick.css') }}" media="screen" title="no title" charset="utf-8">
	<script type="text/javascript" src="{{ asset('javascript/calendar/jquery.plugin.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('javascript/calendar/jquery.datepick.js') }}"></script>
	<script type="text/javascript" src="{{ asset('javascript/calendar/jquery.datepick-ar-EG.js') }}"></script>
	<script type="text/javascript">
		$(".calendar").datepick({multiSelect: 30});
		var dates = {!! $dates !!};
		$(".calendar").datepick('setDate', {!! $dates !!});
	</script>
	<script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email'; /*
	 * Translated default messages for the jQuery validation plugin into arabic.
	 * Locale: AR
	 */
	$.extend($.validator.messages, {
			required: "هذا الحقل إلزامي",
			remote: "يرجى تصحيح هذا الحقل للمتابعة",
			email: "رجاء إدخال عنوان بريد إلكتروني صحيح",
			url: "رجاء إدخال عنوان موقع إلكتروني صحيح",
			date: "رجاء إدخال تاريخ صحيح",
			dateISO: "رجاء إدخال تاريخ صحيح (ISO)",
			number: "رجاء إدخال عدد بطريقة صحيحة",
			digits: "رجاء إدخال أرقام فقط",
			creditcard: "رجاء إدخال رقم بطاقة ائتمان صحيح",
			equalTo: "رجاء إدخال نفس القيمة",
			accept: "رجاء إدخال ملف بامتداد موافق عليه",
			maxlength: $.validator.format("الحد الأقصى لعدد الحروف هو {0}"),
			minlength: $.validator.format("الحد الأدنى لعدد الحروف هو {0}"),
			rangelength: $.validator.format("عدد الحروف يجب أن يكون بين {0} و {1}"),
			range: $.validator.format("رجاء إدخال عدد قيمته بين {0} و {1}"),
			max: $.validator.format("رجاء إدخال عدد أقل من أو يساوي (0}"),
			min: $.validator.format("رجاء إدخال عدد أكبر من أو يساوي (0}")
	});}(jQuery));var $mcj = jQuery.noConflict(true);</script>
	<!--End mc_embed_signup-->
@endsection
