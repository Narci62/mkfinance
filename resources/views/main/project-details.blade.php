<x-main-layout>
	<x-progress-bar-option/>
	<section class="page-header">
		<div class="page-header-bg" style="background-image: url(assets/images/blog/blog-img-lg.jpg)">
		</div>
		<div class="page-header-shape-1 float-bob-x">
			<img src="assets/images/shapes/page-header-shape-1.png" alt="">
		</div>
		<div class="page-header-shape-2 float-bob-y">
			<img src="assets/images/shapes/page-header-shape-2.png" alt="">
		</div>
		<div class="page-header-shape-3 float-bob-x">
			<img src="assets/images/shapes/page-header-shape-3.png" alt="">
		</div>
		<div class="container">
			<div class="page-header__inner">
				<ul class="thm-breadcrumb list-unstyled">
					<li><a href="/">Accueil</a></li>
					<li><span>/</span></li>
					<li>Projet - {{$sector}}</li>
				</ul>
				<h2><u>{{$project->company->name}} :</u> {{$project->titled}}</h2>
			</div>
		</div>
	</section>
	<!--Page Header End-->

	<!--Project Details Top Start-->
	<section class="project-details-top">
		<div class="container">
			<div class="row">
				<div class="col-xl-7 col-lg-6">
					<div class="project-details-top__left">
						<div class="project-details-top__img">
							<img src="{{Storage::url($project->featured_image)}}" alt="">
							<div class="project-details-top__icon">
								<i class="far fa-heart"></i>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-5 col-lg-6">
					<div class="project-details-top__right">
						<div class="project-details-top__tag-address">
							<div class="project-details-top__tag">
								<p>{{$sector}}</p>
							</div>
							<div class="project-details-top__address">
								<p><i class="fas fa-map-marker"></i>{{$project->company->company_adresse}}</p>
							</div>
						</div>
						<h3 class="project-details-top__title">{{$project->titled}}</h3>
						<ul class="list-unstyled project-details-top__list">
							<li>
								<div class="project-details-top__list-content">
									<h6>{{$project->totalFundedNeeded}} F</h6>
									<p>Fonds levés</p>
								</div>
							</li>
							<li>
								<div class="project-details-top__list-content">
									<h3>  {{ $project->investment->count() }} </h3>
									<p>Investisseurs</p>
								</div>
							</li>
							<li>
								<div class="project-details-top__list-content">
									<h3>{{$avis->count()}}</h3>
									<p>Avis</p>
								</div>
							</li>
						</ul>
						<div class="progress-levels">
							<!--Skill Box-->
							
							<div class="progress-box">
								<div class="inner count-box">
									<div class="text">Fonds à </div>
									<div class="bar">
										<div class="bar-innner">
											<div class="skill-percent">
												<span class="count-text" data-speed="3000" data-stop="{{getprogress($project)}}">{{getprogress($project)}}</span>
												<span class="percent">%</span>
											</div>
											<div class="bar-fill" data-percent="{{getprogress($project)}}"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<p class="project-details-top__goal"><span>Objectif:</span>{{$project->totalFundedNeeded}} F</p>
						<p class="project-details-top__text">{{$project->company->overview_description}}</p>
						<div class="project-details-top__person">
							<div class="project-details-top__person-img">
								<img src="{{Storage::url($project->company->main_logo)}}" alt="">
							</div>
							<div class="project-details-top__person-content">
								<h5>{{$project->company->name}}</h5>
								<p>{{$sector}}</p>
							</div>
						</div>
						<ul class="list-unstyled project-details-top__money">
							<li>{{$project->InvestmentAmountfix}} F</li>
						</ul>
						<div class="project-details-top__quantity-btn-social">
							<div class="project-details-top__btn-box">
								<a href="{{ route('in.start.invest',['id'=> $project->imat ]) }}" class="thm-btn project-details-top__btn">INVESTIR</a>
							</div>
							<div class="project-details-top__social">
								<a href="#"><i class="fab fa-twitter"></i></a>
								<a href="#"><i class="fab fa-facebook"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--Project Details Top End-->

	<!--Project Details Bottom Start-->
	<section class="project-details-bottom">
		<div class="container">
			<div class="row">
				<div class="col-xl-8 col-lg-7">
					<div class="project-details__tab-box tabs-box">
						<ul class="tab-buttons clearfix list-unstyled clearfix">
							<li data-tab="#project" class="tab-btn active-btn"><span>{{ __('Projet') }}</span></li>
							<li data-tab="#documents" class="tab-btn"><span>{{ __('Documents') }}</span></li>
							<li data-tab="#news" class="tab-btn"><span>{{ __('News')}}</span></li>
							<li data-tab="#avis" class="tab-btn"><span>{{ _('Avis')}}</span></li>
						</ul>
						<div class="tabs-content">
							<!--tab-->
							<div class="tab active-tab" id="project">
								<div class="project-details__tab-box-project">
									{!! $project->description !!}
								</div>
							</div>
							<!--tab-->
							<div class="tab " id="documents">
								<div class="project-details__faq">
									<div class="accrodion-grp faq-one-accrodion"
										data-grp-name="faq-one-accrodion-1">
										<div class="accrodion">
											<div class="accrodion-title">
												<h4>{{ __('Etude de marché')}}</h4>
											</div>
											<div class="accrodion-content">
												<div class="inner">
												<p>{{ __('Veuillez telecharger le document') }} <a href="{{ Storage::url($project->makeStudy) }}" download="{{ Storage::url($project->makeStudy) }}"><i class="fas fa-download"></i></a> </p>
												</div><!-- /.inner -->
											</div>
										</div>
										<div class="accrodion active">
											<div class="accrodion-title">
												<h4>{{ __('Detail d\'utilisation des fonds') }}</h4>
											</div>
											<div class="accrodion-content">
												<div class="inner">
													<p>{{ __('Veuillez telecharger le document') }} <a href="{{ Storage::url($project->fundingplan->fundUsage) }}" download="{{ Storage::url($project->fundUsage) }}"><i class="fas fa-download"></i></a> </p>
												</div><!-- /.inner -->
											</div>
										</div>
										<div class="accrodion">
											<div class="accrodion-title">
												<h4>{{ __('Calendrier prévisionnel d\'utilisation des fonds') }}</h4>
											</div>
											<div class="accrodion-content">
												<div class="inner">
												<p>{{ __('Veuillez telecharger le document') }} <a href="{{ Storage::url($project->fundingplan->fundingSchedule) }}" download="{{ Storage::url($project->fundingSchedule) }}"><i class="fas fa-download"></i></a> </p>
												</div><!-- /.inner -->
											</div>
										</div>
									</div>
								</div>
							</div>
							<!--tab-->
							<div class="tab " id="news">
								<div class="project-details__updates">
									@foreach($news as $new)
									<div class="project-details__updates-single">
										<div class="project-details__updates-title-box">
											<p class="project-details__updates-sub-title">
											<div class="icon">
												<span class="fa fa-clock"></span>
											</div>
											<div>{{format_date($new->created_at)}}</div>
											</p>
											<h5 class="project-details__updates-title">{{$new->title}}</h5>
										</div>
										<p class="project-details__updates-text-1">
											{!! $new->description !!}
										</p>
										<div class="project-details__updates-img">
											<img src="{{Storage::url($new->thumbnail)}}"
												alt="">
										</div>
									</div>
									@endforeach
									{{--
									<div class="project-details__updates-single mrb-0">
										<div class="project-details__updates-title-box">
											<p class="project-details__updates-sub-title">
											<div class="icon">
												<span class="fa fa-clock"></span>
											</div>
											<div>20 Jan 2023</div>
											</p>
											<h5 class="project-details__updates-title">This is the first update of
												our
												new project</h5>
										</div>
										<p class="project-details__updates-text-1">Lorem ipsum dolor sit amet,
											consectetur adipiscing elit. Praesent vulputate sed mauris vitae
											pellentesque. Nunc ut ullamcorper libero. Aenean fringilla mauris quis
											risus laoreet interdum. Quisque imperdiet orci in metus aliquam egestas.
											Fusce elit libero, imperdiet nec orci quis, convallis hendrerit nisl.
											Cras auctor nec purus at placerat.</p>
										<p class="project-details__updates-text-2">Quisque consectetur, lectus in
											ullamcorper tempus, dolor arcu suscipit elit, id laoreet tortor justo
											nec arcu. Nam eu dictum ipsum. Morbi in mi eu urna placerat finibus a
											vel neque. Nulla in ex at mi viverra sagittis ut non erat. Praesent nec
											congue elit.</p>
										<div class="project-details__updates-img">
											<img src="assets/images/projects/project-details-updates-img-2.jpg"
												alt="">
										</div>
									</div>
									--}}
								</div>
							</div>
							<div class="tab " id="avis">
								<div class="project-details__reviews">
									<div class="project-details__review-one">
										<h3 class="project-details__review-title">{{$avis->count()}} avis</h3>
										@foreach($avis as $avi)
										<div class="project-details__review-single">
											<div class="project-details__review-image">
												<img src="assets/images/projects/project-details-review-img-1-1.jpg"
													alt="">
											</div>
											<div class="project-details__review-content">
												
												<h3>{{$avi->user->firstname . ' ' . $avi->user->lastname}}</h3>
												<p>
												{{ $avi->message}}
												</p>
												<div class="project-details__review-star">
													@for($i=0;$i<$avi->count_star;$i++)
													<i class="fa fa-star"></i>
													@endfor
												</div>
											</div>
										</div>
										@endforeach
										{{--
										<div class="project-details__review-single">
											<div class="project-details__review-image">
												<img src="assets/images/projects/project-details-review-img-1-2.jpg"
													alt="">
											</div>
											<div class="project-details__review-content">
												<h3>Sarah Albert</h3>
												<p>Mauris non dignissim purus, ac commodo diam. Donec sit amet
													lacinia nulla.
													Aliquam quis purus in justo pulvinar tempor. Aliquam tellus
													nulla,
													sollicitudin at euismod.</p>
												<div class="project-details__review-star">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
												</div>
											</div>
										</div>
										--}}
										
									</div>
									<div class="project-details__review-form">
										@guest
										<h3 class="project-details__review-form-title"><a href="{{route('login')}}">Connectez-vous</a> pour donnez votre avis</h3>
										@endguest
										@auth
										<h3 class="project-details__review-form-title">Donnez votre avis</h3>
										<div class="project-details__review-form-rate-box">
											<p>Vous évaluer ce projet à combien d'étoile</p>
											<div class="project-details__review-rate">
												<i class="fa fa-star"></i>
											</div>
											?
										</div>

										<form action="{{route('avis.sent')}}" method="post" class="" >
											@csrf
											<div class="row">
												<div class="col-xl-12">
													<div class="project-details__review-form-input-box">
														<div class="quantity-box">
															<button type="button" class="sub"><i class="fa fa-minus"></i></button>
															<input type="number" id="star" value="01" min="0" max="5" name="star">
															<button type="button" class="add"><i class="fa fa-plus"></i></button>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-xl-12">
													<input type="text" name="company" id="" value="{{$project->company->id}}" hidden>
													<div
														class="project-details__review-form-input-box text-message-box">
														<textarea name="message"
															placeholder="Write a Comment"></textarea>
													</div>
												</div>
											</div>

											<div class="row">
												<div class="col-xl-12">
													<div class="project-details__review-form-btn-box">
														<button type="submit" class="thm-btn project-details__review-form-btn">
															Ajouter un avis
														</button>
													</div>
												</div>
											</div>
										</form>
										@endauth
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
				<div class="col-xl-4 col-lg-5">
					<div class="project-details__right">
						<div class="project-details__rewards">
							<h5 class="project-details__rewards-title">Disclaimer <i class="fa fa-star color-yellow"></i></h5>
							{{--<p class="project-details__rewards-price"><span>$100</span> or More</p> --}}
							<div class="project-details__rewards-img">
								<img src="assets/images/projects/project-details-rewards-img.jpg" alt="">
							</div>
							<p class="project-details__rewards-text-2 text-justify mb-5">
								Investir comporte des risques, y compris la perte partielle ou totale de votre capital. 
								Nous vous encourageons à lire attentivement la politique de confidentialité et les conditions
								spécifiques associées à chaque projet avant de prendre toute décision d'investissement. 
								Votre compréhension et votre acceptation de ces risques sont essentielles pour une collaboration éclairée.
							</p>
							<p class="project-details__rewards-date ">20 Novembre, 2024</p>
							<p class="project-details__rewards-delivery">Equipe <strong>Monica Finance</strong></p>
							{{--
							<ul class="list-unstyled project-details__rewards-bottom">
								<li>
									<div class="icon">
										<i class="fas fa-user-circle"></i>
									</div>
									<div class="text">
										<p>1 Backers</p>
									</div>
								</li>
								<li>
									<div class="icon">
										<i class="fas fa-trophy"></i>
									</div>
									<div class="text">
										<p>1 Backers</p>
									</div>
								</li>
							</ul>
							<div class="project-details__rewards-btn-box">
								<a href="project-details.html" class="thm-btn project-details__rewards-btn">Select a
									Reward</a>
							</div>
							--}}
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--Project Details Bottom End-->

	<!--Similar Project Start-->
	<section class="similar-project">
		<div class="container">
			<div class="section-title text-center">
				<span class="section-title__tagline">Autres projets</span>
				<h2 class="section-title__title">Consultez des projets <br> similaires</h2>
			</div>
			<div class="row">
				@if($similars->count() == 0)
				<div class="text-center">
					<h4>Aucune donnée</h4>
				</div>
				@endif
				@foreach($similars as $similar)
				<!--Project One Single Start-->
				<div class="col-xl-4 col-lg-4 wow fadeInUp" data-wow-delay="100ms">
					<div class="project-one__single">
						<div class="project-one__img-box">
							<div class="project-one__img">
								<img src="{{Storage::url($similar->project->featured_image)}}" alt="">
							</div>
							<div class="project-one__icon">
								<i class="far fa-heart"></i>
							</div>
						</div>
						<div class="project-one__content">
							<div class="project-one__tag">
								<p>{{$sector}}</p>
							</div>
							<h3 class="project-one__title"><a href="{{route('project.view',['id'=>$similar->project->imat])}}">{{$similar->project->titled}}</a></h3>
							<div class="progress-levels">
								<!--Skill Box-->
								<div class="progress-box">
									<div class="inner count-box">
										<div class="text">Levé</div>
										<div class="bar">
											<div class="bar-innner">
												<div class="skill-percent">
													<span class="count-text" data-speed="3000"
														data-stop="{{getprogress($similar->project)}}">{{getprogress($similar->project)}}</span>
													<span class="percent">%</span>
												</div>
												<div class="bar-fill" data-percent="{{getprogress($similar->project)}}{{getprogress($similar->project)}}"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="project-one__goals">
								<p class="project-one__goals-one">Fond à :<span> {{ getprogress($similar->project) }} F</span></p>
								<p class="project-one__goals-one">Objectif:<span>{{ $similar->project->totalFundedNeeded }} F</span></p>
							</div>
						</div>
					</div>
				</div>
				<!--Project One Single End-->
				@endforeach
				{{--
				<!--Project One Single Start-->
				<div class="col-xl-4 col-lg-4 wow fadeInUp" data-wow-delay="200ms">
					<div class="project-one__single">
						<div class="project-one__img-box">
							<div class="project-one__img">
								<img src="assets/images/projects/project-1-5.jpg" alt="">
							</div>
							<div class="project-one__icon">
								<i class="far fa-heart"></i>
							</div>
						</div>
						<div class="project-one__content">
							<div class="project-one__tag">
								<p>Education</p>
							</div>
							<h3 class="project-one__title"><a href="project-details.php">Bourne – Travel
									Briefcase <br> and Padfolio</a></h3>
							<div class="progress-levels">
								<!--Skill Box-->
								<div class="progress-box">
									<div class="inner count-box">
										<div class="text">Raised</div>
										<div class="bar">
											<div class="bar-innner">
												<div class="skill-percent">
													<span class="count-text" data-speed="3000"
														data-stop="80">0</span>
													<span class="percent">%</span>
												</div>
												<div class="bar-fill" data-percent="80"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="project-one__goals">
								<p class="project-one__goals-one">Achieved:<span>$3,9000</span></p>
								<p class="project-one__goals-one">Goal:<span>$3,5000</span></p>
							</div>
						</div>
					</div>
				</div>
				<!--Project One Single End-->
				<!--Project One Single Start-->
				<div class="col-xl-4 col-lg-4 wow fadeInUp" data-wow-delay="300ms">
					<div class="project-one__single">
						<div class="project-one__img-box">
							<div class="project-one__img">
								<img src="assets/images/projects/project-1-6.jpg" alt="">
							</div>
							<div class="project-one__icon">
								<i class="far fa-heart"></i>
							</div>
						</div>
						<div class="project-one__content">
							<div class="project-one__tag">
								<p>Design</p>
							</div>
							<h3 class="project-one__title"><a href="project-details.php">OfficeX – Luxury
									Seating <br> for your Office</a></h3>
							<div class="progress-levels">
								<!--Skill Box-->
								<div class="progress-box">
									<div class="inner count-box">
										<div class="text">Raised</div>
										<div class="bar">
											<div class="bar-innner">
												<div class="skill-percent">
													<span class="count-text" data-speed="3000"
														data-stop="90">0</span>
													<span class="percent">%</span>
												</div>
												<div class="bar-fill" data-percent="90"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="project-one__goals">
								<p class="project-one__goals-one">Achieved:<span>$3,9000</span></p>
								<p class="project-one__goals-one">Goal:<span>$3,5000</span></p>
							</div>
						</div>
					</div>
				</div>
				<!--Project One Single End-->
				--}}
			</div>
		</div>
	</section>
</x-main-layout>