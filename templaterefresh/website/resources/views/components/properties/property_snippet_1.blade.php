<div>
    <div class="portfolio-content text-left p-3 bg-white">
        <h2>{{$portfolioItem->property_name}}</h2>
    </div>
    <div class="slide-carousel image fit">

        @if (!empty($portfolioItem->image_gallery))
            @foreach ($portfolioItem->image_gallery as $image)
            <a href="#">
                <img src="{{$baseUrl . $image->image_id->data->url}}" alt="{{$image->image_id->title}}" />
            </a>
            @endforeach    
        @endif       
    </div>
</div>
