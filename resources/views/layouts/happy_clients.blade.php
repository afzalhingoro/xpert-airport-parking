

<div class="carousel slide" data-bs-ride="true" id="carouselExampleIndicators">
        <div class="carousel-indicators">
            @for ($i = 0; $i < $reviews->count(); $i++)
                <button aria-label="Slide {{ $i }}" 
                        @if ($i == 0) class="active" @endif
                        data-bs-slide-to="{{ $i }}" 
                        data-bs-target="#carouselExampleIndicators" 
                        type="button"></button>
            @endfor
        </div>
        <div class="carousel-inner">
            @foreach ($reviews as $review)
                <div class="carousel-item @if ($loop->iteration == 1) active @endif" id="slides1">
                    <div class="pb-3"></div>
                    <div class="content">
                        <div class="container">
                            <div class="row review-row">
                                <div class="col-lg-2 text-center">
                                    <div class="initial-avatar">
                                        {{ ucfirst(substr($review->username, 0, 1)) }}
                                    </div>
                                    <br>
                                    @for ($j = 1; $j <= $review->rating; $j++)
                                        <span class="fa fa-star checked"></span>
                                    @endfor
                                </div>
                                <div class="col-lg-10">
                                    <span class="client-name"><b>{{ $review->username }}</b></span><br>
                                    <p class="review-text">{!! $review->review !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @php
                    $i++;
                @endphp
            @endforeach
        </div>
    </div>


