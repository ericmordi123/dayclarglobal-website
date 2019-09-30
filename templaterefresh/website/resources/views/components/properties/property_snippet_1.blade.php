<div>
    <div class="portfolio-content text-left p-3 bg-white">
        <h2>{{$portfolioItem->propertyName}}</h2>
    </div>
    <div class="slide-carousel image fit">
        @foreach ($portfolioItem->image_galley as $image)
        <a href="#">
            <img src="{{$baseUrl . $image->image_id->data->url}}" alt="{{$image->image_id->title}}" />
        </a>
        @endforeach           
    </div>
</div>
