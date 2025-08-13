

@extends('layouts.main')

@section("title",$page->meta_title)
@section("meta_keyword",$page->meta_keyword )
@section("meta_description",$page->meta_description)
@section('content')

<div class="container faqs-banner">
	<div class="row">
		<div class="col-lg-12 text-center">
			<h2 class="section-3-h2">
			    <!--<span style="color:#00519A">About Heathrow</span>-->
			    Frequently Asked Questions</h2>
		</div>
	</div>
</div>
<section id="section" class="faq_section">
	<div class="container">
		<div class="accordion" id="accordionExample">
		    @foreach($faqs as $type=>$faq)
                <div class="accordion" id="accordion{!! $type !!}">
                    <!--<h3 class="light-weight text-center faqs-hding mt-3 mb-3">{!! $type !!}</h3>-->
                    @foreach($faq as $item)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
            				  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $item->id }}" aria-expanded="false" aria-controls="collapseTwo">
            					{!! $item->title !!}
            				  </button>
            				</h2>
                        	<div id="collapse{{ $item->id }}" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        	  <div class="accordion-body">
                        		{!! $item->content !!}
                        	  </div>
                        	</div>
                        </div>
                    @endforeach
                </div>
            @endforeach
		</div>
	</div>
</section>

@endsection