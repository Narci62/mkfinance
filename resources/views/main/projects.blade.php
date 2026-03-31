<x-main-layout>
<x-progress-bar-option/>
    <section class="project-page-one">
	    <div class="container">
	        <div class="row">
				@foreach($projects as $project)
	            <!--Project One Single Start-->
	            <div class="col-xl-4 col-lg-6 col-md-6">
	                <div class="project-one__single">
	                    <div class="project-one__img-box">
	                        <div class="project-one__img">
	                            <img src="{{Storage::url($project->featured_image)}}" alt="">
	                        </div>
	                        <div class="project-one__icon">
	                            <i class="far fa-heart"></i>
	                        </div>
	                    </div>
	                    <div class="project-one__content">
	                        <div class="project-one__tag">
	                            <p>{{$project->sector}}</p>
	                        </div>
	                        <h3 class="project-one__title"><a href="{{route('project.view',['id'=>$project->imat])}}"> {{ $project->titled }} </a></h3>
	                        
	                        <div class="progress-levels">
	                            <!--Skill Box-->
	                            <div class="progress-box">
	                                <div class="inner count-box">
	                                    <div class="text">Levé</div>
	                                    <div class="bar">
	                                        <div class="bar-innner">
	                                            <div class="skill-percent">
	                                                <span class="count-text" data-speed="3000"
	                                                    data-stop="{{ getprogress($project) }}">{{ getprogress($project) }}</span>
	                                                <span class="percent">%</span>
	                                            </div>
	                                            <div class="bar-fill" data-percent="{{ getprogress($project) }}"></div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="project-one__goals">
	                            <p class="project-one__goals-one">Fond à:<span>{{ getprogress($project) }} F</span></p>
	                            <p class="project-one__goals-one">Objectif:<span>{{ $project->totalFundedNeeded }} F</span></p>
	                        </div>
	                    </div>
	                </div>
	            </div>

				@endforeach
	            
				

	            <div class="col-12 mt-3">
	            	<div class="news-sidebar__load-more text-center">
	            	    <a href="#" class="thm-btn news-sidebar__load-more-btn">Plus de projets</a>
	            	</div>
	            </div>
	        </div>
	    </div>
	</section>
</x-main-layout>