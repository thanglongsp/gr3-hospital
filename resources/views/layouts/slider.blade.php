@foreach($slides as $slide)
	<div class="carousel-item {{($slide->id==1)?'active':''}}">
		<img  class="mySlides" src="{{asset('images/slides/'.$slide->banner)}}" style="width:100%; border-bottom-right-radius: 8px; border-bottom-left-radius: 8px; border-bottom: 10px solid #ADFF2F;" />
	</div>
@endforeach