@foreach ($filtered_hotels as $hotel)
    <div class="hotel-card">
        <img src="{{asset('storage/' . $hotel->main_image)}}" alt="{{$hotel->name}}">
        <div class="hotel-info">
            <h3>{{$hotel->name}}</h3>
            <p><i data-lucide="map-pin"></i> {{$hotel->location}}</p>
            <p><i data-lucide="circle-dollar-sign"></i> <span>${{$hotel->price_per_night}}/night</span></p>
            <button onclick="viewHotelDetails({{$hotel->id}})">
                <i data-lucide="eye"></i> View Details
            </button>
        </div>
    </div>
@endforeach